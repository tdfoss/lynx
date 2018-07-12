<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Le Hong Quang (quanglh268@tdfoss.com)
 * @Copyright (C) 2018 Le Hong Quang. All rights reserved
 * @Createdate Wed, 07 Feb 2018 03:04:50 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);

$allow_func = array(
    'main',
    'config',
    'template',
    'template-content'
);