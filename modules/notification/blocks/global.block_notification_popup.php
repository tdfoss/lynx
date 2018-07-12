<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 10 Sep 2014 09:22:03 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_block_notification_popup')) {

    function nv_block_notification_popup($block_config)
    {
        global $global_config, $db, $site_mods, $module_name, $my_head, $my_footer, $lang_module, $lang_global, $user_info, $nv_Cache;
        
        $module = $block_config['module'];
        $mod_file = $site_mods[$module]['module_file'];
        
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/global.block_notification_popup.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file . '/global.block_notification_popup.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }
        
        if ($module != $module_name) {
            include NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php';
            
            if (file_exists(NV_ROOTDIR . "/themes/" . $block_theme . "/css/" . $mod_file . '.css')) {
                $my_head .= "<link type=\"text/css\" href=\"" . NV_BASE_SITEURL . "themes/" . $block_theme . "/css/" . $mod_file . ".css\" rel=\"stylesheet\" />\n";
            }
            
            if (file_exists(NV_ROOTDIR . '/themes/' . $block_theme . '/js/' . $mod_file . '.js')) {
                $my_footer .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "themes/" . $block_theme . "/js/" . $mod_file . ".js\"></script>\n";
            }
        }
        
        $xtpl = new XTemplate('global.block_notification_popup.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('MODULE_NAME', $module);
        
        if (defined('NV_IS_USER')) {
            $db->sqlreset()
                ->select('*')
                ->from(NV_NOTIFICATION_GLOBALTABLE)
                ->where('language = "' . NV_LANG_DATA . '" AND area=0 AND send_to=' . $user_info['userid']);

            $num_items = $db->query($db->sql())
                ->fetchColumn();
            
            $db->select('*')
                ->order('id DESC')
                ->limit(30);
            
            $_query = $db->query($db->sql());
            
            $count_new = 0;
            while ($row = $_query->fetch()) {
                if (!$row['view']) $count_new++;
                $array_data[$row['id']] = $row;
            }
            
            $xtpl->assign('COUNT', $count_new);
            $xtpl->assign('VIEW_ALL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module);
            
            if (!empty($array_data)) {
                foreach ($array_data as $data) {
                    $data['title'] = $data['link'] = '';
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
                        
                        if (!$data['view']) {
                            $xtpl->parse('main.user.data.loop.view');
                        }
                        
                        $xtpl->parse('main.user.data.loop');
                    }
                }
                $xtpl->parse('main.user.data');
            } else {
                $xtpl->parse('main.user.empty');
            }
            $xtpl->parse('main.user');
        } else {
            $xtpl->parse('main.guest');
        }
        
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_notification_popup($block_config);
}
