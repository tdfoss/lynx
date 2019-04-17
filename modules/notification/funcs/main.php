<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 06 May 2015 02:22:19 GMT
 */
if (!defined('NV_IS_MOD_NOTIFICATION')) die('Stop!!!');

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

if (!defined('NV_IS_USER')) {
    Header('Location: ' . NV_BASE_SITEURL);
    die();
}

if ($nv_Request->isset_request('savePlayer', 'post')) {
    $playerID = $nv_Request->get_title('playerID', 'post', '');
    try {
        $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_register(userid, endpoint) VALUES(:userid, :endpoint)');
        $stmt->bindParam(':userid', $user_info['userid'], PDO::PARAM_INT);
        $stmt->bindParam(':endpoint', $playerID, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_register SET endpoint=:endpoint WHERE userid=:userid');
        $stmt->bindParam(':userid', $user_info['userid'], PDO::PARAM_INT);
        $stmt->bindParam(':endpoint', $playerID, PDO::PARAM_STR);
        $stmt->execute();
    }
    die('OK');
}

if ($nv_Request->isset_request('notification_get', 'post')) {
    if (!defined('NV_IS_AJAX')) {
        die('Wrong URL');
    }

    $last_time_call = $nv_Request->get_int('timestamp', 'get', 0);
    $last_time = 0;
    $count = 0;
    $return = array();

    $result = $db->query('SELECT add_time FROM ' . NV_NOTIFICATION_GLOBALTABLE . ' WHERE language="' . NV_LANG_DATA . '" AND area=0 AND view=0 AND module="notification" ORDER BY id DESC');
    $count = $result->rowCount();
    if ($result) {
        $last_time = $result->fetchColumn();
    }

    if ($last_time > $last_time_call) {
        $return = array(
            'data_from_file' => $count,
            'timestamp' => $last_time
        );
    }

    nv_jsonOutput($return);
}

if ($nv_Request->isset_request('change_view', 'post')) {
    $item_id = $nv_Request->get_int('item_id', 'post', 0);
    $db->query('UPDATE ' . NV_NOTIFICATION_GLOBALTABLE . ' SET view=1 WHERE id=' . $item_id . ' AND send_to=' . $user_info['userid']);
}

if ($nv_Request->isset_request('readall', 'post')) {
    $db->query('UPDATE ' . NV_NOTIFICATION_GLOBALTABLE . ' SET view=1 WHERE view = 0 AND send_to=' . $user_info['userid']);
}

$error = '';
$contents = '';
$per_page = 20;
$page = 1;
if (sizeof($array_op) == 1 and preg_match("/^page\-([0-9]+)$/", $array_op[0], $m)) {
    $page = intval($m[1]);
}

if ($page == 1) {
    $error = $lang_module['notification_empty'];
}

$array_data = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;

$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_NOTIFICATION_GLOBALTABLE)
    ->where('language = "' . NV_LANG_DATA . '" AND area=0 AND send_to=' . $user_info['userid']);

$num_items = $db->query($db->sql())
    ->fetchColumn();

$db->select('*')
    ->order('id DESC')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);

$_query = $db->query($db->sql());

while ($row = $_query->fetch()) {
    $array_data[$row['id']] = $row;
}

$i = 0;
$array_notification = array();
if (!empty($array_data)) {
    $error = '';
    foreach ($array_data as $data) {
        $mod = $data['module'];
        if (isset($site_mods[$mod])) {
            $data['content'] = !empty($data['content']) ? unserialize($data['content']) : '';
            if (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/notification.php')) {
                if ($data['send_from'] > 0) {
                    $array_user_info = $db->query('SELECT username, first_name, last_name, photo FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid = ' . $data['send_from'])->fetch();
                    if ($array_user_info) {
                        $array_user_info['full_name'] = nv_show_name_user($array_user_info['first_name'], $array_user_info['last_name'], $array_user_info['username']);
                        $data['send_from'] = !empty($array_user_info['full_name']) ? $array_user_info['full_name'] : $array_user_info['username'];
                    } else {
                        $data['send_from'] = $lang_global['level5'];
                    }

                    if (!empty($array_user_info['photo']) and file_exists(NV_ROOTDIR . '/' . $array_user_info['photo'])) {
                        $data['photo'] = NV_BASE_SITEURL . $array_user_info['photo'];
                    } else {
                        $data['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
                    }
                } else {
                    $data['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
                    $data['send_from'] = $lang_global['level5'];
                }

                include NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/notification.php';
            }

            if (!empty($data['title'])) {
                $data['add_time_iso'] = nv_date(DATE_ISO8601, $data['add_time']);
                $data['add_time'] = nv_date('H:i d/m/Y', $data['add_time']);
            }
            $array_notification[] = $data;
            $i++;
        }
    }
}

$nv_alias_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);

$contents = nv_theme_notification_main($array_notification, $nv_alias_page, $error);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
