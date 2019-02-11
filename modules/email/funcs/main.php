<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 07 Feb 2018 09:53:43 GMT
 */
if (!defined('NV_IS_MOD_EMAIL')) die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    $fullname = $workforce_list[$user_info['userid']]['fullname'];
    
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $title = nv_delete_email($id);
        
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_delete_email'], sprintf($lang_module['logs_delete_email_note'], $fullname, $title), $user_info['userid']);
        
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);
    $fullname = $workforce_list[$user_info['userid']]['fullname'];
    
    $array_title = array();
    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            $array_title[] = nv_delete_email($id);
        }
        
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_delete_email'], sprintf($lang_module['logs_delete_email_note'], $fullname, implode(', ', $array_title)), $user_info['userid']);
        
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$row = array();
$error = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$where = '';

$array_search = array(
    'q' => $nv_Request->get_title('q', 'post,get'),
    'status' => $nv_Request->get_int('status', 'post,get', 1)
);

if (!empty($array_search['q'])) {
    $base_url .= '&amp;q=' . $array_search['q'];
    $where .= ' AND (title LIKE "%' . $array_search['q'] . '%"
        OR useradd LIKE "%' . $array_search['q'] . '%"
        OR addtime LIKE "%' . $array_search['q'] . '%"
    )';
}

if ($array_search['status'] >= 0) {
    $where .= ' AND status=' . $array_search['status'];
}

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
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content');

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
if (!empty($q)) {
    $base_url .= '&q=' . $q;
}

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

foreach ($array_email_status as $key => $value) {
    $xtpl->assign('STATUS', array(
        'key' => $key,
        'value' => $value,
        'selected' => ($key == $array_search['status']) ? 'selected = "selected"' : ''
    ));
    $xtpl->parse('main.status');
}

while ($view = $sth->fetch()) {
    if (!empty($view['useradd'])) {
        $view['useradd'] = $workforce_list[$view['useradd']]['fullname'];
    } else {
        $view['useradd'] = $lang_module['system'];
    }
    $view['addtime'] = nv_date('H:i d/m/Y', $view['addtime']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
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