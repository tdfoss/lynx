<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDOSS.,LTD. All rights reserved
 * @Createdate Sat, 20 Oct 2018 03:59:07 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_SALARY', true);

// thu từ module money
$result = $db->query('SELECT date, money FROM ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . '_money WHERE DATE_FORMAT(FROM_UNIXTIME(date),"%Y") = ' . $year . ' AND type=1');
while (list ($date, $amount) = $result->fetch(3)) {
    $array_money_in[intval(date('m', $date))] += $amount;
}

// chi từ module money
$result = $db->query('SELECT date, money FROM ' . NV_PREFIXLANG . '_' . $arr_mod['module_data'] . '_money WHERE DATE_FORMAT(FROM_UNIXTIME(date),"%Y") = ' . $year . ' AND type=2');
while (list ($date, $amount) = $result->fetch(3)) {
    $array_money_out[intval(date('m', $date))] += $amount;
}