<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 05 Feb 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('nv_logs_event')) {

    function nv_logs_event_data($module, $data_block, $lang_block)
    {
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<input type="number" name="config_numrow" class="form-control" value="' . $data_block['numrow'] . '"/>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['height'] . ':</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<input type="number" name="config_height" class="form-control" value="' . $data_block['height'] . '"/>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['system'] . ':</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<input type="checkbox" name="config_system" value="1"/>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    function nv_logs_event_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config']['numrow'] = $nv_Request->get_title('config_numrow', 'post', '20');
        $return['config']['height'] = $nv_Request->get_int('config_height', 'post', '300');
        $return['config']['system'] = $nv_Request->get_int('system', 'post', 0);
        return $return;
    }

    function nv_logs_event($block_config)
    {
        global $db, $db_config, $global_config, $workforce_list, $lang_block;

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.logs_event.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.logs_event.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $where = empty($block_config['system']) ? ' AND userid > 0' : '';
        $array_logs = array();
        $result = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_logs WHERE 1=1 ' . $where . ' ORDER BY id DESC LIMIT ' . $block_config['numrow']);
        while ($logs = $result->fetch()) {
            $logs['log_time'] = nv_date('H:i d/m/Y', $logs['log_time']);
            $logs['fullname'] = !empty($logs['userid']) ? $workforce_list[$logs['userid']]['fullname'] : $lang_block['system'];
            $array_logs[] = $logs;
        }

        $xtpl = new XTemplate('global.logs_event.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_block);
        $xtpl->assign('CONFIG', $block_config);

        if (!empty($array_logs)) {
            foreach ($array_logs as $logs) {
                $xtpl->assign('LOGS', $logs);
                if (!empty($logs['link_acess'])) {
                    $xtpl->parse('main.loop.link');
                }
                $xtpl->parse('main.loop');
            }
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_logs_event($block_config);
}
