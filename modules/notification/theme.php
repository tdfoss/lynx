<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 06 May 2015 02:22:19 GMT
 */

if (!defined('NV_IS_MOD_NOTIFICATION')) die('Stop!!!');

/**
 * nv_theme_notification_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_notification_main($array_data, $nv_alias_page, $error)
{
    global $global_config, $site_mods, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('MODULE_NAME', $module_name);

    foreach ($array_data as $data) {
        $xtpl->assign('DATA', $data);

        if (!$data['view']) {
            $xtpl->parse('main.loop.view');
        }

        $xtpl->parse('main.loop');
    }

    if (!empty($error)) {
        $xtpl->assign('ERROR', $error);
        $xtpl->parse('main.error');
    }

    if (!empty($nv_alias_page)) {
        $xtpl->assign('PAGE', $nv_alias_page);
        $xtpl->parse('main.alias_page');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

