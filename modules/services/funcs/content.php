<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 16 Jan 2018 04:31:22 GMT
 */

if (!defined('NV_IS_MOD_SERVICES')) die('Stop!!!');

if ($nv_Request->isset_request('get_user_json', 'post, get')) {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('id, first_name, last_name, main_phone, main_email')
        ->from(NV_PREFIXLANG . '_customer')
        ->where('(first_name LIKE "%' . $q . '%"
            OR last_name LIKE "%' . $q . '%"
            OR main_phone LIKE "%' . $q . '%"
            OR other_phone LIKE "%' . $q . '%"
            OR main_email LIKE "%' . $q . '%"
            OR other_email LIKE "%' . $q . '%"
            OR address LIKE "%' . $q . '%"
            OR trading_person LIKE "%' . $q . '%"
            OR unit_name LIKE "%' . $q . '%"
            OR tax_code LIKE "%' . $q . '%"
            OR address_invoice LIKE "%' . $q . '%"
        )')
        ->order('first_name ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while (list ($customerid, $first_name, $last_name, $main_phone, $main_email) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $customerid,
            'fullname' => nv_show_name_user($first_name, $last_name),
            'phone' => $main_phone,
            'email' => $main_email
        );
    }

    header('Cache-Control: no-cache, must-revalidate');
    header('Content-type: application/json');

    ob_start('ob_gzhandler');
    echo json_encode($array_data);
    exit();
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['customerid'] = 0;
    $row['serviceid'] = 0;
    $row['title'] = '';
    $row['note'] = '';
    $row['begintime'] = 0;
    $row['endtime'] = 0;
    $row['price'] = 0;
    $row['month'] = 0;
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['customerid'] = $nv_Request->get_int('customerid', 'post', 0);
    $row['serviceid'] = $nv_Request->get_int('serviceid', 'post', 0);
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['note'] = $nv_Request->get_string('note', 'post', '');
    $row['price'] = $nv_Request->get_title('price', 'post', 0);
    $row['month'] = $nv_Request->get_int('month', 'post', 0);

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('begintime', 'post'), $m)) {
        $row['begintime'] = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
    } else {
        $row['begintime'] = 0;
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('endtime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['endtime'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['endtime'] = 0;
    }

    if (empty($row['customerid'])) {
        $error[] = $lang_module['error_required_customerid'];
    } elseif (empty($row['serviceid'])) {
        $error[] = $lang_module['error_required_serviceid'];
    } elseif (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    }

    if (empty($error)) {
        try {
            $new_id = 0;
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_customer (customerid, serviceid, title, note, price, month, begintime, endtime, addtime, useradd) VALUES (:customerid, :serviceid, :title, :note, :price, :month, :begintime, :endtime, ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ')';
                $data_insert = array();
                $data_insert['customerid'] = $row['customerid'];
                $data_insert['serviceid'] = $row['serviceid'];
                $data_insert['title'] = $row['title'];
                $data_insert['note'] = $row['note'];
                $data_insert['price'] = $row['price'];
                $data_insert['month'] = $row['month'];
                $data_insert['begintime'] = $row['begintime'];
                $data_insert['endtime'] = $row['endtime'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_customer SET customerid = :customerid, serviceid = :serviceid, title = :title, note = :note, price = :price, month = :month, begintime = :begintime, endtime = :endtime WHERE id=' . $row['id']);
                $stmt->bindParam(':customerid', $row['customerid'], PDO::PARAM_INT);
                $stmt->bindParam(':serviceid', $row['serviceid'], PDO::PARAM_INT);
                $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
                $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
                $stmt->bindParam(':price', $row['price'], PDO::PARAM_STR);
                $stmt->bindParam(':month', $row['month'], PDO::PARAM_STR);
                $stmt->bindParam(':begintime', $row['begintime'], PDO::PARAM_INT);
                $stmt->bindParam(':endtime', $row['endtime'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

$row['begintime'] = !empty($row['begintime']) ? date('d/m/Y', $row['begintime']) : '';
$row['endtime'] = !empty($row['endtime']) ? date('d/m/Y', $row['endtime']) : '';
$row['price'] = !empty($row['price']) ? $row['price'] : '';
$row['month'] = !empty($row['month']) ? $row['month'] : '';

$customer_info = array();
if (defined('CRM_WORKFORCE')) {
    if (!empty($row['customerid'])) {
        $customer_info = nv_crm_customer_info($row['customerid']);
    }
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customer');
}

if (!empty($array_services)) {
    foreach ($array_services as $service) {
        $xtpl->assign('SERVICE', $service);
        $xtpl->parse('main.services');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['content'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';