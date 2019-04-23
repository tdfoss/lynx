<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 12:26:59 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_CUSTOMER', true);
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

if (isset($workforce_list[$user_info['userid']])) {
    define('CRM_WORKFORCE', true);
} else {
    define('CRM_CUSTOMER', true);
}

$array_config = $module_config[$module_name];

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_types WHERE active=1 ORDER BY weight';
$array_customer_type_id = $nv_Cache->db($_sql, 'id', $module_name);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags ORDER BY tid DESC';
$array_customer_tags = $nv_Cache->db($_sql, 'tid', $module_name);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_units ORDER BY tid DESC';
$array_customer_units = $nv_Cache->db($_sql, 'tid', $module_name);

$array_gender = array(
    2 => $lang_module['unknow'],
    1 => $lang_module['male'],
    0 => $lang_module['female']
);

function nv_customer_export_csv($array_data, $filename = 'customer.csv', $array_heading = array())
{
    $path = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $filename;

    // create a file pointer connected to the output stream
    $output = fopen($path, 'w');

    // output the column headings
    if (!empty($array_heading)) {
        fputcsv($output, $array_heading);
    }

    if (!empty($array_data)) {
        foreach ($array_data as $data) {
            fputcsv($output, array_values($data));
        }
    }

    // output headers so that the file is downloaded rather than displayed
    header("Content-type: text/csv");
    header("Content-disposition: attachment; filename=" . $filename);
    readfile($path);

    fclose($output);
}