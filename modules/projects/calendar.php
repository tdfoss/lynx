<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 23:45:39 GMT
 */
if (!defined('NV_IS_MOD_CALENDAR')) die('Stop!!!');

require_once NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php';

$result = $db->query('SELECT t1.id, t1.title, t1.begintime, t1.endtime FROM ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . ' t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . '_performer t2 ON t1.id=t2.projectid WHERE t1.status IN (1,2,3) AND t2.userid=' . $user_info['userid'] . ' AND t1.begintime > 0 AND t1.endtime > 0');
while (list ($id, $title, $begintime, $endtime) = $result->fetch(3)) {
    $array_data[] = array(
        'id' => $id,
        'title' => $title,
        'start' => date('Y-m-d', $begintime),
        'end' => !empty($endtime) ? date('Y-m-d', $endtime + 86400) : 0,
        'url' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $mod . '&' . NV_OP_VARIABLE . '=detail&id=' . $id,
        'color' => 'green'
    );
}