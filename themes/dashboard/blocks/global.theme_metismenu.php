<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 04 May 2014 12:41:32 GMT
 */

if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (defined('NV_IS_FILE_THEMES')) {
    //include config theme
    function nv_block_theme_config_metismenu($module, $data_block, $lang_block)
    {
        global $nv_Cache;
        $html = '';
        $html .= "<div class=\"form-group\">";
        $html .= "	<label class=\"control-label col-sm-6\">" . $lang_block['menu'] . ":</label>";
        $html .= "	<div class=\"col-sm-9\"><select name=\"menuid\" class=\"form-control\">\n";

        $sql = "SELECT * FROM " . NV_PREFIXLANG . "_menu ORDER BY id DESC";
        // Module menu của hệ thống không ảo hóa, do đó chỉ định cache trực tiếp vào module tránh lỗi khi gọi file từ giao diện
        $list = $nv_Cache->db($sql, 'id', 'menu');
        foreach ($list as $l) {
            $sel = ($data_block['menuid'] == $l['id']) ? ' selected' : '';
            $html .= "<option value=\"" . $l['id'] . "\" " . $sel . ">" . $l['title'] . "</option>\n";
        }

        $html .= "	</select></div>\n";
        $html .= "</div>";
        $html .= "<div class=\"form-group\">";
        $html .= "<label class=\"control-label col-sm-6\">";
        $html .= $lang_block['title_length'];
        $html .= ":</label>";
        $html .= "<div class=\"col-sm-18\">";
        $html .= "<input type=\"text\" class=\"form-control\" name=\"config_title_length\" value=\"" . $data_block['title_length'] . "\"/>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    /**
     * nv_block_theme_config_metismenu_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_theme_config_metismenu_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['menuid'] = $nv_Request->get_int('menuid', 'post', 0);
        $return['config']['title_length'] = $nv_Request->get_int('config_title_length', 'post', 24);
        return $return;
    }
}

