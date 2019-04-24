<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1-27-2010 5:25
 */
if (!defined('NV_MAINFILE') or !defined('NV_IS_CRON')) {
    die('Stop!!!');
}

function cron_workforce_birthday_reminder()
{
    global $db;

    $array_persons = array();
    $result = $db->query('SELECT first_name,last_name FROM ' . NV_PREFIXLANG . '_workforce WHERE DATE_FORMAT(FROM_UNIXTIME(birthday),"%d%m") = ' . date('dm', NV_CURRENTTIME));
    while (list ($first_name, $last_name) = $result->fetch(3)) {
        $array_persons[] = nv_show_name_user($first_name, $last_name);
    }

    if (!empty($array_persons) && file_exists(NV_ROOTDIR . '/modules/notification/site.functions.php')) {
        require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
        require_once NV_ROOTDIR . '/modules/workforce/site.functions.php';
        require_once NV_ROOTDIR . '/modules/workforce/language/' . NV_LANG_DATA . '.php';
        $content = sprintf($lang_module['remider_birthday'], implode(', ', $array_persons));
        nv_send_notification(array_keys($workforce_list), $content, 'remider_birthday', 'workforce');
    }

    return true;
}