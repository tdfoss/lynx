<?php
/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Mon, 26 Feb 2018 03:48:37 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');
define('NV_IS_MOD_INVOICE', true);
require_once NV_ROOTDIR . '/modules/invoice/global.functions.php';
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';
require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';

function nv_delete_invoice($id)
{
    global $db, $module_name, $module_data, $user_info, $lang_module, $workforce_list;
    nv_invoice_premission($module_name);
    if (!defined('NV_INVOICE_ADMIN')) {
        return false;
    }
    $rows = $db->query('SELECT code, title, score, customerid FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if ($rows) {
        $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id);
        if ($count) {
            // trừ đi số sản phẩm đã bán
            $result = $db->query('SELECT itemid, quantity FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idinvoice = ' . $id . ' AND module="products"');
            while ($_row = $result->fetch()) {
                $db->query('UPDATE ' . NV_PREFIXLANG . '_products SET purchase = purchase-' . $_row['quantity'] . ' WHERE id=' . $_row['itemid']);
            }
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idinvoice = ' . $id);
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_transaction WHERE invoiceid = ' . $id);
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_score_history WHERE invoiceid = ' . $id);

            // cập nhật lại điểm tích lũy
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_score SET score=score-' . $rows['score'] . ' WHERE customerid=' . $rows['customerid']);

            $content = sprintf($lang_module['logs_invoice_delete_note'], $workforce_list[$user_info['userid']]['fullname'], '[' . $rows['code'] . '] ' . $rows['title']);
            nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_invoice_delete'], $content, $user_info['userid']);
        }
    }
}

function nv_score_customer($customerid, $invoiceid, $type, $score, $addtime, $useradd, $note)
{
    global $db, $module_name, $module_data, $workforce_list, $user_info;
    $sql = "INSERT INTO " . NV_PREFIXLANG . "_score_history (customerid, invoiceid, type, score, addtime, useradd, note)
        VALUES ( :customerid, :invoiceid, :type, :score, :addtime, :useradd, :note
    )";
    $data_insert = array();
    $data_insert['customerid'] = $customerid;
    $data_insert['invoiceid'] = $invoiceid;
    $data_insert['type'] = $type;
    $data_insert['score'] = $score;
    $data_insert['addtime'] = NV_CURRENTTIME;
    $data_insert['useradd'] = $lastname;
    $data_insert['note'] = $user_info['userid'];
    $customerid = $db->insert_id($sql, 'customerid', $data_insert);
    if (!$customerid) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['add_histore_score_error']
        ));
    }
}

function nv_caculate_total($price, $quantity, $vat = 0)
{
    $total = $price * $quantity;
    $total = $total + (($total * $vat) / 100);
    return $total;
}

function nv_sendmail_confirm($id)
{
    global $db, $module_name, $module_data, $row, $lang_module, $array_invoice_status, $user_info, $workforce_list;
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if ($row) {
        $customer_info = nv_crm_customer_info($row['customerid']);
        if ($customer_info) {
            require_once NV_ROOTDIR . '/modules/email/site.functions.php';
            $sendto_id = array(
                $row['customerid']
            );
            $subject = 'Re: ' . sprintf($lang_module['sendmail_title'], $row['code'], $row['title']);
            $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="newconfirm"')->fetchColumn();
            $row['status'] = $array_invoice_status[$row['status']];
            $array_replace = array(
                'FULLNAME' => $customer_info['fullname'],
                'TITLE' => $row['title'],
                'STATUS' => $row['status'],
                'URL' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $id,
                'CODE' => $row['code'],
                'WORKFORCE' => $workforce_list[$row['workforceid']]['fullname'],
                'CREATETIME' => date('d/m/Y', $row['createtime']),
                'DUETIME' => (empty($row['duetime'])) ? ($lang_module['non_identify']) : nv_date('d/m/Y', $row['duetime']),
                'TERMS' => $row['terms'],
                'SCORE' => $row['score'],
                'DESCRIPTION' => $row['description'],
                'TABLE' => nv_invoice_table($id)
            );
            $message = nv_unhtmlspecialchars($message);
            foreach ($array_replace as $index => $value) {
                $message = str_replace('[' . $index . ']', $value, $message);
            }
            $result = nv_email_send($subject, $message, $user_info['userid'], $sendto_id);
            if ($result['status']) {
                if (empty($row['sended'])) {
                    $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET sended=1 WHERE id=' . $id);
                }
            }
        }
    }
}