if (defined('NV_SYSTEM')) {
    function nv_theme_metismenu_blocks($block_config)
    {
        global $nv_Cache, $global_config, $lang_global;

        $list_cats = array();
        $sql = 'SELECT id, parentid, title, link, icon, note, subitem, groups_view, module_name, op, target, css, active_type FROM ' . NV_PREFIXLANG . '_menu_rows WHERE status=1 AND mid = ' . $block_config['menuid'] . ' ORDER BY weight ASC';
        $list = $nv_Cache->db($sql, '', $block_config['module']);

        foreach ($list as $row) {
            if (nv_user_in_groups($row['groups_view'])) {
                if ($row['link'] != '' and $row['link'] != '#') {
                    $row['link'] = nv_url_rewrite(nv_unhtmlspecialchars($row['link']), true);
                    switch ($row['target']) {
                        case 1:
                            $row['target'] = '';
                            break;
                        case 3:
                            $row['target'] = ' onclick="window.open(this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,\');return false;"';
                            break;
                        default:
                            $row['target'] = ' onclick="this.target=\'_blank\'"';
                    }
                } else {
                    $row['target'] = '';
                }
                if (!empty($row['icon']) and file_exists(NV_UPLOADS_REAL_DIR . '/menu/' . $row['icon'])) {
                    $row['icon'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/menu/' . $row['icon'];
                } else {
                    $row['icon'] = NV_BASE_SITEURL.'themes/' . $global_config['module_theme'] . '/images/icons/200396.png';
                }
                $list_cats[$row['id']] = array(
                    'id' => $row['id'],
                    'parentid' => $row['parentid'],
                    'subcats' => $row['subitem'],
                    'title' => $row['title'],
                    'title_trim' => nv_clean60($row['title'], $block_config['title_length']),
                    'target' => $row['target'],
                    'note' => empty($row['note']) ? $row['title'] : $row['note'],
                    'link' => $row['link'],
                    'icon' => $row['icon'],
                    'html_class' => $row['css'],
                    'current' => nv_theme_menu_check_current($row['link'], $row['active_type'])
                );
            }
        }

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/' . $block_config['block_name'] . '.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/' . $block_config['block_name'] . '.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate($block_config['block_name'] . '.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_global);
        $xtpl->assign('BLOCK_THEME', $block_theme);
        $xtpl->assign('BLOCK_CONFIG', $block_config);
        $xtpl->assign('BLOCK_TITLE', $block_config['title']);
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('THEME_SITE_HREF', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA);

        if (!empty($list_cats)) {
            foreach ($list_cats as $cat) {
                if (empty($cat['parentid'])) {
                    if (!empty($cat['subcats'])) {
                        $submenu_active = array();
                        $html_content = nv_theme_smenu_blocks($block_config['block_name'], $list_cats, $cat['subcats'], $submenu_active, $block_theme);
                        $xtpl->assign('HTML_CONTENT', $html_content);
                        if ($html_content != '') {
                            $xtpl->parse('main.loopcat1.cat2');
                            $xtpl->parse('main.loopcat1.expand');
                        }
                        if (!empty($submenu_active)) {
                            $cat['current'] = true;
                        }

                        if ($cat['current']) {
                            $cat['active'] = 'active';
                        }
                    }
                    $cat['class'] = nv_theme_metismenu_blocks_active($cat);

                    $xtpl->assign('CAT1', $cat);
                    if (!empty($cat['icon'])) {
                        $xtpl->parse('main.loopcat1.icon');
                    }
                    $xtpl->parse('main.loopcat1');
                }
            }
            $xtpl->assign('MENUID', $block_config['bid']);
        }

        $xtpl->parse('main');

        return $xtpl->text('main');
    }

    /**
     * nv_theme_metismenu_blocks_active()
     *
     * @param mixed $cat
     * @return
     *
     */
    function nv_theme_metismenu_blocks_active($cat)
    {
        if ($cat['current'] === true and !$cat['html_class']) {
            $class = ' class="current"';
        } elseif ($cat['current'] === false and $cat['html_class']) {
            $class = ' class="' . $cat['html_class'] . '"';
        } elseif ($cat['current'] === true and $cat['html_class']) {
            $class = ' class="' . $cat['html_class'] . ' current"';
        } else {
            $class = '';
        }

        return $class;
    }

    /**
     * nv_theme_menu_check_current()
     *
     * @param mixed $url
     * @param integer $type
     * @return
     *
     */
    function nv_theme_menu_check_current($url, $type = 0)
    {
        global $home, $client_info, $global_config;

        if ($client_info['selfurl'] == $url) {
            return true;
        }
        // Chinh xac tuyet doi

        $_curr_url = NV_BASE_SITEURL . str_replace($global_config['site_url'] . '/', '', $client_info['selfurl']);
        $_url = nv_url_rewrite($url, true);

        if ($home and ($_url == nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA) or $_url == NV_BASE_SITEURL . 'index.php' or $_url == NV_BASE_SITEURL)) {
            return true;
        } elseif ($_url != NV_BASE_SITEURL) {
            if ($type == 2) {
                if (preg_match('#' . preg_quote($_url, '#') . '#', $_curr_url)) {
                    return true;
                }
                return false;
            } elseif ($type == 1) {
                if (preg_match('#^' . preg_quote($_url, '#') . '#', $_curr_url)) {
                    return true;
                }
                return false;
            } elseif ($_curr_url == $_url) {
                return true;
            }
        }

        return false;
    }

    /**
     * nv_theme_smenu_blocks()
     * Hien thi menu con
     *
     * @param mixed $style
     * @param mixed $list_cats
     * @param mixed $list_sub
     * @return
     *
     */
    function nv_theme_smenu_blocks($style, $list_cats, $list_sub, &$submenu_active, $block_theme)
    {
        $xtpl = new XTemplate($style . '.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');

        if (empty($list_sub)) {
            return '';
        } else {
            $list = explode(',', $list_sub);

            foreach ($list_cats as $cat) {
                $catid = $cat['id'];
                if (in_array($catid, $list)) {
                    $list_cats[$catid]['class'] = nv_theme_metismenu_blocks_active($list_cats[$catid]);
                    if ($list_cats[$catid]['current'] === true) {
                        $submenu_active[] = $catid;
                    }

                    $xtpl->assign('MENUTREE', $list_cats[$catid]);
                    if (!empty($list_cats[$catid]['icon'])) {
                        $xtpl->parse('tree.icon');
                    }
                    if (!empty($list_cats[$catid]['subcats'])) {
                        $tree = nv_theme_smenu_blocks($style, $list_cats, $list_cats[$catid]['subcats'], $submenu_active, $block_theme);

                        $xtpl->assign('TREE_CONTENT', $tree);
                        $xtpl->parse('tree.tree_content');
                    }

                    $xtpl->parse('tree');
                }
            }

            return $xtpl->text('tree');
        }
    }
    $content = nv_theme_metismenu_blocks($block_config);
}
