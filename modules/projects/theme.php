<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 12 Jan 2018 09:14:06 GMT
 */

if (!defined('NV_IS_MOD_PROJECT')) die('Stop!!!');

/**
 * nv_theme_project_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_project_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_project_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_project_detail($rows, $content_comment, $array_control)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_status;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('ROW', $rows);
    $xtpl->assign('CONTROL', $array_control);

    if (!empty($rows['content'])) {
        $xtpl->parse('main.content');
    }

    if (!empty($content_comment)) {
        $xtpl->assign('COMMENT', $content_comment);
        $xtpl->parse('main.comment');
    }

    foreach ($array_status as $index => $value) {
        $sl = $index == $rows['status'] ? 'selected="selected"' : '';
        $xtpl->assign('STATUS', array(
            'index' => $index,
            'value' => $value,
            'selected' => $sl
        ));
        $xtpl->parse('main.status');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_project_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_project_search($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}