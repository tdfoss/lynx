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
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {

        $userid = $db->query('SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
        $fullname = $workforce_list[$userid]['fullname'];

        nv_customer_delete($id);
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['delete_customer'] . " " . $fullname, $user_info['userid']);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {

            $userid = $db->query('SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
            if ($userid) {
                $array_name[] = $workforce_list[$userid]['fullname'];
            }
            nv_customer_delete($id);
        }
        $printdelete = implode(', ', $array_id);
        nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['delete_many_customer'] . " " . implode(', ', $array_name), $user_info['userid']);
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$join = $where = '';
$array_search = array(
    'q' => $nv_Request->get_title('q', 'post,get'),
    'type_id' => $nv_Request->get_int('type_id', 'post,get', 0),
    'workforceid' => $nv_Request->get_int('workforceid', 'post,get', 0),
    'tag_id' => $nv_Request->get_typed_array('tag_id', 'get', 'int'),
    'is_contact' => $nv_Request->get_int('is_contact', 'get', 0)
);

if (!class_exists('PHPExcel')) {
    if (file_exists(NV_ROOTDIR . '/includes/class/PHPExcel.php')) {
        require_once NV_ROOTDIR . '/includes/class/PHPExcel.php';
    }
}

if ($nv_Request->isset_request('ordername', 'get')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'get');
    $nv_Request->set_Cookie($module_data . '_' . $op . '_ordername', $array_search['ordername']);
} elseif ($nv_Request->isset_request($module_data . '_' . $op . 'ordername', 'cookie')) {
    $array_search['ordername'] = $nv_Request->get_title($module_data . '_' . $op . 'ordername', 'cookie');
} else {
    $array_search['ordername'] = 'first_name';
}

if ($nv_Request->isset_request('ordertype', 'get')) {
    $array_search['ordertype'] = $nv_Request->get_title('ordertype', 'get');
    $nv_Request->set_Cookie($module_data . '_' . $op . 'ordertype', $array_search['ordertype']);
} elseif ($nv_Request->isset_request($module_data . '_' . $op . 'ordername', 'cookie')) {
    $array_search['ordertype'] = $nv_Request->get_title($module_data . '_' . $op . 'ordertype', 'cookie');
} else {
    $array_search['ordertype'] = 'asc';
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;is_contact=' . $array_search['is_contact'];

if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND (first_name LIKE "%' . $array_search['q'] . '%"
        OR last_name LIKE "%' . $array_search['q'] . '%"
        OR CONCAT(last_name," ",first_name) LIKE "%' . $array_search['q'] . '%"
        OR main_phone LIKE "%' . $array_search['q'] . '%"
        OR other_phone LIKE "%' . $array_search['q'] . '%"
        OR main_email LIKE "%' . $array_search['q'] . '%"
        OR other_email LIKE "%' . $array_search['q'] . '%"
        OR facebook LIKE "%' . $array_search['q'] . '%"
        OR skype LIKE "%' . $array_search['q'] . '%"
        OR zalo LIKE "%' . $array_search['q'] . '%"
        OR address LIKE "%' . $array_search['q'] . '%"
    )';
}

if (!empty($array_search['type_id'])) {
    $base_url .= '&type_id=' . $array_search['type_id'];
    $where .= ' AND type_id=' . $array_search['type_id'];
}

if (!empty($array_search['workforceid'])) {
    $base_url .= '&workforceid=' . $array_search['workforceid'];
    $where .= ' AND userid=' . $array_search['workforceid'];
}

if (!empty($array_search['tag_id'])) {
    $join .= ' INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_tags_customer t2 ON t1.id=t2.customerid';
    $base_url .= '&workforceid=' . $array_search['workforceid'];
    $base_url .= implode('&tag_id=', $array_search['tag_id']);
    $where .= ' AND t2.tid IN (' . implode(',', $array_search['tag_id']) . ')';
}

$join .= ' INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc t3 ON t1.id=t3.customerid';
$where .= nv_customer_premission($module_name);
$where .= ' AND is_contacts=' . $array_search['is_contact'] . ' AND t3.userid=' . $user_info['userid'];

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $module_data . ' t1')
    ->join($join)
    ->where('1=1' . $where);

$sth = $db->prepare($db->sql());
$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('t1.*, t3.permisson')
    ->order($array_search['ordername'] . ' ' . $array_search['ordertype'])
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

if ($array_search['is_contact']) {
    $lang_module['customer_add'] = $lang_module['contact_add'];
    $lang_module['manage_customer'] = $lang_module['contact'];
}

$ordertype = $array_search['ordertype'] == 'asc' ? 'desc' : 'asc';
$array_sort_url = array(
    'first_name' => $base_url . '&ordername=first_name&ordertype=' . $ordertype,
    'addtime' => $base_url . '&ordername=addtime&ordertype=' . $ordertype
);

$array_param = array(
    'page' => $page,
    'per_page' => $per_page,
    'where_string' => base64_encode($where),
    'join_string' => base64_encode($join),
    'where_md5' => md5($where . $global_config['sitekey']),
    'ordername' => $array_search['ordername'],
    'ordertype' => $array_search['ordertype']
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content' . ($array_search['is_contact'] ? '&amp;is_contact=1' : ''));
$xtpl->assign('SORTURL', $array_sort_url);
$xtpl->assign('URL_PARAM', http_build_query($array_param));
$xtpl->assign('PAGE', $array_param['page']);

if (class_exists('PHPExcel')) {
    $xtpl->assign('IMPORT_EXCEL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=import&action=' . $module_name);
    $xtpl->parse('main.import');
}

foreach ($array_customer_type_id as $value) {
    $xtpl->assign('TYPEID', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $array_search['type_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_type_id');
}

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
    $xtpl->parse('main.generate_page_top');
}

while ($view = $sth->fetch()) {
    $view['workforce'] = $workforce_list[$view['care_staff']]['fullname'];
    $view['addtime'] = nv_date('H:i d/m/Y', $view['addtime']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'] . '&amp;is_contacts=' . $view['is_contacts'];
    $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $view['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
    $view['type_id'] = !empty($view['type_id']) ? $array_customer_type_id[$view['type_id']]['title'] : '';
    $xtpl->assign('VIEW', $view);

    if($view['permisson'] == 1){
        $xtpl->parse('main.loop.admin');
    }

    $xtpl->parse('main.loop');
}

if ($array_search['ordername'] == 'first_name') {
    $xtpl->parse('main.first_name.' . ($array_search['ordertype'] == 'desc' ? 'desc' : 'asc'));
    $xtpl->parse('main.first_name');
} else {
    $xtpl->parse('main.first_name_no');
}

if ($array_search['ordername'] == 'addtime') {
    $xtpl->parse('main.addtime.' . ($array_search['ordertype'] == 'desc' ? 'desc' : 'asc'));
    $xtpl->parse('main.addtime');
} else {
    $xtpl->parse('main.addtime_no');
}

if (!empty($workforce_list)) {
    foreach ($workforce_list as $workforce) {
        $workforce['selected'] = $workforce['userid'] == $array_search['workforceid'] ? 'selected="selected"' : '';
        $xtpl->assign('WORKFORCE', $workforce);
        $xtpl->parse('main.workforce');
    }
}

if (!empty($array_customer_tags)) {
    foreach ($array_customer_tags as $tags) {
        $tags['selected'] = in_array($tags['tid'], $array_search['tag_id']) ? 'selected="selected"' : '';
        $xtpl->assign('TAGS', $tags);
        $xtpl->parse('main.tags');
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

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';