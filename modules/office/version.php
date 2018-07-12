<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2017 mynukeviet. All rights reserved
 * @Createdate Thu, 16 Nov 2017 13:27:56 GMT
 */

if (!defined('NV_MAINFILE')) die('Stop!!!');

$module_version = array(
    'name' => 'Office',
    'modfuncs' => 'main,workreport,money,money-content',
    'change_alias' => 'main,workreport,money,money-content',
    'submenu' => 'main,workreport,money',
    'is_sysmod' => 0,
    'virtual' => 1,
    'version' => '1.0.00',
    'date' => 'Thu, 16 Nov 2017 13:27:57 GMT',
    'author' => 'mynukeviet (contact@mynukeviet.com)',
    'uploads_dir' => array(
        $module_name
    ),
    'note' => ''
);