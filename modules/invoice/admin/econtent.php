<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 02 Jun 2015 07:53:31 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$row = array();

if (defined('NV_EDITOR')) {
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['newinvoice'] = $nv_Request->get_editor('econtent_newinvoice', '', NV_ALLOWED_HTML_TAGS);
    $row['newconfirm'] = $nv_Request->get_editor('econtent_newconfirm', '', NV_ALLOWED_HTML_TAGS);
    $row['contentpdf'] = $nv_Request->get_editor('econtent_contentpdf', '', NV_ALLOWED_HTML_TAGS);

    $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_econtent SET econtent = :econtent WHERE action=:action');
    foreach ($row as $config_name => $config_value) {
        $stmt->bindParam(':econtent', $config_value, PDO::PARAM_STR);
        $stmt->bindParam(':action', $config_name, PDO::PARAM_STR);
        $exc = $stmt->execute();
    }

    $nv_Cache->delMod($module_name);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    die();
} else {
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent');
    while ($_row = $result->fetch()) {
        $_row['econtent'] = htmlspecialchars(nv_editor_br2nl($_row['econtent']));
        if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
            $_row['econtent'] = nv_aleditor('econtent_' . $_row['action'], '100%', '300px', $_row['econtent']);
        } else {
            $_row['econtent'] = '<textarea style="width:100%;height:300px" name="econtent_' . $_row['action'] . '">' . $_row['econtent'] . '</textarea>';
        }
        $row[] = $_row;
    }
}

$array_replace = array(
    'CODE' => $lang_module['code'],
    'FULLNAME' => $lang_module['customer_fullname'],
    'WORKFORCE' => $lang_module['workforce_fullname'],
    'CREATETIME' => $lang_module['createtime'],
    'DUETIME' => $lang_module['duetime'],
    'TITLE' => $lang_module['title'],
    'TERMS' => $lang_module['terms'],
    'DESCRIPTION' => $lang_module['description'],
    'STATUS' => $lang_module['status'],
    'TABLE' => $lang_module['list_pro_ser'],
    'TABLE_TRANSACTION' => $lang_module['transaction_history'],
    'URL' => $lang_module['url'],
    'URL_PAYMENT' => $lang_module['url_payment'],
    'LOGO' => $lang_module['logo_site'],
    'SITE_NAME' => $lang_module['site_name'],
    'SITE_DESCRIPTION' => $lang_module['site_description'],
    'CUSTOMER_EMAIL' => $lang_module['customer_email'],
    'CUSTOMER_PHONE' => $lang_module['customer_phone'],
    'CUSTOMER_ADDRESS' => $lang_module['customer_address'],
    'SCORE' => $lang_module['score'],
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

if (!empty($row)) {
    foreach ($row as $value) {
        $value['title'] = $lang_module['econtent_' . $value['action']];
        $xtpl->assign('ROW', $value);
        $xtpl->parse('main.title');
        $xtpl->parse('main.content');
    }
    foreach ($array_replace as $index => $value) {
        $xtpl->assign('NOTE', array(
            'index' => $index,
            'value' => $value
        ));
        $xtpl->parse('main.note');
    }
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['econtent'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
