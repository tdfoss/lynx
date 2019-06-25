<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 26 Feb 2018 06:08:20 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

$id = $nv_Request->get_int('id', 'get', 0);
$checksum = $nv_Request->get_string('checksum', 'get', '');

$md5 = md5($id . $global_config['sitekey'] . $client_info['session_id']);
if ($id > 0 and $nv_Request->isset_request('payment', 'get') and $nv_Request->isset_request('checksum', 'get')) {
    $checksum = $nv_Request->get_string('checksum', 'get');

    $rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if (!$rows) {
        nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
    }

    $link_back = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=invoice&id=' . $id . '&checksum=' . md5($id . $global_config['sitekey'] . $client_info['session_id']);

    // Lấy dữ liệu trả về
    if ($nv_Request->isset_request('worderid,wchecksum', 'get') and intval($rows['status']) == 4 and isset($site_mods['wallet']) and file_exists(NV_ROOTDIR . '/modules/wallet/wallet.class.php')) {
        require_once NV_ROOTDIR . '/modules/wallet/wallet.class.php';
        $wallet = new nukeviet_wallet();

        $worderid = $nv_Request->get_title('worderid', 'get', '');
        $wchecksum = $nv_Request->get_title('wchecksum', 'get', '');

        // Lấy ra giao dịch
        $transaction = $db->query("SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_transaction WHERE id=" . $worderid)->fetch();

        // Giao dịch không khớp với
        if ($transaction['invoiceid'] != $id) {
            $contents = nv_theme_alert($lang_module['error_payment_data_title'], $lang_module['error_payment_data_content'], 'danger', $link_back);
            include NV_ROOTDIR . '/includes/header.php';
            echo nv_site_theme($contents);
            include NV_ROOTDIR . '/includes/footer.php';
        }

        $paid = $wallet->getOrderPaid($module_name, $worderid, $wchecksum);
var_dump($paid); die;
        if (empty($paid)) {
            nv_redirect_location($link_back);
        }

        $nv_transaction_status = $paid[0];

        // Cập nhật giao dịch
        $check = $db->exec("UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_transaction SET transaction_status=" . $nv_transaction_status . ", transaction_time=" . $paid[1] . " WHERE id=" . $worderid);
        if (!$check) {
            $contents = nv_theme_alert($lang_module['error_payment_update_title'], $lang_module['error_payment_update_content'], 'danger', $link_back);
            include NV_ROOTDIR . '/includes/header.php';
            echo nv_site_theme($contents);
            include NV_ROOTDIR . '/includes/footer.php';
        }

        $invoice_status = nv_status_wallet_invoice($nv_transaction_status);

        // Cập nhật hóa đơn
        $check = $db->exec("UPDATE " . NV_PREFIXLANG . "_" . $module_data . " SET status=" . $invoice_status . " WHERE id=" . $transaction['invoiceid']);
        if (!$check) {
            $contents = nv_theme_alert($lang_module['error_payment_update_title'], $lang_module['error_payment_update_content'], 'danger', $link_back);
            include NV_ROOTDIR . '/includes/header.php';
            echo nv_site_theme($contents);
            include NV_ROOTDIR . '/includes/footer.php';
        }

        if ($nv_transaction_status == 4) {
            $contents = nv_theme_alert($lang_module['payment_success_title'], $lang_module['payment_success_content'], 'info', $link_back, $lang_module['review_invoice']);
        } else {
            $contents = nv_theme_alert($lang_module['error_payment_title'], $lang_module['error_payment_content'], 'danger', $link_back, $lang_module['review_invoice']);
        }

        $nv_Cache->delMod($module_name);

        include NV_ROOTDIR . '/includes/header.php';
        echo nv_site_theme($contents);
        include NV_ROOTDIR . '/includes/footer.php';
    }

    $url = '';
    if (intval($rows['status']) == 0 and $checksum == md5($id . $global_config['sitekey'] . $client_info['session_id']) and isset($site_mods['wallet']) and file_exists(NV_ROOTDIR . '/modules/wallet/wallet.class.php')) {
        require_once NV_ROOTDIR . '/modules/wallet/wallet.class.php';
        $wallet = new nukeviet_wallet();

        // Cập nhật lại đơn hàng, khởi tạo giao dịch mới
        //$userid = (defined('NV_IS_USER')) ? $user_info['userid'] : 0;

        $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_transaction (invoiceid, transaction_time, transaction_status, payment, payment_amount, payment_data, note) VALUES (:invoiceid, ' . NV_CURRENTTIME . ', :transaction_status, :payment, :payment_amount, :payment_data, :note)';
        $data_insert = array();
        $data_insert['invoiceid'] = $id;
        $data_insert['transaction_status'] = 1;
        $data_insert['payment'] = 0;
        $data_insert['payment_amount'] = $rows['grand_total'];
        $data_insert['payment_data'] = '';
        $data_insert['note'] = '';
        $transaction_id = $db->insert_id($_sql, 'id', $data_insert);

        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=4 WHERE id=' . $id);

        $url_back = array(
            'op' => $op,
            'querystr' => 'id=' . $id . '&payment=1&wpreturn=1&checksum=' . md5($id . $global_config['sitekey'] . $client_info['session_id'])
        );

        $url_admin = array(
            'op' => 'order',
            'querystr' => 'id=' . $id . '&updateorder=1&checksum=' . md5($id . $global_config['sitekey'] . $client_info['session_id'])
        );

        $array = array(
            'modname' => $module_name, // Module thanh toán
            'id' => $transaction_id, // ID đơn hàng
            'order_object' => '', // Loại đối tượng được mua ví dụ: Ứng dụng, sản phẩm, giỏ hàng...
            'order_name' => $rows['title'], //
            'money_amount' => $rows['grand_total'],
            'money_unit' => 'VND',
            'url_back' => $url_back,
            'url_admin' => $url_admin
        );
        $payment_info = $wallet->getInfoPayment($array);

        if ($payment_info['status'] !== 'SUCCESS') {
            $url = $link_back;
        }
        $url = $payment_info['url'];
    } else {
        $url = $link_back;
    }
    nv_redirect_location($url);
} elseif ($id > 0 && $md5 == $checksum) {
    $rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if (!$rows) {
        nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
    }

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('CONTENT', nv_invoice_template($id));

    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    $page_title = '#' . $rows['code'];

    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents, false);
    include NV_ROOTDIR . '/includes/footer.php';
} else {
    nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
}
