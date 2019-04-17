<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3/25/2010 18:6
 */

if (!defined('NV_SYSTEM')) {
    die('Stop!!!');
}

global $site_mods, $db_config, $client_info, $global_config, $module_file, $module_name, $user_info, $lang_global, $my_head, $admin_info;

if ($global_config['allowuserlogin']) {
    if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/block.user_theme_button.tpl')) {
        $block_theme = $global_config['module_theme'];
    } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/block.user_theme_button.tpl')) {
        $block_theme = $global_config['site_theme'];
    } else {
        $block_theme = 'default';
    }

    $xtpl = new XTemplate('block.user_theme_button.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');

        if (file_exists(NV_ROOTDIR . '/modules/users/language/' . NV_LANG_INTERFACE . '.php')) {
            include NV_ROOTDIR . '/modules/users/language/' . NV_LANG_INTERFACE . '.php';
        } else {
            include NV_ROOTDIR . '/modules/users/language/vi.php';
        }

        if (file_exists(NV_ROOTDIR . '/' . $user_info['photo']) and !empty($user_info['photo'])) {
            $avata = NV_BASE_SITEURL . $user_info['photo'];
        } else {
            $avata = NV_BASE_SITEURL . 'themes/' . $block_theme . '/images/users/no_avatar.png';
        }

        $user_info['current_login_txt'] = nv_date('d/m, H:i', $user_info['current_login']);

        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
        $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
        $xtpl->assign('URL_LOGOUT', defined('NV_IS_ADMIN') ? 'nv_admin_logout' : 'bt_logout');
        $xtpl->assign('MODULENAME', $module_info['custom_title']);
        $xtpl->assign('AVATA', $avata);
        $xtpl->assign('USER', $user_info);
        $xtpl->assign('WELCOME', defined('NV_IS_ADMIN') ? $lang_global['admin_account'] : $lang_global['your_account']);
        $xtpl->assign('LEVEL', defined('NV_IS_ADMIN') ? $admin_info['level'] : 'user');
        $xtpl->assign('URL_MODULE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users');
        $xtpl->assign('URL_AVATAR', nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=avatar/upd', true));
        $xtpl->assign('URL_HREF', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=');



        $xtpl->parse('signed');
        $content = $xtpl->text('signed');
}