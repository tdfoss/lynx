<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2017 TDFOSS.,LTD. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 21/07/2017 13:45
 */
if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$sql = 'SELECT * FROM ' . $db_config['prefix'] . '_branch WHERE active=1';
$array_branch = $nv_Cache->db($sql, 'id', 'settings');