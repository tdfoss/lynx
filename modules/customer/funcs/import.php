<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.com)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Thu, 08 Mar 2018 01:26:35 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

$allow_action = array(
    'customer'
);

$action = $nv_Request->get_title('action', 'get,post', '');
if (!in_array($action, $allow_action)) {
    Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    die();
}

//goi cac function excel
require_once NV_ROOTDIR . '/modules/' . $module_file . '/template/function.import_excel.php';

$error = '';
$data_read = array();
if ($nv_Request->isset_request('submit', 'post')) {
    if (isset($_FILES['upload_fileupload']) and is_uploaded_file($_FILES['upload_fileupload']['tmp_name'])) {
        $file_allowed_ext = array(
            'documents'
        );
        $upload = new NukeViet\Files\Upload($file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes']);
        $upload->setLanguage($lang_global);
        $upload_info = $upload->save_file($_FILES['upload_fileupload'], NV_UPLOADS_REAL_DIR . '/' . $module_upload, false);
        @unlink($_FILES['upload_fileupload']['tmp_name']);
        if (empty($upload_info['error'])) {
            //$file_name = $upload_info['basename'];
            if ($action == 'customer') {
                $data_read = nv_read_data_customer_excel($upload_info['name']);
            }
            $nv_Request->set_Session($module_data . '_data_read', serialize($data_read));
        } else {
            $error = $upload_info['error'];
        }
    }
} else {
    $data_read = $nv_Request->get_string($module_data . '_data_read', 'session');
    $data_read = unserialize($data_read);
}

$result = $db->query('SELECT main_email  FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE main_email!=""');
while (list ($userid) = $result->fetch(3)) {
    $_arr_fb[] = $userid;
}

//var_dump($_arr_fb); die;
$lang_module['import_action'] = $lang_module['import_action_' . $action];
$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('action', $action);
$xtpl->assign('OP', $op);
$xtpl->assign('BTN_FINISH', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE);
if (!empty($error)) {
    $xtpl->assign('error', $error);
    $xtpl->parse('main.error');
}

if (!empty($data_read)) {
    $xtpl->assign('TOTAL_ROW', count($data_read));
    $error_num = 0;
    if ($action == 'customer') {
        //ghi du lieu sau khi doc
        if ($nv_Request->isset_request('save_data', 'post')) {
            if (!empty($data_read)) {
                $data_insert = nv_save_data_customer($data_read, $_arr_fb);
                $contents = nv_theme_result_import_customer($data_insert, count($data_read));
                $nv_Request->unset_request($module_data . '_data_read', 'session');
            } else {
                $contents = '<div class="error text-center">' . $lang_module['data_not_exits_error'] . '</div>';
            }
            
            include NV_ROOTDIR . '/includes/header.php';
            echo $contents;
            include NV_ROOTDIR . '/includes/footer.php';
            exit();
        } else {
            //hien thi du lieu sau khi doc
            foreach ($data_read as $data) {
                
                if (isset($data['main_email'])) {
                    
                    if (is_numeric(array_search($data['main_email'], $_arr_fb))) {
                        $error_num++;
                        $data['error_main_email'] = ' error';
                    } else {
                        $data['error_main_email'] = '';
                    }
                }
                
                $xtpl->assign('DATA', $data);
                $xtpl->parse('main.data_' . $action . '.data_result.loop');
            }
        }
    }
    
        
    $xtpl->assign('RESULT', count($data_read) - $error_num);    
    $xtpl->assign('TOTAL_ROW_ERROR', $error_num);
    $xtpl->parse('main.data_' . $action . '.data_result');
    $xtpl->parse('main.data_' . $action);
} else {
    $xtpl->parse('main.check_data');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';