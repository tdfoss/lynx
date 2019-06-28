<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Sat, 07 Apr 2018 03:33:16 GMT
 */
if (!defined('NV_IS_MOD_API')) die('Stop!!!');

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App();

if (isset($site_mods[$array_op[0]])) {
    $module_name = $array_op[0];
    $module_file = $site_mods[$module_name]['module_file'];
    $module_data = $site_mods[$module_name]['module_data'];
    $module_upload = $site_mods[$module_name]['module_upload'];

    if (file_exists(NV_ROOTDIR . '/modules/' . $module_file . '/api.php')) {
        require_once NV_ROOTDIR . '/modules/' . $module_file . '/api.php';
        $app->run();
    }
}