function nv_invoice_new_notification($id, $title, $workforceid)
{
    global $lang_module, $module_name, $array_config, $workforce_list, $user_info;

    require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
    $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $id;

    // thông báo người phụ trách
    if ($workforceid != $user_info['userid']) {
        $array_userid = array(
            $workforceid
        );
        $content = sprintf($lang_module['new_invoice'], $title);
        nv_send_notification($array_userid, $content, 'new_invoice', $module_name, $url);
    }

    // thông báo cho nhóm quản lý hóa đơn
    if (!empty($array_config['groups_admin'])) {
        $array_config['groups_admin'] = explode(',', $array_config['groups_admin']);
        $array_userid = nv_invoice_get_user_groups($array_config['groups_admin']);
        foreach ($array_userid as $key => $userid) {
            if ($userid == $user_info['userid']) unset($array_userid[$key]);
        }
        if (!empty($array_userid)) {
            $content = sprintf($lang_module['new_invoice_by_workforce'], $workforce_list[$workforceid]['fullname'], $title);
            nv_send_notification($array_userid, $content, 'new_invoice_by_workforce', $module_name, $url);
        }
    }
}

function nv_transaction_list($invoiceid)
{
    global $db, $module_info, $module_data, $module_file, $lang_module, $array_transaction_status;
    $invoice_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $invoiceid)->fetch();
    if ($invoice_info) {
        $total = 0;
        $array_data = array();
        $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_transaction WHERE invoiceid=' . $invoiceid . ' ORDER BY id DESC');
        while ($_row = $result->fetch()) {
            $total += $_row['payment_amount'];
            $_row['payment_amount'] = nv_number_format($_row['payment_amount']);
            $_row['transaction_time'] = nv_date('H:i d/m/Y', $_row['transaction_time']);
            $_row['transaction_status'] = $array_transaction_status[$_row['transaction_status']];
            $array_data[$_row['id']] = $_row;
        }
        $xtpl = new XTemplate('transaction.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('TOTAL', nv_number_format($total));
        $rest = $total >= $invoice_info['grand_total'] ? 0 : $invoice_info['grand_total'] - $total;
        $xtpl->assign('REST', nv_number_format($rest));
        if (!empty($array_data)) {
            foreach ($array_data as $data) {
                $xtpl->assign('DATA', $data);
                $xtpl->parse('transaction_list.data.loop');
            }
            $xtpl->parse('transaction_list.data');
        } else {
            $xtpl->parse('transaction_list.empty');
        }
    }
    $xtpl->parse('transaction_list');
    return $xtpl->text('transaction_list');
}

function nv_transaction_update($invoiceid)
{
    global $db, $module_data;
    $invoice_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $invoiceid)->fetch();
    if ($invoice_info) {
        $total = 0;
        $result = $db->query('SELECT payment_amount FROM ' . NV_PREFIXLANG . '_' . $module_data . '_transaction WHERE invoiceid=' . $invoiceid);
        while (list ($amount) = $result->fetch(3)) {
            $total += $amount;
        }
        $status = empty($total) ? 0 : ($total >= $invoice_info['grand_total'] ? 1 : 3);
        if ($status != $invoice_info['status']) {
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=' . $status . ' WHERE id=' . $invoiceid);
        }
    }
}

function nv_status_wallet_invoice($status)
{
    $nv_transaction_status = 1; // Đang thực hiện giao dịch
    if ($status == 0) {
        $nv_transaction_status = 0;
    } elseif ($status == 1) {
        $nv_transaction_status = 4;
    } elseif ($status == 2) {
        $nv_transaction_status = 4;
    } elseif ($status == 3) {
        $nv_transaction_status = 4;
    } elseif ($status == 4) {
        $nv_transaction_status = 1;
    } elseif ($status == 5) {
        $nv_transaction_status = 4;
    }
    return $nv_transaction_status;
}

