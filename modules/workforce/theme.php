<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 23:45:39 GMT
 */
if (!defined('NV_IS_MOD_WORKFORCE')) die('Stop!!!');

/**
 * nv_theme_workforce_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_workforce_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_workforce_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_workforce_detail($result, $id)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_field_config, $custom_fields, $client_info, $array_status, $array_user;
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);

    $result['accout_connect'] = nv_show_name_user($array_user[$result['userid']]['first_name'], $array_user[$result['userid']]['last_name'], $array_user[$result['userid']]['username']);
    $result['createtime'] = date('d/m/Y', $result['createtime']);
    $result['duetime'] = date('d/m/Y', $result['duetime']);
    $result['cycle'] = sprintf($lang_module['cycle_month'], $result['cycle']);

    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('URL_EDIT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $id . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']));
    $xtpl->assign('URL_DELETE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $id . '&amp;delete_checkss=' . md5($id . NV_CACHE_PREFIX . $client_info['session_id']));
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('WORKFORCE', $result);

    if (nv_workforce_check_premission() && isset($site_mods['salary'])) {
        $xtpl->assign('URL_APPROVAL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=history-salary&amp;id=' . $id);
        $xtpl->parse('main.salary');
    }

    foreach ($array_status as $data => $value) {
        $selected = $data == $result['status'] ? 'selected = "selected"' : '';
        $xtpl->assign('STATUS', array(
            'data' => $data,
            'value' => $value,
            'selected' => $selected
        ));
        $xtpl->parse('main.status');
    }

    if (!empty($array_salary)) {
        foreach ($array_salary as $approval) {
            $xtpl->assign('APPROVAL', $approval);
            $xtpl->parse('main.approval.loop');
        }
        $xtpl->parse('main.approval');
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