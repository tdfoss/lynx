<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 06 May 2015 02:22:19 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

$array_config = $module_config['notification'];

function nv_send_notification($array_userid, $content, $type, $module, $url = '')
{
    global $db;

    if (empty($array_userid)) return false;

    foreach ($array_userid as $userid) {
        nv_insert_notification($module, $type, array(
            'content' => $content,
            'url' => $url
        ), 0, $userid, 0, 0);
    }

    // slack
    nv_slack_postMessage($array_userid, $content, $url);

    // onesignal push
    $array_user = array();
    $result = $db->query('SELECT endpoint FROM ' . NV_PREFIXLANG . '_notification_register t1 INNER JOIN ' . NV_USERS_GLOBALTABLE . '_info t2 ON t1.userid=t2.userid WHERE t1.userid IN (' . implode(',', $array_userid) . ') AND t2.notify_type LIKE "%push%"');
    while (list ($endpoint) = $result->fetch(3)) {
        $array_user[] = $endpoint;
    }
    $content = array(
        'en' => strip_tags($content)
    );
    nv_onesignal_push($array_user, $content, $url);
}

function nv_onesignal_push($array_player, $content, $url = '')
{
    global $array_config;

    if (empty($array_config['onesignal_appid'])) {
        return false;
    }

    $fields = array(
        'app_id' => $array_config['onesignal_appid'],
        'include_player_ids' => $array_player,
        'contents' => $content,
        'url' => $url,
        'chrome_web_icon' => 'https://client.tdfoss.vn/uploads/tdfoss-logo-small_256_256.png'
    );

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function nv_slack_postMessage($array_userid, $content, $url = '')
{
    global $db, $module_config, $global_config;

    if (empty($array_userid) || empty($module_config['notification']['slack_tocken'])) {
        return false;
    }

    $size = @getimagesize(NV_ROOTDIR . '/' . $global_config['site_logo']);
    $logo = preg_replace('/\.[a-z]+$/i', '.svg', $global_config['site_logo']);
    if (!file_exists(NV_ROOTDIR . '/' . $logo)) {
        $logo = $global_config['site_logo'];
    }

    $result = $db->query('SELECT slack_id FROM ' . NV_USERS_GLOBALTABLE . '_info WHERE userid IN (' . implode(',', $array_userid) . ') AND slack_id!="" AND notify_type LIKE "%slack%"');
    while (list ($slack_id) = $result->fetch(3)) {
        $ch = curl_init("https://slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => $module_config['notification']['slack_tocken'],
            "channel" => $slack_id,
            "text" => strip_tags($content) . ' ' . $url,
            "username" => $global_config['site_name'],
            "mrkdwn" => true,
            "as_user" => false,
            "icon_url" => NV_MY_DOMAIN . NV_BASE_SITEURL . $logo
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
    }

    return true;
}
