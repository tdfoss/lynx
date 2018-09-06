<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 12 Jan 2018 09:47:27 GMT
 */
if (!defined('NV_IS_MOD_PROJECT')) die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        nv_projects_delete($id);
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            nv_projects_delete($id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$where = '';
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$array_search = array(
    'q' => $nv_Request->get_title('q', 'postG,get'),
    'workforceid' => $nv_Request->get_title('workforceid', 'get', 0),
    'customerid' => $nv_Request->get_int('customerid', 'get', 0),
    'begintime' => $nv_Request->get_string('begintime', 'get', 0),
    'endtime' => $nv_Request->get_int('endtime', 'get', 0),
    'realtime' => $nv_Request->get_int('realtime', 'get', 0),
    'status' => $nv_Request->get_int('status', 'post,get', 0)
);

if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND title LIKE "%' . $array_search['q'] . '%"
        OR url_code LIKE "%' . $array_search['q'] . '%"
        OR content LIKE "%' . $array_search['q'] . '%"
    ';
}
if (!empty($array_search['customerid'])) {
    $base_url .= '&amp;customerid=' . $array_search['customerid'];
    $where .= ' AND customerid=' . $array_search['customerid'];
}

if (!empty($array_search['workforceid'])) {
    $base_url .= '&amp;workforceid= ' . $array_search['workforceid'];
    $where .= ' AND workforceid = ' . $array_search['workforceid'];
}

if ($array_search['status'] > 0) {
    $base_url .= '&amp;status= ' . $array_search['status'];
    $where .= ' AND status = ' . $array_search['status'];
} elseif (!empty($array_config['default_status'])) {
    $where .= ' AND status IN (' . $array_config['default_status'] . ')';
}

if (!empty($array_search['begintime'])) {

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('begintime', 'get'), $m)) {
        $_hour = 23;
        $_min = 23;
        $array_search['begintime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $array_search['begintime'] = 0;
    }
    $base_url .= '&amp;begintime= ' . $array_search['begintime'];
    $where .= ' AND begintime = ' . $array_search['begintime'];
}
if (!empty($array_search['endtime'])) {

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('endtime', 'get'), $m)) {

        $_hour = 23;
        $_min = 23;
        $array_search['endtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $array_search['endtime'] = 0;
    }
    $base_url .= '&amp;endtime= ' . $array_search['endtime'];
    $where .= ' AND endtime = ' . $array_search['endtime'];
}
if (!empty($array_search['realtime'])) {

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('realtime', 'get'), $m)) {

        $_hour = 23;
        $_min = 23;
        $array_search['realtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $array_search['realtime'] = 0;
    }
    $base_url .= '&amp;realtime= ' . $array_search['realtime'];
    $where .= ' AND realtime = ' . $array_search['realtime'];
}
if (!empty($array_search['customerid'])) {
    $customer_info = nv_crm_customer_info($array_search['customerid']);
}

$where .= nv_projects_premission($module_name);

$db->sqlreset()
    ->select('COUNT(*)')
    ->from('' . NV_PREFIXLANG . '_' . $module_data . '')
    ->where('1=1' . $where);
$sth = $db->prepare($db->sql());
$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('*')
    ->order('id DESC')
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
$xtpl->assign('Q', $array_search['q']);
$xtpl->assign('ADD_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content');

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}
$number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
$array_users = array();
while ($view = $sth->fetch()) {
    $view['number'] = $number++;
    $view['begintime'] = (empty($view['begintime'])) ? '-' : nv_date('d/m/Y', $view['begintime']);
    $view['endtime'] = (empty($view['endtime'])) ? '-' : nv_date('d/m/Y', $view['endtime']);
    $view['realtime'] = (empty($view['realtime'])) ? '-' : nv_date('d/m/Y', $view['realtime']);
    $view['status'] = $lang_module['status_select_' . $view['status']];

    $view['performer_str'] = array();
    $performer = !empty($view['workforceid']) ? explode(',', $view['workforceid']) : array();
    foreach ($performer as $userid) {
        $view['performer_str'][] = isset($workforce_list[$userid]) ? $workforce_list[$userid]['fullname'] : '-';
    }
    $view['performer_str'] = !empty($view['performer_str']) ? implode(', ', $view['performer_str']) : '';

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

    $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $view['id'];
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
    $xtpl->assign('VIEW', $view);

    if (!empty($view['files'])) {
        $xtpl->parse('main.loop.files');
    }

    $xtpl->parse('main.loop');
}

if (!empty($workforce_list)) {
    foreach ($workforce_list as $user) {
        $user['selected'] = $user['userid'] == $array_search['workforceid'] ? 'selected="selected"' : '';
        $xtpl->assign('USER', $user);
        $xtpl->parse('main.user');
    }
}

$array_action = array(
    'delete_list_id' => $lang_global['delete']
);
foreach ($array_action as $key => $value) {
    $xtpl->assign('ACTION', array(
        'key' => $key,
        'value' => $value
    ));
    $xtpl->parse('main.action_top');
    $xtpl->parse('main.action_bottom');
}

foreach ($array_status as $index => $value) {
    $selected = $index == $array_search['status'] ? ' selected = "selected" ' : '';
    $xtpl->assign('STATUS', array(
        'index' => $index,
        'value' => $value,
        'selected' => $selected
    ));
    $xtpl->parse('main.status');
}
if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customerid');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';