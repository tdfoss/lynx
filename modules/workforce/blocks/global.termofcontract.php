<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (quanglh268@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 05 Feb 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('nv_termofcontract_list')) {

    function nv_block_config_termofcontract($module, $data_block, $lang_block)
    {
        $html = '';

        $html .= '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['before_num_days'] . ':</label>';
        $html .= '	<div class="col-sm-18"><input class="form-control" type="text" name="config_numday" value="' . $data_block['numrow'] . '"/></div>';
        $html .= '</div>';

        return $html;
    }

    function nv_block_config_termofcontract_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['numday'] = $nv_Request->get_int('config_numday', 'post', 10);

        return $return;
    }

    function nv_termofcontract($block_config)
    {
        global $db, $global_config, $site_mods, $module_name, $lang_module, $module_config, $array_config, $array_user;

        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];

        // khai báo thư viện global cho block
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.termofcontract.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.termofcontract.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        if ($module != $module_name) {
            require_once NV_ROOTDIR . '/modules/workforce/language/' . NV_LANG_DATA . '.php';
            require_once NV_ROOTDIR . '/modules/workforce/site.functions.php';
            $array_config = $module_config[$module];
        }

        $days = ($block_config['numday'] * 86400) + NV_CURRENTTIME;

        $list = array();
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . ' WHERE duetime <= ' . $days;
        $result = $db->query($sql);
        while ($row = $result->fetch()) {
            $list[$row['id']] = $row;
        }

        $xtpl = new XTemplate('block.termofcontract.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/workforce');
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('BLOCK_THEME', $block_theme);

        if (!empty($list)) {
            foreach ($list as $view) {
                $view['day_left'] = floor(($view['duetime'] - NV_CURRENTTIME) / 86400);
                $view['duetime'] = date('d/m/Y', $view['duetime']);
                $view['accout_connect'] = nv_show_name_user($array_user[$view['userid']]['first_name'], $array_user[$view['userid']]['last_name'], $array_user[$view['userid']]['username']);
                $view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $mod_data . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
                $xtpl->assign('TASK_VIEW', $view);
                $xtpl->parse('main.task');
            }
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_termofcontract($block_config);
}

