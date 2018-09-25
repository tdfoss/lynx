<?php
use NukeViet\Files\Download;

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

$array_gender = array(
    1 => $lang_module['male'],
    0 => $lang_module['female']
);

function nv_customer_premission($module, $type = 'where')
{
    global $db, $array_config, $user_info;

    $array_userid = array(); // mảng chứa userid mà người này được quản lý
    $groups_admin = explode(',', $array_config['groups_admin']);
    if (!empty(array_intersect($groups_admin, $user_info['in_groups']))) {
        return '';
    }

    // nhóm quản lý thấy tất cả
    $group_manage = !empty($array_config['groups_manage']) ? explode(',', $array_config['groups_manage']) : array();
    $group_manage = array_map('intval', $group_manage);

    if (!empty(array_intersect($group_manage, $user_info['in_groups']))) {
        // kiểm tra tư cách trong nhóm (trưởng nhóm / thành viên nhóm)
        $result = $db->query('SELECT * FROM ' . NV_USERS_GLOBALTABLE . '_groups_users WHERE is_leader=1 AND approved=1 AND userid=' . $user_info['userid']);
        while ($row = $result->fetch()) {
            // lấy danh sách userid thuộc nhóm do người này quản lý
            $_result = $db->query('SELECT userid FROM ' . NV_USERS_GLOBALTABLE . '_groups_users WHERE approved=1 AND group_id=' . $row['group_id']);
            while (list ($userid) = $_result->fetch(3)) {
                $array_userid[] = $userid;
            }
        }
        $array_userid = array_unique($array_userid);

        if ($type == 'where') {
            if (!empty($array_userid)) {
                // nếu là trưởng nhóm, thấy nhân viên do mình quản lý
                $array_userid = implode(',', $array_userid);
                return ' AND (userid IN (' . $array_userid . ') OR care_staff=' . $user_info['userid'] . ')';
            } else {
                // thành viên nhóm nhìn thấy ticket cho mình thực hiện, do mình tạo ra
                return ' AND (userid=' . $user_info['userid'] . ' OR care_staff=' . $user_info['userid'] . ')';
            }
        } elseif ($type == 'array_userid') {
            return $array_userid;
        }
    } else {
        return '';
    }
}

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