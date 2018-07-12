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
$app->get('/api/hello/{name}/', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()
        ->write("Hello, $name");

    return $response;
});

if (isset($site_mods[$array_op[0]]) && file_exists(NV_ROOTDIR . '/modules/' . $array_op[0] . '/api.php')) {
    require_once NV_ROOTDIR . '/modules/' . $array_op[0] . '/api.php';
}

$app->run();
