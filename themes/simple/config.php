<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 17 Apr 2014 04:03:46 GMT
 */
if (!defined('NV_IS_FILE_THEMES')) {
    die('Stop!!!');
}

$config_theme = array();

if ($nv_Request->isset_request('submit', 'post')) {

    $config_theme['theme_layout'] = $nv_Request->get_int('layout', 'post', 0);

    $config_value = array_filter($config_theme);
    $config_value = serialize($config_value);

    if (isset($module_config['themes'][$selectthemes])) {
        $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value= :config_value WHERE config_name = :config_name AND lang = '" . NV_LANG_DATA . "' AND module='themes'");
    } else {
        $sth = $db->prepare("INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . NV_LANG_DATA . "', 'themes', :config_name, :config_value)");
    }
    $sth->bindParam(':config_name', $selectthemes, PDO::PARAM_STR);
    $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR, strlen($config_value));
    $sth->execute();

    if (defined('NV_CONFIG_DIR') and $global_config['idsite'] > 0) {
        if (isset($global_config['sitetimestamp'])) {
            $sitetimestamp = intval($global_config['sitetimestamp']) + 1;
            $db->query("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = '" . $sitetimestamp . "' WHERE lang = 'sys' AND module = 'site' AND config_name = 'sitetimestamp'");
        } else {
            $db->query("INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', 'site', 'sitetimestamp', '1')");
        }
    }

    $nv_Cache->delMod('settings');

    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&selectthemes=' . $selectthemes . '&rand=' . nv_genpass());
    die();
} else {

    $default_config_theme = array(
        'theme_layout' => 0
    );

    if (isset($module_config['themes'][$selectthemes])) {
        $config_theme = unserialize($module_config['themes'][$selectthemes]);
        $config_theme = array_replace_recursive($default_config_theme, $config_theme);
    } else {
        $config_theme = $default_config_theme;
    }
}

$xtpl = new XTemplate('config.tpl', NV_ROOTDIR . '/themes/' . $selectthemes . '/system');
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('NV_ADMIN_THEME', $global_config['admin_theme']);
$xtpl->assign('SELECTTHEMES', $selectthemes);
$xtpl->assign('UPLOADS_DIR', NV_UPLOADS_DIR . '/' . $module_upload);

$array_layout = array(
    0 => $lang_module['layout_0'],
    1 => $lang_module['layout_1']
);
foreach ($array_layout as $key => $value) {
    $xtpl->assign('LAYOUT', array(
        'key' => $key,
        'value' => $value,
        'checked' => $config_theme['theme_layout'] == $key ? ' checked="checked"' : ''
    ));
    $xtpl->parse('main.layout');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');
