<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

$workforce_list = nv_crm_list_workforce();

function nv_crm_list_workforce()
{
    global $db, $nv_Cache;

    $sql = 'SELECT t1.userid, t2.first_name, t2.last_name, t1.username, t2.main_email email FROM ' . NV_USERS_GLOBALTABLE . ' t1 INNER JOIN ' . NV_PREFIXLANG . '_crm_workforce t2 ON t1.userid=t2.userid';
    $array_data = $nv_Cache->db($sql, 'userid', 'crm');
    if (!empty($array_data)) {
        foreach ($array_data as $index => $value) {
            $array_data[$index]['fullname'] = nv_show_name_user($value['first_name'], $value['last_name'], $value['username']);
        }
    }
    return $array_data;
}

function nv_crm_workforce_info($userid)
{
    global $db;

    $workforce_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_crm_workforce WHERE userid=' . $userid)->fetch();
    if ($workforce_info) {
        $workforce_info['fullname'] = nv_show_name_user($workforce_info['first_name'], $workforce_info['last_name']);
    }

    return $workforce_info;
}
