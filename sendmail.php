<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2016 mynukeviet. All rights reserved
 * @Createdate Fri, 30 Dec 2016 01:40:16 GMT
 */
define('NV_SYSTEM', true);

define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __file__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/includes/mainfile.php';
require NV_ROOTDIR . '/includes/core/user_functions.php';

$result = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_sendmail');
while ($row = $result->fetch()) {
    if ($check = nv_check_valid_email($row['from_mail']) == '') {
        $from = $row['from_mail'];
    } else {
        $from = unserialize($row['from_mail']);
    }
    if ($check = nv_check_valid_email($row['to_mail']) == '') {
        $to = $row['to_mail'];
    } else {
        $to = unserialize($row['to_mail']);
    }
    if (nv_sendmail($from, $to, $row['subject'], $row['message'], '', false, false)) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_sendmail WHERE id=' . $row['id']);
    }
}