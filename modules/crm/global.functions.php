<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */

if (!defined('NV_MAINFILE')) die('Stop!!!');

$array_config = $module_config[$module_name];
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';

function nv_get_user_info($user_id)
{
    global $module_name, $db;
    $_sql = 'SELECT * FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $user_id;
    $array_users = $db->query($_sql)->fetch();
    $array_users['fullname'] = nv_show_name_user($array_users['first_name'], $array_users['last_name'], $array_users['username']);
    return $array_users;
}