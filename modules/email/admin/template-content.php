<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2016 mynukeviet. All rights reserved
 * @Createdate Tue, 08 Nov 2016 01:39:51 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $lang_module['template_content'] = $lang_module['template_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_template WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $lang_module['template_content'] = $lang_module['template_add'];

    $row['id'] = 0;
    $row['title'] = '';
    $row['html'] = '';
    $row['image'] = '';
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['html'] = $_POST['html'];
    $row['image'] = $nv_Request->get_title('image', 'post', '');
    if (is_file(NV_DOCUMENT_ROOT . $row['image'])) {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['image'] = '';
    }

    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    } elseif (empty($row['html'])) {
        $error[] = $lang_module['error_required_html'];
    }

    if (empty($error)) {
        try {
            $new_id = 0;
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_template (title, image, weight) VALUES (:title, :image, :weight)';
                $data_insert = array();
                $data_insert['title'] = $row['title'];
                $data_insert['image'] = $row['image'];

                $weight = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_template')->fetchColumn();
                $weight = intval($weight) + 1;
                $data_insert['weight'] = $weight;

                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_template SET title = :title, image = :image WHERE id=' . $row['id']);
                $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
                $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {
                if (!empty($row['html'])) {
                    if (!file_exists(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_name)) {
                        nv_mkdir(NV_ROOTDIR . '/' . NV_ASSETS_DIR, $module_name);
                    }
                    file_put_contents(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_name . '/template_' . $new_id . '.html', $row['html']);
                }
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=template');
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

if (!empty($row['image']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['image'])) {
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
}

if (file_exists(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_name . '/template_' . $row['id'] . '.html')) {
    $row['html'] = file_get_contents(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_name . '/template_' . $row['id'] . '.html');
} else {
    $row['html'] = '';
}

if (defined('NV_EDITOR')) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
$row['html'] = htmlspecialchars(nv_editor_br2nl($row['html']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['html'] = nv_aleditor('html', '100%', '700px', $row['html']);
} else {
    $row['html'] = '<textarea style="width:100%;height:700px" name="html">' . $row['html'] . '</textarea>';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($array_personal)) {
    foreach ($array_personal as $index => $value) {
        $xtpl->assign('PERSONAL', array(
            'index' => $index,
            'value' => $value
        ));
        $xtpl->parse('main.personal');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$set_active_op = 'template';

$page_title = $lang_module['template_content'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
