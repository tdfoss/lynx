<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 02 Jan 2018 08:50:17 GMT
 */
if (!defined('NV_IS_MOD_PRODUCTS')) die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $lang_module['products_add'] = $lang_module['products_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['title'] = '';
    $row['catid'] = '';
    $row['price'] = '';
    $row['price_unit'] = '';
    $row['note'] = '';
    $row['vat'] = 0;
    $row['url'] = '';
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['catid'] = $nv_Request->get_title('catid', 'post', '');
    $row['price'] = $nv_Request->get_title('price', 'post', '');
    $row['vat'] = $nv_Request->get_float('vat', 'post', 0);
    $row['price_unit'] = $nv_Request->get_title('price_unit', 'post', 0);
    $row['url'] = $nv_Request->get_title('url', 'post', '');
    $row['note'] = $nv_Request->get_textarea('note', '', NV_ALLOWED_HTML_TAGS);
    $row['price'] = floatval(preg_replace('/[^0-9.]/', '', $row['price']));
    
    
    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    }
    
    if (!empty($row['price_unit'])) {
        if (!is_numeric($row['price_unit'])) {
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_price_unit(title) VALUES (:title)';
            $data_insert = array(
                'title' => $row['price_unit']
            );
            $row['price_unit'] = $db->insert_id($_sql, 'id', $data_insert);
        }
    }
    
    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (title, catid, price, vat, price_unit, url, note) VALUES (:title, :catid, :price, :vat, :price_unit, :url, :note)');
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET title = :title, catid = :catid, price = :price, vat = :vat, price_unit = :price_unit, url = :url, note = :note WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
            $stmt->bindParam(':catid', $row['catid'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $row['price'], PDO::PARAM_STR);
            $stmt->bindParam(':vat', $row['vat'], PDO::PARAM_STR);
            $stmt->bindParam(':price_unit', $row['price_unit'], PDO::PARAM_INT);
            $stmt->bindParam(':url', $row['url'], PDO::PARAM_STR);
            $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
            
            $exc = $stmt->execute();
            
            if ($exc) {
                
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_product'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['content_product'] . " " . $row['title'], $workforce_list[$user_info['userid']]['fullname']);
                } else {
                    
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_product'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['edit_product'] . " " . $row['title'], $workforce_list[$user_info['userid']]['fullname']);
                }
                
                $nv_Cache->delMod($module_name);
                
                Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

$row['vat'] = !empty($row['vat']) ? $row['vat'] : '';

if (defined('NV_EDITOR')) {
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
} elseif (!nv_function_exists('nv_aleditor') and file_exists(NV_ROOTDIR . '/' . NV_EDITORSDIR . '/ckeditor/ckeditor.js')) {
    define('NV_EDITOR', true);
    define('NV_IS_CKEDITOR', true);
    $my_head .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . NV_EDITORSDIR . '/ckeditor/ckeditor.js"></script>';
    
    function nv_aleditor($textareaname, $width = '100%', $height = '450px', $val = '', $customtoolbar = '')
    {
        global $module_data;
        $return = '<textarea style="width: ' . $width . '; height:' . $height . ';" id="' . $module_data . '_' . $textareaname . '" name="' . $textareaname . '">' . $val . '</textarea>';
        $return .= "<script type=\"text/javascript\">
		CKEDITOR.replace( '" . $module_data . "_" . $textareaname . "', {" . (!empty($customtoolbar) ? 'toolbar : "' . $customtoolbar . '",' : '') . " width: '" . $width . "',height: '" . $height . "',});
		</script>";
        return $return;
    }
}
$row['note'] = htmlspecialchars(nv_editor_br2nl($row['note']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['note'] = nv_aleditor('note', '100%', '300px', $row['note'], 'Basic');
} else {
    $row['note'] = '<textarea style="width:100%;height:300px" name="note">' . $row['note'] . '</textarea>';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($array_price_unit)) {
    foreach ($array_price_unit as $price_type) {
        $price_type['selected'] = $price_type['id'] == $row['price_unit'] ? 'selected="selected"' : '';
        $xtpl->assign('PRICE', $price_type);
        $xtpl->parse('main.price');
    }
}

foreach ($array_type as $value) {
    $xtpl->assign('TYPE', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $row['catid']) ? ' selected="selected"' : ''
    
    ));
    $xtpl->parse('main.select_type');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['products_add'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';