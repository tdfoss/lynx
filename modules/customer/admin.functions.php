<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 12:26:59 GMT
 */
if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

$array_config = $module_config[$module_name];

$allow_func = array(
    'main',
    'types',
    'unit',
    'tags',
    'config',
    'fields'
);

function nv_customer_tags_delete($tid)
{
    global $db, $module_data;
    
    $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags  WHERE tid = ' . $tid);
    if ($count) {
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags_customer WHERE tid=' . $tid);
    }
}