<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 23:45:39 GMT
 */
if (!defined('NV_IS_MOD_CALENDAR')) die('Stop!!!');

require_once NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php';

$result = $db->query('SELECT id, first_name, last_name, birthday FROM ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . ' WHERE status=1 AND birthday > 0');
while (list ($id, $first_name, $last_name, $birthday) = $result->fetch(3)) {
    $array_data[] = array(
        'id' => $id,
        'title' => sprintf($lang_module['calendar_birthday'], nv_show_name_user($first_name, $last_name)),
        'start' => date('Y', NV_CURRENTTIME) . '-' . date('m-d', $birthday),
        'color' => 'red',
        'url' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $mod . '&' . NV_OP_VARIABLE . '=detail&id=' . $id
    );
}