<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 16 Jan 2018 04:11:39 GMT
 */

if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_SERVICES', true);
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

if (isset($workforce_list[$user_info['userid']])) {
    define('CRM_WORKFORCE', true);
} else {
    define('CRM_CUSTOMER', true);
}

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_services WHERE active=1 ORDER BY weight';
$array_services = $nv_Cache->db($_sql, 'id', $module_name);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_price_unit WHERE active=1';
$array_price_unit = $nv_Cache->db($_sql, 'id', $module_name);


function nv_delete_service($id)
{
    global $db, $module_data;

    $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer WHERE id=' . $id);
    if ($count) {
        //
    }
}