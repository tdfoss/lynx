<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 12 Jan 2018 09:14:06 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_PROJECT', true);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

if (!defined('NV_IS_USER')) {
    $url_back = NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    nv_redirect_location($url_back);
}

if (isset($site_mods['task'])) {
    define('NV_TASK', true);
    $array_task_status = array(
        0 => $lang_module['task_status_0'],
        1 => $lang_module['task_status_1'],
        2 => $lang_module['task_status_2']
    );
}
$array_status = array(
    1 => $lang_module['status_select_1'],
    2 => $lang_module['status_select_2'],
    3 => $lang_module['status_select_3'],
    4 => $lang_module['status_select_4'],
    5 => $lang_module['status_select_5'],
    6 => $lang_module['status_select_6']
);

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_types WHERE active=1 ORDER BY weight';
$array_working_type_id = $nv_Cache->db($_sql, 'id', $module_name);

function nv_number_format($number)
{
    return number_format($number);
}

/**
 * nv_theme_project_task_lisk()
 *
 * @param mixed $projectid
 * @return
 */
function nv_theme_project_task_lisk($projectid)
{
    global $db, $module_data, $module_file, $lang_module, $module_config, $module_info, $array_task_status, $workforce_list;

    $array_data = $db->query('SELECT t2.* FROM ' . NV_PREFIXLANG . '_' . $module_data . '_task t1 INNER JOIN ' . NV_PREFIXLANG . '_task t2 ON t1.taskid=t2.id WHERE t1.projectid=' . $projectid . ' ORDER BY begintime')->fetchAll();

    $xtpl = new XTemplate('detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    if (!empty($array_data)) {
        $i = 1;
        foreach ($array_data as $task) {
            $task['number'] = $i++;
            $task['status'] = $array_task_status[$task['status']];
            $task['begintime'] = !empty($task['begintime']) ? nv_date('d/m/Y', $task['begintime']) : '-';
            $task['endtime'] = !empty($task['endtime']) ? nv_date('d/m/Y', $task['endtime']) : '-';

            $task['performer_str'] = array();
            $performer = !empty($task['performer']) ? explode(',', $task['performer']) : array();
            foreach ($performer as $userid) {
                $task['performer_str'][] = isset($workforce_list[$userid]) ? $workforce_list[$userid]['fullname'] : '-';
            }
            $task['performer_str'] = !empty($task['performer_str']) ? implode(', ', $task['performer_str']) : '';
            $task['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=task&amp;' . NV_OP_VARIABLE . '=detail&id=' . $task['id'];

            $xtpl->assign('TASK', $task);
            $xtpl->parse('task_list.loop');
        }
    }

    $xtpl->parse('task_list');
    return $xtpl->text('task_list');
}