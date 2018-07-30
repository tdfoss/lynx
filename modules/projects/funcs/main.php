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
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $db->quote($id));
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
    'q' => $nv_Request->get_title('q', 'post,get')
);

if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND title LIKE "%' . $array_search['q'] . '%"
        OR url_code LIKE "%' . $array_search['q'] . '%"
        OR content LIKE "%' . $array_search['q'] . '%"
    ';
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
while ($view = $sth->fetch()) {
    $view['number'] = $number++;
    $view['begintime'] = (empty($view['begintime'])) ? '-' : nv_date('d/m/Y', $view['begintime']);
    $view['endtime'] = (empty($view['endtime'])) ? '-' : nv_date('d/m/Y', $view['endtime']);
    $view['realtime'] = (empty($view['realtime'])) ? '-' : nv_date('d/m/Y', $view['realtime']);
    $view['status'] = $lang_module['status_' . $view['status']];

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
    $xtpl->parse('main.loop');
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

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';