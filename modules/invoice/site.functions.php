<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Mon, 26 Feb 2018 03:48:37 GMT
 */
if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$array_status = array(
    0 => $lang_module['status_0'],
    1 => $lang_module['status_1'],
    3 => $lang_module['status_3'],
    2 => $lang_module['status_2'],
    4 => $lang_module['status_4']
);

$array_transaction_status = array(
    0 => $lang_module['transaction_status_0'],
    1 => $lang_module['transaction_status_1'],
    2 => $lang_module['transaction_status_2'],
    3 => $lang_module['transaction_status_3'],
    4 => $lang_module['transaction_status_4'],
    5 => $lang_module['transaction_status_5']
);

if (isset($site_mods['services'])) {
    $_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_services WHERE active=1';
    $array_services = $nv_Cache->db($_sql, 'id', 'services');
}

if (isset($site_mods['products'])) {
    $_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_products WHERE active=1';
    $array_products = $nv_Cache->db($_sql, 'id', 'products');
}

if (isset($site_mods['projects'])) {
    $_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_projects';
    $array_projects = $nv_Cache->db($_sql, 'id', 'projects');
}

function nv_copy_invoice($id, $status = 0, $create_user_id = 0)
{
    global $db, $module_data, $user_info;
    try {
        $rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
        if ($rows) {
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (title, customerid, createtime, duetime, cycle, status, workforceid, terms, description, grand_total, addtime, useradd) VALUES (:title, :customerid, :createtime, :duetime, :cycle, :status, :workforceid, :terms, :description, :grand_total, ' . NV_CURRENTTIME . ', ' . $create_user_id . ')';
            $data_insert = array();
            $data_insert['title'] = $rows['title'];
            $data_insert['customerid'] = $rows['customerid'];
            $data_insert['createtime'] = $rows['createtime'];
            $data_insert['duetime'] = $rows['duetime'];
            $data_insert['cycle'] = $rows['cycle'];
            $data_insert['status'] = $status;
            $data_insert['workforceid'] = $rows['workforceid'];
            $data_insert['terms'] = $rows['terms'];
            $data_insert['description'] = $rows['description'];
            $data_insert['grand_total'] = $rows['grand_total'];
            $new_id = $db->insert_id($_sql, 'id', $data_insert);
            if ($new_id > 0) {
                $i = 1;
                $format_code = '%06s';
                $auto_code = vsprintf($format_code, $new_id);

                $stmt = $db->prepare('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE code= :code');
                $stmt->bindParam(':code', $auto_code, PDO::PARAM_STR);
                $stmt->execute();
                while ($stmt->rowCount()) {
                    $auto_code = vsprintf($format_code, ($new_id + $i ++));
                }

                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET code= :code WHERE id=' . $new_id);
                $stmt->bindParam(':code', $auto_code, PDO::PARAM_STR);
                $stmt->execute();

                // copy chi tiet hoa don
                $rows['detail'] = array();
                $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idinvoice=' . $rows['id'] . ' ORDER BY weight');
                while ($_row = $result->fetch()) {
                    $rows['detail'][$_row['itemid']] = $_row;
                }

                if (! empty($rows['detail'])) {
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_detail (idinvoice, idcustomer, module, itemid, quantity, price, vat, total, note, weight) VALUES(:idinvoice, :idcustomer, :module, :itemid, :quantity, :price, :vat, :total, :note, :weight)');
                    foreach ($rows['detail'] as $service) {
                        $service['note'] = ! empty($service['note']) ? $service['note'] : '';
                        $total = $service['price'] * $service['quantity'];
                        $total = $total + (($total * $service['vat']) / 100);
                        $sth->bindParam(':idinvoice', $new_id, PDO::PARAM_INT);
                        $sth->bindParam(':idcustomer', $rows['customerid'], PDO::PARAM_INT);
                        $sth->bindParam(':module', $service['module'], PDO::PARAM_STR);
                        $sth->bindParam(':itemid', $service['itemid'], PDO::PARAM_INT);
                        $sth->bindParam(':quantity', $service['quantity'], PDO::PARAM_INT);
                        $sth->bindParam(':price', $service['price'], PDO::PARAM_STR);
                        $sth->bindParam(':vat', $service['vat'], PDO::PARAM_STR);
                        $sth->bindParam(':total', $total, PDO::PARAM_STR);
                        $sth->bindParam(':note', $service['note'], PDO::PARAM_STR);
                        $sth->bindParam(':weight', $service['weight'], PDO::PARAM_INT);
                        $sth->execute();
                    }
                }

                if ($data_insert['status'] == 1) {
                    nv_sendmail_econtent($new_id, $user_info['userid']);
                }
                return $new_id;
            }
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function nv_caculate_duetime($createtime, $cycle_number)
{
    if (empty($createtime) || empty($cycle_number)) {
        return false;
    }
    return strtotime('+' . $cycle_number . ' month', $createtime);
}

function nv_sendmail_econtent($new_id, $adduser = 0, $location_file = '')
{
    global $db, $module_name, $module_data, $row, $lang_module, $array_status, $user_info, $workforce_list;

    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $new_id)->fetch();
    if ($row) {
        $customer_info = nv_crm_customer_info($row['customerid']);
        if ($customer_info) {
            require_once NV_ROOTDIR . '/modules/email/site.functions.php';
            $sendto_id = array(
                $row['customerid']
            );

            $subject = sprintf($lang_module['sendmail_title'], $row['code'], $row['title']);
            $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="newinvoice"')->fetchColumn();
            $row['status'] = $array_status[$row['status']];
            $array_replace = array(
                'FULLNAME' => $customer_info['fullname'],
                'TITLE' => $row['title'],
                'STATUS' => $row['status'],
                'URL' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=invoice&amp;id=' . $id . '&amp;checksum=' . md5($new_id . $global_config['sitekey'] . $client_info['session_id']),
                'CODE' => $row['code'],
                'WORKFORCE' => $workforce_list[$row['workforceid']]['fullname'],
                'CREATETIME' => date('d/m/Y', $row['createtime']),
                'DUETIME' => (empty($row['duetime'])) ? ($lang_module['non_identify']) : nv_date('d/m/Y', $row['duetime']),
                'TERMS' => $row['terms'],
                'DESCRIPTION' => $row['description'],
                'TABLE' => nv_invoice_table($new_id)
            );

            $message = nv_unhtmlspecialchars($message);
            foreach ($array_replace as $index => $value) {
                $message = str_replace('[' . $index . ']', $value, $message);
            }

            $cc_id = array();
            if (! empty($row['workforceid']) && $user_info['userid'] != $row['workforceid']) {
                $cc_id[] = $row['workforceid'];
            }

            $result = nv_email_send($subject, $message, $adduser, $sendto_id, $cc_id, $location_file);
            if ($result['status']) {
                if (empty($row['sended'])) {
                    $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET sended=1 WHERE id=' . $new_id);
                }
            }
        }
    }
    return $result;
}

function nv_invoice_table($id)
{
    global $module_file, $lang_module, $array_invoice_products, $order_id, $db, $module_data, $array_services, $array_products, $array_control, $row, $module_name, $op, $global_config;

    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    $row['vat_price'] = $row['item_total'] = $row['vat_total'] = 0;

    $array_invoice_products = array();
    $order_id = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idinvoice=' . $id);
    while ($order = $order_id->fetch()) {
        $row['vat_price'] = ($order['price'] * $order['vat']) / 100;
        $row['item_total'] += ($order['price'] * $order['quantity']);
        $row['vat_total'] += $row['vat_price'];
        $array_invoice_products[] = $order;
    }

    $row['item_total'] = number_format($row['item_total']);
    $row['vat_total'] = number_format($row['vat_total']);
    $row['grand_total_string'] = nv_convert_number_to_words($row['grand_total']);
    $row['grand_total'] = number_format($row['grand_total']);
    $row['discount_value'] = number_format($row['discount_value']);

    $templateCSS = file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/css/pdf.css') ? $global_config['module_theme'] : 'default';
    $xtpl = new XTemplate('table.tpl', NV_ROOTDIR . '/themes/default/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->assign('TEMPLATE_CSS', $templateCSS);

    $templateCSS = file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/css/pdf.css') ? $global_config['module_theme'] : 'default';
    $xtpl->assign('TEMPLATE_CSS', $templateCSS);

    if (! empty($array_invoice_products)) {
        $i = 1;
        foreach ($array_invoice_products as $orders) {
            $orders['number'] = $i ++;
            $orders['vat_price'] = ($orders['price'] * $orders['vat']) / 100;
            $orders['vat_price'] = number_format($orders['vat_price']);
            $orders['price'] = number_format($orders['price']);
            $orders['total'] = number_format($orders['total']);

            if ($orders['module'] == 'services') {
                $orders['itemid'] = $array_services[$orders['itemid']]['title'];
            } elseif ($orders['module'] == 'products') {
                $orders['itemid'] = $array_products[$orders['itemid']]['title'];
            }

            $xtpl->assign('CONTROL', $array_control);
            $xtpl->assign('ORDERS', $orders);
            $xtpl->parse('main.invoice_list.loop');
        }
        $xtpl->parse('main.invoice_list');
    }

    $xtpl->assign('ROW_SEND', $row);

    if (! empty($row['discount_percent']) && ! empty($row['discount_value'])) {
        $xtpl->parse('main.discount');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_invoice_template($id)
{
    global $module_file, $lang_module, $module_info, $array_invoice_products, $order_id, $db, $module_data, $array_services, $array_products, $array_control, $row, $customer_info, $module_name, $workforce_list, $global_config, $array_status, $site_mods, $op, $client_info;

    $invoice_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();

    $pdf_econtent = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="contentpdf"')->fetch();

    $ctmid = nv_crm_customer_info($invoice_info['customerid']);

    $size = @getimagesize(NV_ROOTDIR . '/' . $global_config['site_logo']);
    $logo = preg_replace('/\.[a-z]+$/i', '.svg', $global_config['site_logo']);
    if (! file_exists(NV_ROOTDIR . '/' . $logo)) {
        $logo = $global_config['site_logo'];
    }

    $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="contentpdf"')->fetchColumn();
    $array_replace = array(
        'FULLNAME' => $ctmid['fullname'],
        'TITLE' => $invoice_info['title'],
        'STATUS' => $array_status[$invoice_info['status']],
        'URL' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $id,
        'CODE' => $invoice_info['code'],
        'WORKFORCE' => $workforce_list[$invoice_info['workforceid']]['fullname'],
        'CREATETIME' => date('d/m/Y', $invoice_info['createtime']),
        'DUETIME' => (empty($invoice_info['duetime'])) ? ($lang_module['non_identify']) : nv_date('d/m/Y', $invoice_info['duetime']),
        'TERMS' => $invoice_info['terms'],
        'DESCRIPTION' => $invoice_info['description'],
        'TABLE' => nv_invoice_table($id),
        'LOGO' => NV_BASE_SITEURL . $logo,
        'SITE_NAME' => $global_config['site_name'],
        'SITE_DESCRIPTION' => $global_config['site_description'],
        'CUSTOMER_EMAIL' => empty($ctmid['main_email']) ? '-' : $ctmid['main_email'],
        'CUSTOMER_PHONE' => empty($ctmid['main_phone']) ? '-' : $ctmid['main_phone'],
        'CUSTOMER_ADDRESS' => empty($ctmid['address']) ? '-' : $ctmid['address']
    );

    $message = nv_unhtmlspecialchars($message);
    foreach ($array_replace as $index => $value) {
        $message = str_replace('[' . $index . ']', $value, $message);
    }

    return $message;
}

function nv_convert_number_to_words($number)
{
    return convert_number_to_words($number) . ' đồng';
}

function convert_number_to_words($number)
{
    $hyphen = ' ';
    $conjunction = '  ';
    $separator = ' ';
    $negative = 'âm ';
    $decimal = ' phẩy ';
    $dictionary = array(
        0 => 'Không',
        1 => 'Một',
        2 => 'Hai',
        3 => 'Ba',
        4 => 'Bốn',
        5 => 'Năm',
        6 => 'Sáu',
        7 => 'Bảy',
        8 => 'Tám',
        9 => 'Chín',
        10 => 'Mười',
        11 => 'Mười một',
        12 => 'Mười hai',
        13 => 'Mười ba',
        14 => 'Mười bốn',
        15 => 'Mười năm',
        16 => 'Mười sáu',
        17 => 'Mười bảy',
        18 => 'Mười tám',
        19 => 'Mười chín',
        20 => 'Hai mươi',
        30 => 'Ba mươi',
        40 => 'Bốn mươi',
        50 => 'Năm mươi',
        60 => 'Sáu mươi',
        70 => 'Bảy mươi',
        80 => 'Tám mươi',
        90 => 'Chín mươi',
        100 => 'trăm',
        1000 => 'nghìn',
        1000000 => 'triệu',
        1000000000 => 'tỷ',
        1000000000000 => 'nghìn tỷ',
        1000000000000000 => 'ngàn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
    );

    if (! is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list ($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return ucfirst(strtolower($string));
}
