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

if (!defined('NV_CRONJOBS') && !defined('NV_ADMIN') && !defined('NV_IS_USER') && $module_file != 'users' && $op != 'login') {
    $url_back = NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    nv_redirect_location($url_back);
}

if (empty($workforce_list) && $module_name != 'workforce') {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=workforce&notify=1');
}
