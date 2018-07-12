<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Le Hong Quang (quanglh268@tdfoss.com)
 * @Copyright (C) 2018 Le Hong Quang. All rights reserved
 * @Createdate Wed, 07 Feb 2018 03:04:50 GMT
 */

if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_EMAIL', true);
require_once NV_ROOTDIR . '/modules/email/site.functions.php';
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

if (isset($workforce_list[$user_info['userid']])) {
    define('CRM_WORKFORCE', true);
} else {
    define('CRM_CUSTOMER', true);
}

function nv_delete_email($id)
{
    global $db, $module_data, $module_upload;

    $rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if ($rows) {
        $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $id);
        if ($count > 0) {
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sendto  WHERE email_id = ' . $id);
            if (!empty($rows['files']) && file_exists(NV_ROOTDIR . '/' . $rows['files'])) {
                nv_deletefile(NV_ROOTDIR . '/' . $rows['files']);
            }
        }
    }
}