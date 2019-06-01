<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 23:45:39 GMT
 */
if (!defined('NV_IS_MOD_WORKFORCE')) die('Stop!!!');

if ($nv_Request->isset_request('change_status', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);

    if (empty($id)) {
        die('NO_' . $id);
    }

    $new_status = $nv_Request->get_int('new_status', 'post');

    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=' . $new_status . ' WHERE id=' . $id;
    $db->query($sql);

    $nv_Cache->delMod($module_name);
    $nv_Cache->delMod('users');

    die('OK_' . $id);
}

$id = $nv_Request->get_int('id', 'get', 0);
$status = $nv_Request->get_int('status', 'get', 0);

$result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id)->fetch();
if (!$result) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

$result['fullname'] = nv_show_name_user($result['first_name'], $result['last_name']);
$result['gender'] = $array_gender[$result['gender']];
$result['addtime'] = nv_date('H:i d/m/Y', $result['addtime']);
$result['edittime'] = !empty($result['edittime']) ? nv_date('H:i d/m/Y', $result['edittime']) : '';
$result['birthday'] = !empty($result['birthday']) ? nv_date('d/m/Y', $result['birthday']) : '';
$result['jointime'] = !empty($result['jointime']) ? nv_date('d/m/Y', $result['jointime']) : '-';

$array_parts_title = array();
$result['part'] = explode(",", $result['part']);
foreach ($result['part'] as $partid) {
    $array_parts_title[] = $array_part_list[$partid]['title'];
}
$result['part'] = implode(", ", $array_parts_title);

if (isset($site_mods['salary'])) {
    $array_salary = array();
    $approval = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_salary_history_salary WHERE userid = ' . $result['userid']);
    while ($row = $approval->fetch()) {
        $row['addtime'] = nv_date('H:i d/m/Y', $row['addtime']);
        $row['salary'] = nv_number_format($row['salary']);
        $row['allowance'] = nv_number_format($row['allowance']);
        $array_salary[$row['id']] = $row;
    }
}

$array_field_config = array();
$result_field = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_field WHERE show_profile=1 ORDER BY weight ASC');
while ($row_field = $result_field->fetch()) {
    $language = unserialize($row_field['language']);
    $row_field['title'] = (isset($language[NV_LANG_DATA])) ? $language[NV_LANG_DATA][0] : $row['field'];
    $row_field['description'] = (isset($language[NV_LANG_DATA])) ? nv_htmlspecialchars($language[NV_LANG_DATA][1]) : '';
    if (!empty($row_field['field_choices'])) {
        $row_field['field_choices'] = unserialize($row_field['field_choices']);
    } elseif (!empty($row_field['sql_choices'])) {
        $row_field['sql_choices'] = explode('|', $row_field['sql_choices']);
        $query = 'SELECT ' . $row_field['sql_choices'][2] . ', ' . $row_field['sql_choices'][3] . ' FROM ' . $row_field['sql_choices'][1];
        $result = $db->query($query);
        $weight = 0;
        while (list ($key, $val) = $result->fetch(3)) {
            $row_field['field_choices'][$key] = $val;
        }
    }
    $array_field_config[] = $row_field;
}
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $id;
$result_field = $db->query($sql);
$custom_fields = $result_field->fetch();

$page_title = $result['fullname'];
$array_mod_title[] = array(
    'title' => $page_title
);

$contents = nv_theme_workforce_detail($result, $id);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';