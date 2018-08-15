<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 22 Nov 2017 13:34:56 GMT
 */

if (!defined('NV_IS_MOD_OFFICE')) die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_money  WHERE id = ' . $id);
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['delete'], 'ID: ' . $id, $user_info['userid']);
        $nv_Cache->delMod($module_name);
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['money']);
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_money  WHERE id = ' . $id);
        }
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['delete'], 'ID: ' . $listall, $user_info['userid']);
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$array_search = array(
    'type' => $nv_Request->get_int('type', 'get', 1),
    'from' => $nv_Request->get_string('from', 'get', ''),
    'to' => $nv_Request->get_string('to', 'get', '')
);

$where = ' AND type=' . $array_search['type'];
$base_url .= '&type=' . $array_search['type'];

if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $array_search['from'], $m)) {
    $base_url .= '&from=' . $array_search['from'];
    $where .= ' AND date >= ' . mktime(0, 0, 0, $m[2], $m[1], $m[3]);
}

if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $array_search['to'], $m)) {
    $base_url .= '&to=' . $array_search['to'];
    $where .= ' AND date <= ' . mktime(23, 59, 59, $m[2], $m[1], $m[3]);
}

$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$db->sqlreset()
->select('COUNT(*)')
->from(NV_PREFIXLANG . '_' . $module_data . '_money')
->where('1=1' . $where);

$sth = $db->prepare($db->sql());

$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('*')
->order('date DESC, addtime DESC')
->limit($per_page)
->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

$lang_module['money_add'] = $lang_module['money_' . $array_search['type'] . '_add'];
$lang_module['money_date'] = $lang_module['money_' . $array_search['type'] . '_date'];
$lang_module['money_type'] = $lang_module['money_type_' . ($array_search['type'] == 1 ? 2 : 1)];

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('BASE_URL', $base_url);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '&amp;type=' . $array_search['type'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']));
$xtpl->assign('URL_LIST', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;type=' . ($array_search['type'] == 1 ? 2 : 1));

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

$array_user = array();
while ($view = $sth->fetch()) {
    if (!isset($array_user[$view['userid']])) {
        $user = $db->query('SELECT first_name, last_name, username FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $view['userid'])->fetch();
        $view['fullname'] = nv_show_name_user($user['first_name'], $user['last_name'], $user['username']);
        $array_user[$view['userid']] = $view['fullname'];
    } else {
        $view['fullname'] = $array_user[$view['userid']];
    }

    if (nv_check_action($view['addtime'])) {
        $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '&amp;id=' . $view['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
        $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']) . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    }

    $view['date'] = !empty($view['date']) ? nv_date('d/m/Y', $view['date']) : '';
    $view['addtime'] = !empty($view['addtime']) ? nv_date('H:i d/m/Y', $view['addtime']) : '';
    $view['money'] = nv_number_format($view['money']);
    $xtpl->assign('VIEW', $view);

    if (nv_check_action($view['addtime'])) {
        $xtpl->parse('main.loop.admin');
    }

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

if (!$global_config['rewrite_enable']) {
    $xtpl->assign('ACTION', NV_BASE_SITEURL . 'index.php');
} else {
    $xtpl->assign('ACTION', nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['money'], true));
}

if (!$global_config['rewrite_enable']) {
    $xtpl->parse('main.no_rewrite');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['money_type_' . $array_search['type']];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';