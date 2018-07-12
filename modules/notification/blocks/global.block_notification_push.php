<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_block_notification_push')) {

    function nv_block_notification_push($block_config)
    {
        global $module_name, $module_info, $site_mods, $module_config, $lang_global, $global_config, $db;

        $module = $block_config['module'];
        $mod_file = $site_mods[$module]['module_file'];

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/block_notification_push.tpl')) {
            $block_theme = $global_config['module_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('block_notification_push.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('TEMPLATE', $block_theme);
        $xtpl->assign('MAIN_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name);

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_notification_push($block_config);
}