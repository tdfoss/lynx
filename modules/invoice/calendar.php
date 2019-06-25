<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 23:45:39 GMT
 */
if (!defined('NV_IS_MOD_CALENDAR')) die('Stop!!!');

require_once NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php';

$result = $db->query('SELECT id, title, duetime FROM ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . ' WHERE status IN (0,3,4) AND workforceid=' . $user_info['userid'] . ' AND duetime > 0 AND duetime >= ' . NV_CURRENTTIME);
while (list ($id, $title, $endtime) = $result->fetch(3)) {
    $array_data[] = array(
        'id' => $id,
        'title' => nv_unhtmlspecialchars($title),
        'start' => date('Y-m-d', $endtime),
        'url' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $mod . '&' . NV_OP_VARIABLE . '=detail&id=' . $id,
        'color' => '#f5c412'
    );
}
