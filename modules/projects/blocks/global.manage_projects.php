<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (quanglh268@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 05 Feb 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('nv_projects_list')) {

    function nv_block_config_projects_list($module, $data_block, $lang_block)
    {
        $html = '';

        $array_updown = array(
            'addtime' => $lang_block['updown1'],
            'edittime' => $lang_block['updown2']
        );

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['updown'] . ':</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<select class="form-control col-sm-18" name="config_updown">';
        foreach ($array_updown as $index => $value) {
            $se = ($index == $data_block['updown']) ? 'selected="selected"' : '';
            $html .= '<option name="config_updown[]" value="' . $index . '" ' . $se . '> ' . $value . ' </option>';
        }

        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
        $html .= '	<div class="col-sm-18"><input class="form-control" type="text" name="config_numrow" value="' . $data_block['numrow'] . '"/></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['characters'] . ':</label>';
        $html .= '	<div class="col-sm-18"><input class="form-control" type="text" name="config_characters" value="' . $data_block['characters'] . '"/></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['type'] . ':</label>';
        $html .= '<div class="col-sm-9">';

        $aray_status = array(
            0 => $lang_block['notyet'],
            1 => $lang_block['started'],
            2 => $lang_block['waitingfeedback'],
            3 => $lang_block['completed'],
            4 => $lang_block['delivered'],
            5 => $lang_block['cancelled']
        );

        foreach ($aray_status as $index => $value) {
            $se = in_array($index, $data_block['type']) ? 'checked="checked"' : '';
            $html .= '<div class="checkbox"><label><input type="checkbox" name="config_type[]" value="' . $index . '" ' . $se . '> ' . $value . ' </label></div>';
        }

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    function nv_block_config_projects_list_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 10);
        $return['config']['characters'] = $nv_Request->get_int('config_characters', 'post', 100);
        $return['config']['type'] = $nv_Request->get_typed_array('config_type', 'post', 'int');
        $return['config']['updown'] = $nv_Request->get_string('config_updown', 'post', 'addtime');
        return $return;
    }

    function nv_projects_list($block_config)
    {
        global $global_config, $site_mods, $nv_Cache, $module_name, $my_footer, $lang_module;

        if (empty($block_config['type'])) {
            return '';
        }

        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.manage_projects.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.manage_projects.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        if ($module != $module_name) {
            include NV_ROOTDIR . '/modules/projects/language/' . NV_LANG_DATA . '.php';
            $my_footer .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . 'themes/' . $block_theme . '/js/projects.js"></script>';
        }

        $sql = 'SELECT id, title, status, addtime, edittime FROM ' . NV_PREFIXLANG . '_' . $mod_data . ' WHERE status IN (' . implode(',', $block_config['type']) . ')  ORDER BY ' . $block_config['updown'] . ' DESC  LIMIT ' . $block_config['numrow'];
        $list = $nv_Cache->db($sql, 'id', $module);

        $xtpl = new XTemplate('block.manage_projects.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/projects');
        $xtpl->assign('BLOCK_THEME', $block_theme);

        if (!empty($list)) {
            foreach ($list as $view) {
                $view['title'] = nv_clean60($view['title'], $block_config['characters']);
                $view['status'] = $lang_module['status_select_' . $view['status']];
                $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $mod_data . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
                $xtpl->assign('PROJECTS_VIEW', $view);
                $xtpl->parse('main.projects');
            }
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_projects_list($block_config);
}