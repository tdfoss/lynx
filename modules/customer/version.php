<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 12:26:59 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

$module_version = array(
    'name' => 'Customer',
    'modfuncs' => 'main,detail,content,import, export',
    'change_alias' => '',
    'submenu' => 'main',
    'is_sysmod' => 1,
    'virtual' => 0,
    'version' => '1.0.00',
    'date' => 'Sat, 5 May 2018 12:26:59 GMT',
    'author' => 'TDFOSS.,LTD (contact@tdfoss.vn)',
    'uploads_dir' => array(
        $module_upload
    ),
    'note' => ''
);