<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 26 Feb 2018 06:08:20 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

$redirect = $nv_Request->get_string('redirect', 'get', '');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        nv_delete_invoice($id);
        $nv_Cache->delMod($module_name);
        if (!empty($redirect)) {
            $url = nv_redirect_decrypt($redirect);
        } else {
            $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;
        }
        Header('Location: ' . $url);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            nv_delete_invoice($id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

if ($nv_Request->isset_request('confirm_payment', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            nv_support_confirm_payment($id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$join = $where = '';

$array_search = array(
    'search' => $nv_Request->isset_request('search', 'post,get'),
    'q' => $nv_Request->get_title('q', 'post,get'),
    'customerid' => $nv_Request->get_int('customerid', 'get', 0),
    'workforceid' => $nv_Request->get_int('workforceid', 'get', 0),
    'presenterid' => $nv_Request->get_int('presenterid', 'get', 0),
    'performerid' => $nv_Request->get_int('performerid', 'get', 0),
    'serviceid' => $nv_Request->get_int('serviceid', 'get', 0),
    'createtime' => $nv_Request->get_string('createtime', 'get', 0),
    'duetime' => $nv_Request->get_int('duetime', 'get', 0),
    'status' => $nv_Request->get_int('status', 'post,get', -1)
);

if (!empty($array_search['q'])) {
    $base_url .= '&amp;q=' . $array_search['q'];
    $where .= ' AND (title LIKE "%' . $array_search['q'] . '%"
        OR code LIKE "%' . $array_search['q'] . '%"
        OR terms LIKE "%' . $array_search['q'] . '%"
        OR description LIKE "%' . $array_search['q'] . '%"
    )';
}

if (!empty($array_search['customerid'])) {
    $base_url .= '&amp;customerid=' . $array_search['customerid'];
    $where .= ' AND customerid=' . $array_search['customerid'];
}

if (!empty($array_search['workforceid'])) {
    $base_url .= '&amp;workforceid=' . $array_search['workforceid'];
    $where .= ' AND workforceid=' . $array_search['workforceid'];
}

if (!empty($array_search['presenterid'])) {
    $base_url .= '&amp;presenterid=' . $array_search['presenterid'];
    $where .= ' AND presenterid=' . $array_search['presenterid'];
}

if (!empty($array_search['performerid'])) {
    $base_url .= '&amp;workforceid=' . $array_search['performerid'];
    $where .= ' AND performerid=' . $array_search['performerid'];
}

if (!empty($array_search['createtime'])) {

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('createtime', 'get'), $m)) {
        $_hour = 23;
        $_min = 23;
        $array_search['createtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $array_search['createtime'] = 0;
    }
    $base_url .= '&amp;createtime= ' . $array_search['createtime'];
    $where .= ' AND createtime >= ' . $array_search['createtime'];
}
if (!empty($array_search['duetime'])) {

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('duetime', 'get'), $m)) {

        $_hour = 23;
        $_min = 23;
        $array_search['duetime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $array_search['duetime'] = 0;
    }
    $base_url .= '&amp;duetime= ' . $array_search['duetime'];
    $where .= ' AND duetime <= ' . $array_search['duetime'];
}

if ($array_search['status'] >= 0) {
    $base_url .= '&amp;status=' . $array_search['status'];
    $where .= ' AND status=' . $array_search['status'];
} elseif (!$array_search['search'] && !empty($array_config['default_status'])) {
    $where .= ' AND status IN (' . $array_config['default_status'] . ')';
}

if ($array_search['serviceid'] > 0) {
    $join .= ' INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_detail t2 ON t1.id=t2.idinvoice';
    $base_url .= '&amp;serviceid=' . $array_search['serviceid'];
    $where .= ' AND t2.module="services" AND t2.itemid=' . $array_search['serviceid'];
}

$where .= nv_invoice_premission($module_name);

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $module_data . ' t1')
    ->join($join)
    ->where('1=1' . $where);

$sth = $db->prepare($db->sql());
$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('t1.*')
    ->order('t1.id DESC')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

$customer_info = array();
if (!empty($array_search['customerid'])) {
    $customer_info = nv_crm_customer_info($array_search['customerid']);
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('BASE_URL', $base_url);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content');

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

$array_users = array();
while ($view = $sth->fetch()) {
    if (!isset($array_users[$view['customerid']])) {
        $users = nv_crm_customer_info($view['customerid']);
        if ($users) {
            $view['customer'] = array(
                'fullname' => $users['fullname'],
                'link' => $users['link_view']
            );
            $array_users[$view['customerid']] = $view['customer'];
        } else {
            $view['customer'] = '';
        }
    } else {
        $view['customer'] = $array_users[$view['customerid']];
    }
    $view['grand_total'] = nv_number_format($view['grand_total']);
    $view['status_str'] = $lang_module['status_' . $view['status']];
    $view['createtime'] = (empty($view['createtime'])) ? '' : nv_date('d/m/Y', $view['createtime']);
    $view['duetime'] = (empty($view['duetime'])) ? ($lang_module['non_identify']) : nv_date('d/m/Y', $view['duetime']);
    $view['addtime'] = (empty($view['addtime'])) ? '-' : nv_date('H:i d/m/Y', $view['addtime']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
    $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $view['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']) . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);

    $xtpl->assign('VIEW', $view);

    if (empty($view['status'])) {
        $xtpl->parse('main.loop.warning');
    }

    if ($view['status'] == 2) {
        $xtpl->parse('main.loop.danger');
    } elseif ($view['status'] == 3) {
        $xtpl->parse('main.loop.success');
    }

    $xtpl->parse('main.loop');
}

if (!empty($workforce_list)) {
    foreach ($workforce_list as $user) {
        $user['selected'] = $user['userid'] == $array_search['workforceid'] ? 'selected="selected"' : '';
        $user['selected1'] = $user['userid'] == $array_search['presenterid'] ? 'selected="selected"' : '';
        $user['selected2'] = $user['userid'] == $array_search['performerid'] ? 'selected="selected"' : '';
        $xtpl->assign('USER', $user);
        $xtpl->parse('main.user');
        $xtpl->parse('main.user1');
        $xtpl->parse('main.user2');
    }
}

foreach ($array_invoice_status as $index => $value) {
    $sl = $index == $array_search['status'] ? 'selected="selected"' : '';
    $xtpl->assign('STATUS', array(
        'index' => $index,
        'value' => $value,
        'selected' => $sl
    ));
    $xtpl->parse('main.status');
}

if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customer');
}

$array_action = array(
    'delete_list_id' => $lang_global['delete'],
    'confirm_payment' => $lang_module['confirm_payment']
);
foreach ($array_action as $key => $value) {
    $xtpl->assign('ACTION', array(
        'key' => $key,
        'value' => $value
    ));
    $xtpl->parse('main.action_top');
    $xtpl->parse('main.action_bottom');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';