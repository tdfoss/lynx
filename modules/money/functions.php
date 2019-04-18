<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2017 mynukeviet. All rights reserved
 * @Createdate Thu, 16 Nov 2017 13:27:56 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_OFFICE', true);

if (!defined('NV_IS_USER')) {
    $url_back = NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    nv_redirect_location($url_back);
}

$array_config = $module_config[$module_name];

$count = 0;
$count_groupmanager = 0;
if (!empty($array_config['workgroup'])) {
    $count = $db->query('SELECT COUNT(*) FROM ' . NV_USERS_GLOBALTABLE . '_groups_users WHERE userid = ' . $user_info['userid'] . ' AND group_id IN (' . $array_config['workgroup'] . ')')->fetchColumn();
}
if (!empty($array_config['groupmanager'])) {
    $count_groupmanager = $db->query('SELECT COUNT(*) FROM ' . NV_USERS_GLOBALTABLE . '_groups_users WHERE userid = ' . $user_info['userid'] . ' AND group_id IN (' . $array_config['groupmanager'] . ')')->fetchColumn();
}

if (empty($count)) {
    $contents = nv_theme_alert($lang_module['title_no_premission'], $lang_module['content_no_premission'], 'danger');
    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
}

$array_money_type = array(
    1 => $lang_module['money_1'],
    2 => $lang_module['money_2']
);

function nv_check_action($addtime)
{
    if (defined('NV_IS_GODADMIN') || ($addtime + (30 * 60))) {
        return true;
    }
    return false;
}

function nv_number_format($number)
{
    return number_format($number);
}

function nv_make_number($price)
{
    $price = preg_replace('/[^0-9\.]/', '', $price);
    $price = doubleval($price);

    return $price;
}