<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 07 Feb 2018 09:53:57 GMT
 */
if (!defined('NV_IS_MOD_EMAIL')) die('Stop!!!');

$id = $nv_Request->get_int('id', 'post,get', 0);

$row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
if (empty($row)) {
    Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    die();
}

$row['useradd'] = !empty($row['useradd']) ? $workforce_list[$row['useradd']]['fullname'] : $lang_module['system'];

$row['cclist'] = array();
if (!empty($row['cc_id'])) {
    $row['cc_id'] = explode(',', $row['cc_id']);
    foreach ($row['cc_id'] as $ccid) {
        $row['cclist'][] = $workforce_list[$ccid]['fullname'];
    }
    $row['cclist'] = implode(', ', $row['cclist']);
} else {
    $row['cclist'] = '';
}

$row['sendto'] = array();
$result = $db->query('SELECT customer_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sendto WHERE email_id=' . $row['id']);
while (list ($customerid) = $result->fetch(3)) {
    $customer_info = nv_crm_customer_info($customerid);
    $row['sendto'][] = '<a href="' . $customer_info['link_view'] . '">' . $customer_info['fullname'] . '</a>';
}

if (!empty($row['sendto'])) {
    $row['sendto'] = implode(', ', $row['sendto']);
}

$row['addtime'] = nv_date('H:i d/m/Y', $row['addtime']);

if (!empty($row['files'])) {
    $row['files'] = basename($row['files']);
    $row['url_file_download'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=download&amp;id=' . $row['id'];
}

$array_control = array(
    'url_add' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content',
    'url_edit' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $row['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']),
    'url_delete' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $row['id'] . '&amp;delete_checkss=' . md5($row['id'] . NV_CACHE_PREFIX . $client_info['session_id'])
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('EMAILIF', $row);
$xtpl->assign('CONTROL', $array_control);

if (!empty($row['cc_id'])) {
    $xtpl->parse('main.cc');
}

if (!empty($row['files'])) {
    $xtpl->parse('main.file');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $row['title'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';