<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 07 Feb 2018 09:53:57 GMT
 */
if (!defined('NV_IS_MOD_EMAIL')) die('Stop!!!');

if ($nv_Request->isset_request('get_user_json', 'post, get')) {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('id, first_name, last_name, main_phone, main_email')
        ->from(NV_PREFIXLANG . '_customer')
        ->where('(first_name LIKE "%' . $q . '%"
            OR last_name LIKE "%' . $q . '%"
            OR main_phone LIKE "%' . $q . '%"
            OR other_phone LIKE "%' . $q . '%"
            OR main_email LIKE "%' . $q . '%"
            OR other_email LIKE "%' . $q . '%"
            OR address LIKE "%' . $q . '%"
        )')
        ->order('first_name ASC')
        ->limit(20);
    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while (list ($customerid, $first_name, $last_name, $main_phone, $main_email) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $customerid,
            'fullname' => nv_show_name_user($first_name, $last_name),
            'phone' => $main_phone,
            'email' => $main_email
        );
    }

    header('Cache-Control: no-cache, must-revalidate');
    header('Content-type: application/json');

    ob_start('ob_gzhandler');
    echo json_encode($array_data);
    exit();
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
$workforce_list = nv_crm_list_workforce();
$draft = $nv_Request->isset_request('draft', 'post');

if ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }

    $row['sendto_id'] = $row['sendto_id_old'] = array();
    $result = $db->query('SELECT customer_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sendto WHERE email_id=' . $row['id']);
    while (list ($customer_id) = $result->fetch(3)) {
        $row['sendto_id'][] = $customer_id;
    }
    $row['sendto_id_old'] = $row['sendto_id'];
} else {
    $customerid = $nv_Request->get_int('customerid', 'get', 0);
    $row['id'] = 0;
    $row['title'] = $nv_Request->get_title('title', 'get', '');
    $row['cc_id'] = '';
    $row['content'] = '';
    $row['files'] = '';
    $row['sendto_id'] = array();
    $row['sendto_id_old'] = array();
    if (!empty($customerid)) {
        $row['sendto_id'] = array(
            $customerid
        );
    }
}
$row['send_my_cc'] = 1;
$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post') or $draft) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['cc_id'] = $nv_Request->get_typed_array('cc_id', 'post', 'int');
    $row['content'] = $nv_Request->get_editor('content', '', NV_ALLOWED_HTML_TAGS);
    $row['sendto_id'] = $nv_Request->get_typed_array('sendto_id', 'post', 'int');
    $row['cc_id_save'] = !empty($row['cc_id']) ? implode(',', $row['cc_id']) : '';
    $row['send_my_cc'] = $nv_Request->get_int('send_my_cc', 'post', 0);

    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    }

    if (!$draft) {
        if (empty($row['content'])) {
            $error[] = $lang_module['error_required_content'];
        } elseif (empty($row['sendto_id'])) {
            $error[] = $lang_module['error_required_sendto_id'];
        }
    }

    $row['files'] = '';
    if (isset($_FILES['upload_fileupload']) and is_uploaded_file($_FILES['upload_fileupload']['tmp_name'])) {
        $upload = new NukeViet\Files\Upload($global_config['file_allowed_ext'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], $global_config['nv_max_size'], NV_MAX_WIDTH, NV_MAX_HEIGHT);
        $upload_info = $upload->save_file($_FILES['upload_fileupload'], NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload, false);
        @unlink($_FILES['upload_fileupload']['tmp_name']);
        if (empty($upload_info['error'])) {
            $row['files'] = $upload_info['name'];
            @chmod($row['files'], 0644);
            $row['files'] = str_replace(NV_ROOTDIR . '/', '', $row['files']);
        } else {
            $error[] = $upload_info['error'];
        }
        unset($upload, $upload_info);
    }

    if (!$draft) {

        if (empty($error)) {
            $result = nv_email_send($row['title'], $row['content'], $user_info['userid'], $row['sendto_id'], $row['cc_id'], $row['files'], $row['send_my_cc'], array(), true, $row['id']);
            $status = $result['status'];
            $new_id = $result['new_id'];
            $nv_Cache->delMod($module_name);
            $message_title = $status ? $lang_module['email_title_success'] : $lang_module['email_title_error'];
            $message_content = $status ? $lang_module['email_content_success'] : $lang_module['email_content_error'];
            $color = $status ? 'success' : 'danger';

            if (!empty($row['redirect'])) {
                $url = nv_redirect_decrypt($row['redirect']);
            } else {
                $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
            }

            $content = sprintf($lang_module['logs_send_mail_note'], $workforce_list[$user_info['userid']]['fullname'], $row['title']);
            nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['save'], $content, $user_info['userid']);
            $contents = nv_theme_alert($message_title, $message_content, $color, $url, $lang_module['view_detail'], 3);

            include NV_ROOTDIR . '/includes/header.php';
            echo nv_site_theme($contents);
            include NV_ROOTDIR . '/includes/footer.php';
        }
    } else {
        if (empty($error)) {
            $result = nv_save_draft($row['id'], $row['title'], $row['content'], $user_info['userid'], $row['sendto_id'], $row['sendto_id_old'], $row['cc_id'], $row['files']);
            $new_id = $result['new_id'];
            $status = $result['status'];
            $nv_Cache->delMod($module_name);
            $message_title = $lang_module['email_draft_success'];
            $message_content = $lang_module['email_content_draft'];
            $color = $status ? 'warning' : 'success';
            if (!empty($row['redirect'])) {
                $url = nv_redirect_decrypt($row['redirect']);
            } else {
                $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
            }

            $content = sprintf($lang_module['logs_send_mail_note'], $workforce_list[$user_info['userid']]['fullname'], $row['title']);
            nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['save'], $content, $user_info['userid']);
            $contents = nv_theme_alert($message_title, $message_content, $color, $url, $lang_module['view_detail'], 3);

            include NV_ROOTDIR . '/includes/header.php';
            echo nv_site_theme($contents);
            include NV_ROOTDIR . '/includes/footer.php';
        }
    }
}

$aray_sendto = array();
if (!empty($row['sendto_id'])) {
    $result = $db->query('SELECT customer_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sendto  WHERE email_id=' . $row['id']);
    foreach ($row['sendto_id'] as $customerid) {
        $customer_info = nv_crm_customer_info($customerid);
        $aray_sendto[$customerid] = array(
            'customerid' => $customerid,
            'fullname' => $customer_info['fullname']

        );
    }
}

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
$row['content'] = htmlspecialchars(nv_editor_br2nl($row['content']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['content'] = nv_aleditor('content', '100%', '300px', $row['content'], 'Basic');
} else {
    $row['content'] = '<textarea style="width:100%;height:300px" name="content">' . $row['content'] . '</textarea>';
}

$row['send_my_cc_checked'] = $row['send_my_cc'] ? 'checked="checked"' : '';

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($workforce_list)) {
    foreach ($workforce_list as $user) {
        $xtpl->assign('USER', $user);
        $xtpl->parse('main.user');
    }
}

if (!empty($aray_sendto)) {
    foreach ($aray_sendto as $customer) {
        $xtpl->assign('CUSTOMER', $customer);
        $xtpl->parse('main.customer');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['add_new'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';