function nv_invoice_confirm_payment($id)
{
    global $db, $module_name, $module_data, $lang_module, $user_info, $workforce_list, $array_config;

    $rows = $db->query('SELECT code, title, sended, workforceid FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if ($rows) {
        $count = $db->exec('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=1, paytime=' . NV_CURRENTTIME . ' WHERE id=' . $id);
        if ($count) {
            // cập nhật lịch sử giao dịch
            $grand_total = $db->query('SELECT grand_total FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
            $transaction_total = $db->query('SELECT SUM(payment_amount) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_transaction WHERE invoiceid=' . $id)->fetchColumn();
            $payment_amount = $grand_total - $transaction_total;
            $transaction_status = 4;
            $payment = '';
            $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_transaction(invoiceid, transaction_time, transaction_status, payment, payment_amount) VALUES(:invoiceid, ' . NV_CURRENTTIME . ', :transaction_status, :payment, :payment_amount)');
            $stmt->bindParam(':invoiceid', $id, PDO::PARAM_INT);
            $stmt->bindParam(':transaction_status', $transaction_status, PDO::PARAM_INT);
            $stmt->bindParam(':payment', $payment, PDO::PARAM_STR);
            $stmt->bindParam(':payment_amount', $payment_amount, PDO::PARAM_STR);
            if ($stmt->execute()) {
                // nếu trước đó có gửi thông tin hóa đơn cho khách đã thì mới gửi thông báo xác nhận thanh toán
                if ($rows['sended']) {
                    nv_sendmail_confirm($id);
                }
                $content = sprintf($lang_module['logs_invoice_confirm_note'], '[#' . $rows['code'] . '] ' . $rows['title']);

                require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $id;
                $invoice_title = '#' . $rows['code'] . ' - ' . $rows['title'];
                $content = sprintf($lang_module['confirm_invoice_by_workforce'], $workforce_list[$rows['workforceid']]['fullname'], $invoice_title);

                // thông báo người phụ trách
                if ($rows['workforceid'] != $user_info['userid']) {
                    $array_userid = array(
                        $rows['workforceid']
                    );
                    nv_send_notification($array_userid, $content, 'confirm_invoice_by_workforce', $module_name, $url);
                }

                // thông báo cho nhóm quản lý hóa đơn
                if (!empty($array_config['groups_admin'])) {
                    $array_config['groups_admin'] = explode(',', $array_config['groups_admin']);
                    $array_userid = nv_invoice_get_user_groups($array_config['groups_admin']);
                    foreach ($array_userid as $key => $userid) {
                        if ($userid == $user_info['userid']) unset($array_userid[$key]);
                    }
                    if (!empty($array_userid)) {
                        nv_send_notification($array_userid, $content, 'confirm_invoice_by_workforce', $module_name, $url);
                    }
                }

                nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_invoice_confirm'], $content, $user_info['userid']);
            }
        }
    }
}

function nv_invoice_check_date($date)
{
    global $db, $module_name, $module_data, $array_users, $lang_module, $module_file, $module_info;
    if ($date == 1) {
        $time = 604800;
        $lang = $lang_module['1week'];
    } elseif ($date == 2) {
        $time = 1209600;
        $lang = $lang_module['2week'];
    } elseif ($date == 3) {
        $time = 2592000;
        $lang = $lang_module['1month'];
    } elseif ($date == 4) {
        $time = 5184000;
        $lang = $lang_module['2month'];
    } elseif ($date == 5) {
        $time = 7776000;
        $lang = $lang_module['3month'];
    }
    $data = array();
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE duetime > 0 AND duetime >= ' . (NV_CURRENTTIME - ($date * $time)) . ' AND duetime <= ' . NV_CURRENTTIME . ' + ' . $time . ' AND status NOT IN (1,2) ORDER BY duetime DESC');
    while ($rows = $result->fetch()) {
        if (!isset($array_users[$rows['customerid']])) {
            $users = nv_crm_customer_info($rows['customerid']);
            if ($users) {
                $rows['customer'] = array(
                    'fullname' => $users['fullname'],
                    'link' => $users['link_view']
                );
                $array_users[$rows['customerid']] = $rows['customer'];
            } else {
                $rows['customer'] = '';
            }
        } else {
            $rows['customer'] = $array_users[$rows['customerid']];
        }
        $rows['grand_total'] = nv_number_format($rows['grand_total']);
        $rows['status_str'] = $lang_module['status_' . $rows['status']];
        $rows['createtime'] = (empty($rows['createtime'])) ? '' : nv_date('d/m/Y', $rows['createtime']);
        $rows['duetime'] = (empty($rows['duetime'])) ? ($lang_module['non_identify']) : nv_date('d/m/Y', $rows['duetime']);
        $rows['addtime'] = (empty($rows['addtime'])) ? '-' : nv_date('H:i d/m/Y', $rows['addtime']);
        $rows['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $rows['id'];
        $data[] = $rows;
    }
    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    if (empty($data)) {
        $xtpl->assign('EMPTY', sprintf($lang_module['empty_data_invoice'], $lang));
        $xtpl->parse('list.empty_list_invoice');
    }
    foreach ($data as $key => $value) {
        $xtpl->assign('LIST', $value);
        $xtpl->parse('list.list_invoice');
    }
    $xtpl->parse('list');
    $contents = $xtpl->text('list');
    return $contents;
}

function nv_invoice_get_user_groups($groups_list)
{
    global $db;

    $array_userid = array();
    $result = $db->query('SELECT t1.userid FROM ' . NV_USERS_GLOBALTABLE . ' t1 INNER JOIN ' . NV_USERS_GLOBALTABLE . '_groups_users t2 ON t1.userid=t2.userid WHERE t2.group_id IN (' . implode(',', $groups_list) . ')');
    while (list ($userid) = $result->fetch(3)) {
        $array_userid[] = $userid;
    }
    return array_map('intval', $array_userid);
}