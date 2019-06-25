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

function nv_users_add($username, $password, $email, $first_name, $last_name, $gender, $birthday = 0, $adduser_email = 1)
{
    global $db, $global_config, $user_info, $nv_Cache, $crypt, $lang_module;

    // chế độ import dữ liệu
    $groups_list = nv_groups_list();

    $_user = array();
    $_user['view_mail'] = 0;
    $_user['in_groups'] = array(
        4 // thành viên chính thức
    );
    $_user['in_groups_default'] = 0;
    $_user['is_official'] = 1;

    // xác định nhóm thành viên
    $in_groups = array();
    foreach ($_user['in_groups'] as $_group_id) {
        if ($_group_id > 9) {
            $in_groups[] = $_group_id;
        }
    }
    $_user['in_groups'] = array_intersect($in_groups, array_keys($groups_list));

    if (empty($_user['is_official'])) {
        $_user['in_groups'][] = 7;
        $_user['in_groups_default'] = 7;
    } elseif (empty($_user['in_groups_default']) or !in_array($_user['in_groups_default'], $_user['in_groups'])) {
        $_user['in_groups_default'] = 4;
    }

    if (empty($_user['in_groups_default']) and sizeof($_user['in_groups'])) {
        trigger_error($lang_module['edit_error_group_default']);
        return 0;
    }

    $sql = "INSERT INTO " . NV_USERS_GLOBALTABLE . " (
                    group_id, username, md5username, password, email, first_name, last_name, gender, birthday, sig, regdate,
                    question, answer, passlostkey, view_mail,
                    remember, in_groups, active, checknum, last_login, last_ip, last_agent, last_openid, idsite)
                VALUES (
                    " . $_user['in_groups_default'] . ",
                    :username,
                    :md5_username,
                    :password,
                    :email,
                    :first_name,
                    :last_name,
                    :gender,
                    " . $birthday . ",
                    :sig,
                    " . NV_CURRENTTIME . ",
                    :question,
                    :answer,
                    '',
                     " . $_user['view_mail'] . ",
                     1,
                     '" . implode(',', $_user['in_groups']) . "', 1, '', 0, '', '', '', " . $global_config['idsite'] . "
                )";
    $data_insert = array();
    $data_insert['username'] = $username;
    $data_insert['md5_username'] = nv_md5safe($username);
    $data_insert['password'] = $crypt->hash_password($password, $global_config['hashprefix']);
    $data_insert['email'] = $email;
    $data_insert['first_name'] = $first_name;
    $data_insert['last_name'] = $last_name;
    $data_insert['gender'] = $gender;
    $data_insert['sig'] = '';
    $data_insert['question'] = '';
    $data_insert['answer'] = '';
    $userid = $db->insert_id($sql, 'userid', $data_insert);

    if (!$userid) {
        trigger_error($lang_module['error_unknow']);
        return 0;
    }

    nv_insert_logs(NV_LANG_DATA, 'users', 'log_add_user', 'userid ' . $userid, $user_info['userid']);

    if (!empty($_user['in_groups'])) {
        foreach ($_user['in_groups'] as $group_id) {
            if ($group_id != 7) {
                nv_groups_add_user($group_id, $userid, 1, $module_data);
            }
        }
    }
    $db->query('UPDATE ' . NV_USERS_GLOBALTABLE . '_groups SET numbers = numbers+1 WHERE group_id=' . ($_user['is_official'] ? 4 : 7));
    $nv_Cache->delMod('users');

    // Gửi mail thông báo
    if (!empty($adduser_email)) {
        $full_name = nv_show_name_user($first_name, $last_name, $username);
        $subject = $lang_module['adduser_register'];
        $_url = NV_MY_DOMAIN . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users', true);
        $message = sprintf($lang_module['adduser_register_info1'], $full_name, $global_config['site_name'], $_url, $username, $password);
        @nv_sendmail($global_config['site_email'], $email, $subject, $message);
    }

    return $userid;
}

/**
 * nv_groups_list()
 *
 * @return
 */
function nv_groups_list($mod_data = 'users')
{
    global $nv_Cache;
    $cache_file = NV_LANG_DATA . '_groups_list_' . NV_CACHE_PREFIX . '.cache';
    if (($cache = $nv_Cache->getItem($mod_data, $cache_file)) != false) {
        return unserialize($cache);
    } else {
        global $db, $db_config, $global_config, $lang_global;

        $groups = array();
        $_mod_table = ($mod_data == 'users') ? NV_USERS_GLOBALTABLE : $db_config['prefix'] . '_' . $mod_data;
        $result = $db->query('SELECT group_id, title, idsite FROM ' . $_mod_table . '_groups WHERE (idsite = ' . $global_config['idsite'] . ' OR (idsite =0 AND siteus = 1)) ORDER BY idsite, weight');
        while ($row = $result->fetch()) {
            if ($row['group_id'] < 9) {
                $row['title'] = $lang_global['level' . $row['group_id']];
            }
            $groups[$row['group_id']] = ($global_config['idsite'] > 0 and empty($row['idsite'])) ? '<strong>' . $row['title'] . '</strong>' : $row['title'];
        }
        $nv_Cache->setItem($mod_data, $cache_file, serialize($groups));

        return $groups;
    }
}
