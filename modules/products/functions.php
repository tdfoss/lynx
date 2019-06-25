<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 27 Feb 2018 05:52:30 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_PRODUCTS', true);
define( 'NV_IS_MOD_PRODUCT_TYPE', true );
function nv_delete_products($id)
{
    global $db, $module_data;

    $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $id);
}

$_sql = 'SELECT id,title FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat';
$array_type = $nv_Cache->db($_sql, 'id', $module_name);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_price_unit WHERE active=1';
$array_price_unit = $nv_Cache->db($_sql, 'id', $module_name);