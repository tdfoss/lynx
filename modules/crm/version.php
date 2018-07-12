<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */

if (!defined('NV_MAINFILE')) die('Stop!!!');

$module_version = array(
    'name' => 'Crm',
    'modfuncs' => 'main,detail,search,workforce,workforce-content,contacts_main,contacts_form,contacts_detail',
    'change_alias' => '',
    'submenu' => 'workforce,contacts_main,contacts_form',
    'is_sysmod' => 1,
    'virtual' => 1,
    'version' => '1.0.00',
    'date' => 'Tue, 2 Jan 2018 08:34:29 GMT',
    'author' => 'TDFOSS.,LTD (contact@tdfoss.vn)',
    'uploads_dir' => array(
        $module_name
    ),
    'note' => ''
);