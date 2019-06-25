<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @copyright 2013
 * @createdate 12/31/2013 0:51
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_HOME', true);

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
        } elseif (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/' . NV_LANG_DATA . '.php')) {
            include NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/' . NV_LANG_DATA . '.php';
        } elseif (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/en.php')) {
            include NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/language/en.php';
        }
    }
    return $lang_module;
}