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
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_status, $site_mods, $array_field_config, $custom_fields;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('ROW', $rows);
    $xtpl->assign('CONTROL', $array_control);

    if (defined('NV_TASK')) {
        $xtpl->assign('TASK_LIST', nv_theme_project_task_lisk($rows['id']));
        $xtpl->parse('main.task_list');
    }

    if (!empty($rows['content'])) {
        $xtpl->parse('main.content');
    }

    if (!empty($content_comment)) {
        $xtpl->assign('COMMENT', $content_comment);
        $xtpl->parse('main.comment');
    }

    if (!empty($rows['files'])) {
        foreach ($rows['files'] as $file) {
            $xtpl->assign('FILES', $file);
            if ($file['ext'] == 'pdf') {
                $xtpl->parse('main.files.loop.show_quick_viewpdf');
                $xtpl->parse('main.files.loop.content_quick_viewpdf');
            } elseif (preg_match('/^png|jpe|jpeg|jpg|gif|bmp|ico|tiff|tif|svg|svgz$/', $file['ext'])) {
                $xtpl->parse('main.files.loop.show_quick_viewimg');
                $xtpl->parse('main.files.loop.content_quick_viewimg');
            } elseif (preg_match('/^doc|docx|xls|xlsx|odt$/', $file['ext'])) {
                $xtpl->parse('main.files.loop.show_quick_viewpdf');
                $xtpl->parse('main.files.loop.content_quick_viewdoc');
            } else {
                $xtpl->parse('main.files.loop.show_download');
            }
            $xtpl->parse('main.files.loop');
        }
        $xtpl->parse('main.files');
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

    if (!empty($array_field_config)) {
        foreach ($array_field_config as $row) {
            if ($row['show_profile']) {
                $question_type = $row['field_type'];
                if ($question_type == 'checkbox') {
                    $result = explode(',', $custom_fields[$row['field']]);
                    $value = '';
                    foreach ($result as $item) {
                        $value .= $row['field_choices'][$item] . '<br />';
                    }
                } elseif ($question_type == 'multiselect' or $question_type == 'select' or $question_type == 'radio') {
                    $value = $row['field_choices'][$custom_fields[$row['field']]];
                } elseif ($question_type == 'date') {
                    $value = !empty($custom_fields[$row['field']]) ? nv_date('d/m/Y', $custom_fields[$row['field']]) : '';
                } else {
                    $value = $custom_fields[$row['field']];
                }
                if (empty($value)) {
                    $value = '-';
                }
                $xtpl->assign('FIELD', array(
                    'title' => $row['title'],
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop');
            }
        }
        $xtpl->parse('main.field');
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

/**
 * nv_theme_viewpdf()
 *
 * @param mixed $file_url
 * @return
 */
function nv_theme_viewpdf($file_url)
{
    global $lang_module, $lang_global;
    $xtpl = new XTemplate('viewer.tpl', NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/js/pdf.js');
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('PDF_JS_DIR', NV_BASE_SITEURL . NV_ASSETS_DIR . '/js/pdf.js/');
    $xtpl->assign('PDF_URL', $file_url);
    $xtpl->parse('main');
    return $xtpl->text('main');
}