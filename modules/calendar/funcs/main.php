<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2019 mynukeviet. All rights reserved
 * @Createdate Thu, 02 May 2019 10:41:47 GMT
 */
if (!defined('NV_IS_MOD_CALENDAR')) die('Stop!!!');

if ($nv_Request->isset_request('get_event_data', 'post')) {
    $array_data = array();
    foreach ($site_mods as $mod => $arr_mod) {
        if (file_exists(NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/calendar.php')) {
            include NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/calendar.php';
        }
    }
    nv_jsonOutput($array_data);
}

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$array_data = array();

$contents = nv_theme_calendar_main($array_data);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
