<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 16 Jan 2018 04:11:39 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);

$allow_func = array(
    'main',
    'config'
);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_price_unit WHERE active=1';
$array_price_unit = $nv_Cache->db($_sql, 'id', $module_name);