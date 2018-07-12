<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 06 May 2015 02:22:19 GMT
 */

if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_NOTIFICATION', true);

/**
 * nv_get_lang_module()
 *
 * @param mixed $mod
 * @return
 */
function nv_get_lang_module($mod)
{
    global $site_mods;

    $lang_module = array();

    if (isset($site_mods[$mod])) {
        if (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php')) {
            include NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php';
        }
    }
    return $lang_module;
}