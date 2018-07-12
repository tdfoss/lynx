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

if (!nv_function_exists('nv_block_notification')) {

    function nv_block_notification($block_config)
    {
        global $module_name, $module_info, $site_mods, $module_config, $lang_global, $global_config, $db;
        
        $module = $block_config['module'];
        $mod_file = $site_mods[$module]['module_file'];
        
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/block_notification.tpl')) {
            $block_theme = $global_config['module_theme'];
        } else {
            $block_theme = 'default';
        }
        
        if ($module_name == $module) {
            return '';
        } elseif (file_exists(NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php')) {
            require_once NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php';
        }
        
        $xtpl = new XTemplate('block_notification.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
        $xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
        $xtpl->assign('URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module);
        
        $db->sqlreset()
            ->select('*')
            ->from(NV_NOTIFICATION_GLOBALTABLE)
            ->where('language = "' . NV_LANG_DATA . '" AND area=0')
            ->order('id DESC')
            ->limit(20);
        
        $_result = $db->query($db->sql());
        
        while ($data = $_result->fetch()) {
            $mod = $data['module'];
            if (isset($site_mods[$mod])) {
                $data['content'] = !empty($data['content']) ? unserialize($data['content']) : '';
                if (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/notification.php')) {
                    if ($data['send_from'] > 0) {
                        $array_user_info = $db->query('SELECT username, first_name, last_name, photo FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid = ' . $data['send_from'])->fetch();
                        if ($array_user_info) {
                            $array_user_info['full_name'] = nv_show_name_user($array_user_info['first_name'], $array_user_info['last_name'], $array_user_info['username']);
                            $data['send_from'] = !empty($array_user_info['full_name']) ? $array_user_info['full_name'] : $array_user_info['username'];
                        } else {
                            $data['send_from'] = $lang_global['level5'];
                        }
                        
                        if (!empty($array_user_info['photo']) and file_exists(NV_ROOTDIR . '/' . $array_user_info['photo'])) {
                            $data['photo'] = NV_BASE_SITEURL . $array_user_info['photo'];
                        } else {
                            $data['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
                        }
                    } else {
                        $data['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
                        $data['send_from'] = $lang_global['level5'];
                    }
                    
                    include NV_ROOTDIR . '/modules/' . $site_mods[$mod]['module_file'] . '/notification.php';
                }
                
                if (!empty($data['title'])) {
                    $data['add_time_iso'] = nv_date(DATE_ISO8601, $data['add_time']);
                    $data['add_time'] = nv_date('H:i d/m/Y', $data['add_time']);
                }
                
                $xtpl->assign('DATA', $data);
                $xtpl->parse('main.loop');
            }
        }
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_notification($block_config);
}