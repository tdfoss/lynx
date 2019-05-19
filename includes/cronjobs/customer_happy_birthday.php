<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1-27-2010 5:25
 */
if (!defined('NV_MAINFILE') or !defined('NV_IS_CRON')) {
    die('Stop!!!');
}

function cron_customer_happy_birthday()
{
    global $db, $nv_Cache;

    $array_care_staff = $array_typeid = $array_customer = array();
    $result = $db->query('SELECT id, first_name, last_name, type_id, care_staff FROM ' . NV_PREFIXLANG . '_customer WHERE DATE_FORMAT(FROM_UNIXTIME(birthday),"%d%m%Y") = ' . date('dmY', NV_CURRENTTIME) . ' AND type_id > 0');
    while ($row = $result->fetch()) {
        $row['fullname'] = nv_show_name_user($row['first_name'], $row['last_name']);
        $array_customer[$row['id']] = $row;
        $array_typeid[] = $row['type_id'];
        $array_care_staff[$row['care_staff']][] = $row['fullname'];
    }

    if (!empty($array_customer)) {
        // thông báo danh sách khách hàng sinh nhật hôm nay cho người chăm sóc
        if (!empty($array_care_staff) && file_exists(NV_ROOTDIR . '/modules/notification/site.functions.php')) {
            foreach ($array_care_staff as $index => $value) {
                require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                require_once NV_ROOTDIR . '/modules/customer/language/' . NV_LANG_DATA . '.php';
                $content = sprintf($lang_module['remider_birthday'], implode(', ', $value));
                nv_send_notification(array(
                    $index
                ), $content, 'remider_birthday', 'customer');
            }
        }

        // gửi email đến khách hàng
        require_once NV_ROOTDIR . '/modules/customer/site.functions.php';
        $array_typeid = array_unique($array_typeid);

        $sql = 'SELECT id, birthday_title, birthday_content FROM ' . NV_PREFIXLANG . '_customer_types WHERE id IN (' . implode(',', $array_typeid) . ')';
        $array_content = $nv_Cache->db($sql, 'id', 'customer');

        if (!empty($array_content)) {
            foreach ($array_customer as $customerid => $customer) {
                require_once NV_ROOTDIR . '/modules/email/site.functions.php';
                $subject = nv_unhtmlspecialchars($array_content[$customer['type_id']]['birthday_title']);
                $message = nv_unhtmlspecialchars($array_content[$customer['type_id']]['birthday_content']);
                $array_replace = array(
                    'FIRSTNAME' => $customer['first_name'],
                    'LASTNAME' => $customer['last_name'],
                    'FULLNAME' => $customer['fullname']
                );

                foreach ($array_replace as $index => $value) {
                    $subject = str_replace('[' . $index . ']', $value, $subject);
                    $message = str_replace('[' . $index . ']', $value, $message);
                }

                nv_email_send($subject, $message, 0, array(
                    $customerid
                ), array(), array(), 0, array(), false);
            }
        }
    }

    return true;
}