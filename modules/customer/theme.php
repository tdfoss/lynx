<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 12:26:59 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

/**
 * nv_theme_customer_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_customer_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;
    
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    
    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_crm_label($array, $label = 'warning')
{
    $html = '';
    foreach ($array as $value) {
        $html .= '<span class="label label-' . $label . '">' . $value . '</span>&nbsp;';
    }
    return $html;
}

function nv_theme_result_import_customer($array_data, $total_row)
{
    global $module_file, $lang_module, $module_info;
    
    $xtpl = new XTemplate('import.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('TOTAL_ROW', $total_row);
    $xtpl->assign('TOTAL_ROW_ERROR', $total_row - count($array_data));
    foreach ($array_data as $data) {
        $xtpl->assign('DATA', $data);
        $xtpl->parse('main.data_customer.data_result.loop');
    }
    $xtpl->parse('main.data_customer.data_result');
    return $xtpl->text('main.data_customer.data_result');
}
