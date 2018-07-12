<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 25 Feb 2018 01:48:25 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$row = array();
$error = array();
$array_workfollow_field = array();

$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM nv4_vi_workflows WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['module'] = $nv_Request->get_title('module', 'get', '');
    $row['title'] = 'test workfollows';
    $row['trigger'] = 1;
    $row['conditions'] = '';
    $row['action'] = '';
    $row['description'] = '';
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['module'] = $nv_Request->get_title('module', 'post', '');
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['trigger'] = $nv_Request->get_int('trigger', 'post', 0);
    $row['conditions'] = $nv_Request->get_string('conditions', 'post', '');
    $row['action'] = $nv_Request->get_string('action', 'post', '');
    $row['description'] = $nv_Request->get_string('description', 'post', '');

    if (empty($row['module'])) {
        $error[] = $lang_module['error_required_module'];
    } elseif (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    } elseif (empty($row['trigger'])) {
        $error[] = $lang_module['error_required_trigger'];
    } elseif (empty($row['conditions'])) {
        $error[] = $lang_module['error_required_conditions'];
    } elseif (empty($row['action'])) {
        $error[] = $lang_module['error_required_action'];
    }

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO nv4_vi_workflows (module, title, trigger, conditions, action, description) VALUES (:module, :title, :trigger, :conditions, :action, :description)');
            } else {
                $stmt = $db->prepare('UPDATE nv4_vi_workflows SET module = :module, title = :title, trigger = :trigger, conditions = :conditions, action = :action, description = :description WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':module', $row['module'], PDO::PARAM_STR);
            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
            $stmt->bindParam(':trigger', $row['trigger'], PDO::PARAM_INT);
            $stmt->bindParam(':conditions', $row['conditions'], PDO::PARAM_STR, strlen($row['conditions']));
            $stmt->bindParam(':action', $row['action'], PDO::PARAM_STR, strlen($row['action']));
            $stmt->bindParam(':description', $row['description'], PDO::PARAM_STR, strlen($row['description']));

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

if (file_exists(NV_ROOTDIR . '/modules/' . $site_mods[$row['module']]['module_file'] . '/workfollows.php')) {
    require_once NV_ROOTDIR . '/modules/' . $site_mods[$row['module']]['module_file'] . '/workfollows.php';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_trigger as $index => $value) {
    $sl = $index == $row['trigger'] ? 'checked="checked"' : '';
    $xtpl->assign('TRIGGER', array(
        'index' => $index,
        'value' => $value,
        'checked' => $sl
    ));
    $xtpl->parse('main.trigger');
}

foreach ($array_flag as $index => $value) {
    //$sl = $index == $row['flag'] ? 'checked="checked"' : '';
    $xtpl->assign('FLAG', array(
        'index' => $index,
        'value' => $value,
        'checked' => $sl
    ));
    $xtpl->parse('main.flag1');
    $xtpl->parse('main.flag2');
}

if (!empty($array_workfollow_field)) {
    foreach ($array_workfollow_field as $field) {
        $xtpl->assign('FIELD', $field);
        $xtpl->parse('main.field1');
        $xtpl->parse('main.field2');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['content'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';