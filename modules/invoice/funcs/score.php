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
    $delete_checkss = $nvF_Request->get_string('delete_checkss', 'get');
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

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);
$where = $order = '';

$array_search = array(
    'customerid' => $nv_Request->get_int('customerid', 'get', 0),
    'ordertype' => $nv_Request->get_title('ordertype', 'get', 0)
);

if ($nv_Request->isset_request('ordername', 'get')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'get');
    $nv_Request->set_Cookie('ordername', $array_search['ordername']);
} elseif ($nv_Request->isset_request('ordername', 'cookie')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'cookie');
} else {
    $array_search['ordername'] = 'first_name';
}


if (!empty($array_search['customerid'])) {
    $base_url .= '&amp;customerid=' . $array_search['customerid'];
    $where .= ' AND customerid=' . $array_search['customerid'];
}

if (!empty($array_search['ordertype'])) {
    $base_url .= '&amp;ordertype=' . $array_search['ordertype'];
    $order .= 'score '.$array_search['ordertype'];
}

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_customer t1')
    ->join('RIGHT JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_score t2 ON t1.id=t2.customerid')
    ->where('1=1' . $where);
$sth = $db->prepare($db->sql());

$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('id, first_name, last_name, main_phone, main_email, score')
    ->order($order)
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

$ordertype = $array_search['ordertype'] == 'asc' ? 'desc' : 'asc';

$array_sort_url = array(
    'score' => $base_url . '&ordername=score&ordertype=' . $ordertype
);

$array_param = array(
    'page' => $page,
    'per_page' => $per_page,
    'where_string' => base64_encode($where),
    'where_md5' => md5($where . $global_config['sitekey']),
    'ordertype' => $array_search['ordertype']
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('SORTURL', $array_sort_url);
$xtpl->assign('BASE_URL', $base_url);

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

while ($view = $sth->fetch()) {
    $view['money'] = nv_invoice_score_to_money($view['score']);
    $view['score'] = nv_number_format($view['score']);
    $view['fullname'] = nv_show_name_user($view['first_name'], $view['last_name']);
    $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=invoice' . '&amp;' . NV_OP_VARIABLE . '=score-history&amp;customerid=' . $view['id'];
    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');

}

if ($array_search['ordername'] == 'score') {
    $xtpl->parse('main.first_name.' . ($array_search['ordertype'] == 'desc' ? 'desc' : 'asc'));
    $xtpl->parse('main.first_name');
} else {
    $xtpl->parse('main.first_name_no');
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

$page_title = $lang_module['score'];

$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';