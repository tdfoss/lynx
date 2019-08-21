<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 04 Jan 2018 08:08:50 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    $redirect = $nv_Request->get_string('redirect', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        nv_customer_events_delete($id);
        if (!empty($redirect)) {
            $url = nv_redirect_decrypt($redirect);
        } else {
            $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=events';
        }
        nv_redirect_location($url);
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            nv_customer_events_delete($id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$where = '';
$array_search = array(
    'q' => $nv_Request->get_title('q', 'post,get')
);

if ($nv_Request->isset_request('ordername', 'get')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'get');
    $nv_Request->set_Cookie($module_data . '_' . $op . '_ordername', $array_search['ordername']);
} elseif ($nv_Request->isset_request($module_data . '_' . $op . 'ordername', 'cookie')) {
    $array_search['ordername'] = $nv_Request->get_title($module_data . '_' . $op . '_ordername', 'cookie');
} else {
    $array_search['ordername'] = 'eventtime';
}

if ($nv_Request->isset_request('ordertype', 'get')) {
    $array_search['ordertype'] = $nv_Request->get_title('ordertype', 'get');
    $nv_Request->set_Cookie($module_data . '_' . $op . '_ordertype', $array_search['ordertype']);
} elseif ($nv_Request->isset_request($module_data . '_' . $op . '_ordertype', 'cookie')) {
    $array_search['ordertype'] = $nv_Request->get_title($module_data . '_' . $op . '_ordertype', 'cookie');
} else {
    $array_search['ordertype'] = 'desc';
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND (content LIKE "%' . $array_search['q'] . '%")';
}

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_events')
    ->where('1=1' . $where);

$sth = $db->prepare($db->sql());
$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('*')
    ->order($array_search['ordername'] . ' ' . $array_search['ordertype'])
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);

$sth = $db->prepare($db->sql());
$sth->execute();

$ordertype = $array_search['ordertype'] == 'asc' ? 'desc' : 'asc';
$array_sort_url = array(
    'eventtime' => $base_url . '&ordername=eventtime&ordertype=' . $ordertype,
    'addtime' => $base_url . '&ordername=addtime&ordertype=' . $ordertype
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=events-content');
$xtpl->assign('SORTURL', $array_sort_url);

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
    $xtpl->parse('main.generate_page_top');
}

$array_customer = array();
while ($view = $sth->fetch()) {
    if (!isset($array_customer[$view['customer_id']])) {
        $customer_info = nv_crm_customer_info($view['customer_id']);
        $view['customer'] = $customer_info['fullname'];
    } else {
        $view['customer'] = $array_customer[$view['customer_id']];
    }
    $view['user'] = $workforce_list[$view['userid']]['fullname'];
    $view['addtime'] = nv_date('H:i d/m/Y', $view['addtime']);
    $view['eventtime'] = nv_date('H:i d/m/Y', $view['eventtime']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=events-detail&amp;id=' . $view['id'];
    $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=events-content&amp;id=' . $view['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']) . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    $view['events_type'] = $array_customer_events_type[$view['event_type_id']]['title'];
    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');
}

if ($array_search['ordername'] == 'eventtime') {
    $xtpl->parse('main.eventtime.' . ($array_search['ordertype'] == 'desc' ? 'desc' : 'asc'));
    $xtpl->parse('main.eventtime');
} else {
    $xtpl->parse('main.eventtime_no');
}

if ($array_search['ordername'] == 'addtime') {
    $xtpl->parse('main.addtime.' . ($array_search['ordertype'] == 'desc' ? 'desc' : 'asc'));
    $xtpl->parse('main.addtime');
} else {
    $xtpl->parse('main.addtime_no');
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

$page_title = $lang_module['events'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';