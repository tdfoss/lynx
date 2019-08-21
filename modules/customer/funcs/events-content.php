<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Feb 2018 09:55:47 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

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

$table_name = NV_PREFIXLANG . '_' . $module_data . '_events';
$row = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $lang_module['events_add'] = $lang_module['events_edit'];
    $row = $db->query('SELECT * FROM ' . $table_name . ' WHERE id=' . $row['id'] . nv_customer_premission($module_name))->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=events');
        die();
    }
} else {
    $row['id'] = $row['event_type_id'] = 0;
    $row['customer_id'] = $nv_Request->get_int('customer_id', 'post', 0);
    $row['content'] = '';
    $row['eventtime'] = NV_CURRENTTIME;
}

$row['ajax'] = $nv_Request->get_int('ajax', 'post', 0);
$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['customer_id'] = $nv_Request->get_int('customer_id', 'post', 0);
    $row['event_type_id'] = $nv_Request->get_int('event_type_id', 'post', 0);
    $row['content'] = $nv_Request->get_textarea('content', '', NV_ALLOWED_HTML_TAGS);

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4}) ([0-9]{2}):([0-9]{2})$/', $nv_Request->get_string('eventtime', 'post'), $m)) {
        $row['eventtime'] = mktime($m[4], $m[5], 0, $m[2], $m[1], $m[3]);
    } else {
        $row['eventtime'] = 0;
    }

    if (empty($row['customer_id'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_customer'],
            'input' => 'customer_id'
        ));
    }

    if (empty($row['eventtime'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_eventtime'],
            'input' => 'eventtime'
        ));
    }

    try {
        if (empty($row['id'])) {
            $stmt = $db->prepare('INSERT INTO ' . $table_name . ' (customer_id, event_type_id, content, userid, eventtime, addtime) VALUES (:customer_id, :event_type_id, :content, ' . $user_info['userid'] . ', :eventtime, ' . NV_CURRENTTIME . ')');
        } else {
            $stmt = $db->prepare('UPDATE ' . $table_name . ' SET customer_id = :customer_id, event_type_id = :event_type_id, content = :content, eventtime = :eventtime WHERE id=' . $row['id']);
        }
        $stmt->bindParam(':customer_id', $row['customer_id'], PDO::PARAM_INT);
        $stmt->bindParam(':event_type_id', $row['event_type_id'], PDO::PARAM_INT);
        $stmt->bindParam(':content', $row['content'], PDO::PARAM_STR, strlen($row['content']));
        $stmt->bindParam(':eventtime', $row['eventtime'], PDO::PARAM_INT);
        $exc = $stmt->execute();
        if ($exc) {

            if (empty($row['id'])) {
                // cập nhật lại thời gian cập nhật khách hàng
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET edittime = ' . NV_CURRENTTIME . ' WHERE id=' . $row['customer_id']);
            }

            $nv_Cache->delMod($module_name);

            if (!empty($row['redirect'])) {
                $url = nv_redirect_decrypt($row['redirect']);
            } else {
                $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=events';
            }

            nv_jsonOutput(array(
                'error' => 0,
                'ajax' => $row['ajax'],
                'redirect' => $url
            ));
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_unknow']
        ));
    }
}

$customer_info = array();
if (!empty($row['customer_id'])) {
    $customer_info = nv_crm_customer_info($row['customer_id']);
}

$row['eventtime'] = !empty($row['eventtime']) ? nv_date('d/m/Y H:i', $row['eventtime']) : '';

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customer');
}

if (!empty($array_customer_events_type)) {
    foreach ($array_customer_events_type as $events_type) {
        $events_type['selected'] = $events_type['id'] == $row['event_type_id'] ? 'selected="selected"' : '';
        $xtpl->assign('EVENTS_TYPE', $events_type);
        $xtpl->parse('main.events_type');
    }
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['events_add'];
$array_mod_title[] = array(
    'title' => $lang_module['events'],
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=events'
);
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents, !($row['ajax']));
include NV_ROOTDIR . '/includes/footer.php';