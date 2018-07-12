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

    // onesignal push
    $array_user = array();
    $result = $db->query('SELECT endpoint FROM ' . NV_PREFIXLANG . '_notification_register WHERE userid IN (' . implode(',', $array_userid) . ')');
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
