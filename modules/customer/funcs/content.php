<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 04 Jan 2018 08:24:14 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);


if ($row['id'] > 0) {
    $lang_module['customer_add'] = $lang_module['customer_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
    $row['care_staff_old'] = $row['care_staff'];
} else {
    $row['id'] = 0;
    $row['first_name'] = '';
    $row['last_name'] = '';
    $row['tags'] = '';
    $row['main_phone'] = '';
    $row['other_phone'] = '';
    $row['main_email'] = '';
    $row['other_email'] = '';
    $row['facebook'] = '';
    $row['skype'] = '';
    $row['zalo'] = '';
    $row['gender'] = 1;
    $row['address'] = '';
    $row['unit'] = '';
    $row['trading_person'] = '';
    $row['unit_name'] = '';
    $row['tax_code'] = '';
    $row['address_invoice'] = '';
    $row['care_staff'] = $row['care_staff_old'] = $user_info['userid'];
    $row['image'] = '';
    $row['note'] = '';
    $row['is_contacts'] = $nv_Request->get_int('is_contact', 'get', 0);
    $row['type_id'] = 0;
    $row['birthday'] = 0;
}

$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['first_name'] = $nv_Request->get_title('first_name', 'post', '');
    $row['last_name'] = $nv_Request->get_title('last_name', 'post', '');
    $row['tags'] = $nv_Request->get_title('tags', 'post', '');
    $row['main_phone'] = $nv_Request->get_title('main_phone', 'post', '');
    $row['other_phone'] = $nv_Request->get_array('other_phone', 'post');
    $row['other_phone'] = !empty($row['other_phone']) ? implode('|', $row['other_phone']) : '';
    $row['main_email'] = $nv_Request->get_title('main_email', 'post', '');
    $row['other_email'] = $nv_Request->get_array('other_email', 'post');
    $row['other_email'] = !empty($row['other_email']) ? implode('|', $row['other_email']) : '';
    $row['facebook'] = $nv_Request->get_title('facebook', 'post', '');
    $row['skype'] = $nv_Request->get_title('skype', 'post', '');
    $row['zalo'] = $nv_Request->get_title('zalo', 'post', '');
    $row['gender'] = $nv_Request->get_int('gender', 'post', 0);
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['unit'] = $nv_Request->get_title('unit', 'post', '');
    $row['trading_person'] = $nv_Request->get_title('trading_person', 'post', '');
    $row['unit_name'] = $nv_Request->get_title('unit_name', 'post', '');
    $row['tax_code'] = $nv_Request->get_title('tax_code', 'post', '');
    $row['address_invoice'] = $nv_Request->get_title('address_invoice', 'post', '');
    $row['care_staff'] = $nv_Request->get_int('care_staff', 'post', 0);
    $row['image'] = $nv_Request->get_title('image', 'post', '');
    $row['note'] = $nv_Request->get_editor('note', '', NV_ALLOWED_HTML_TAGS);
    $row['is_contacts'] = $nv_Request->get_int('is_contacts', 'post', 0);
    $row['type_id'] = $nv_Request->get_int('type_id', 'post', 0);

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('birthday', 'post'), $m)) {
        $row['birthday'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['birthday'] = 0;
    }

    if (is_file(NV_DOCUMENT_ROOT . $row['image'])) {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['image'] = '';
    }

    if (empty($row['first_name'])) {
        $error[] = $lang_module['error_required_fullname'];
    } elseif (empty($row['id']) && !empty($row['main_email']) && $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE main_email=' . $db->quote($row['main_email']))
        ->fetchColumn() > 0) {
        $error[] = sprintf($lang_module['error_exits_email'], $row['main_email']);
    } elseif (empty($row['id']) && !empty($row['main_phone']) && $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE main_phone=' . $db->quote($row['main_phone']))
        ->fetchColumn() > 0) {
        $error[] = sprintf($lang_module['error_exits_phone'], $row['main_phone']);
    }

    if (empty($error)) {
        try {
            $new_id = 0;
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (note, first_name, last_name,tags, main_phone, other_phone, main_email, other_email, birthday, facebook, skype, zalo, gender, address, unit, trading_person, unit_name, tax_code, address_invoice, care_staff, image, addtime, userid, is_contacts, type_id) VALUES (:note, :first_name, :last_name,:tags, :main_phone, :other_phone, :main_email, :other_email, :birthday, :facebook, :skype, :zalo, :gender, :address, :unit, :trading_person, :unit_name, :tax_code, :address_invoice, :care_staff, :image, ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ', :is_contacts, :type_id)';
                $data_insert = array();
                $data_insert['first_name'] = $row['first_name'];
                $data_insert['last_name'] = $row['last_name'];
                $data_insert['tags'] = $row['tags'];
                $data_insert['main_phone'] = $row['main_phone'];
                $data_insert['other_phone'] = $row['other_phone'];
                $data_insert['main_email'] = $row['main_email'];
                $data_insert['other_email'] = $row['other_email'];
                $data_insert['birthday'] = $row['birthday'];
                $data_insert['facebook'] = $row['facebook'];
                $data_insert['skype'] = $row['skype'];
                $data_insert['zalo'] = $row['zalo'];
                $data_insert['gender'] = $row['gender'];
                $data_insert['address'] = $row['address'];
                $data_insert['unit'] = $row['unit'];
                $data_insert['trading_person'] = $row['trading_person'];
                $data_insert['unit_name'] = $row['unit_name'];
                $data_insert['tax_code'] = $row['tax_code'];
                $data_insert['address_invoice'] = $row['address_invoice'];
                $data_insert['care_staff'] = $row['care_staff'];
                $data_insert['image'] = $row['image'];
                $data_insert['note'] = $row['note'];
                $data_insert['is_contacts'] = $row['is_contacts'];
                $data_insert['type_id'] = $row['type_id'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
                //                 var_dump($row['first_name']." ".$row['last_name']);die;
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET first_name = :first_name, last_name = :last_name,tags =:tags, main_phone = :main_phone, other_phone = :other_phone, main_email = :main_email, other_email = :other_email, birthday = :birthday, facebook = :facebook, skype = :skype, zalo = :zalo, gender = :gender, address = :address, unit = :unit, trading_person = :trading_person, unit_name = :unit_name, tax_code = :tax_code, address_invoice = :address_invoice, care_staff = :care_staff, image = :image, edittime=' . NV_CURRENTTIME . ', note = :note, type_id = :type_id WHERE id=' . $row['id']);
                $stmt->bindParam(':first_name', $row['first_name'], PDO::PARAM_STR);
                $stmt->bindParam(':last_name', $row['last_name'], PDO::PARAM_STR);
                $stmt->bindParam(':tags', $row['tags'], PDO::PARAM_STR);
                $stmt->bindParam(':main_phone', $row['main_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':other_phone', $row['other_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':main_email', $row['main_email'], PDO::PARAM_STR);
                $stmt->bindParam(':other_email', $row['other_email'], PDO::PARAM_STR);
                $stmt->bindParam(':birthday', $row['birthday'], PDO::PARAM_INT);
                $stmt->bindParam(':facebook', $row['facebook'], PDO::PARAM_STR);
                $stmt->bindParam(':skype', $row['skype'], PDO::PARAM_STR);
                $stmt->bindParam(':zalo', $row['zalo'], PDO::PARAM_STR);
                $stmt->bindParam(':gender', $row['gender'], PDO::PARAM_INT);
                $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
                $stmt->bindParam(':unit', $row['unit'], PDO::PARAM_STR);
                $stmt->bindParam(':trading_person', $row['trading_person'], PDO::PARAM_STR);
                $stmt->bindParam(':unit_name', $row['unit_name'], PDO::PARAM_STR);
                $stmt->bindParam(':tax_code', $row['tax_code'], PDO::PARAM_STR);
                $stmt->bindParam(':address_invoice', $row['address_invoice'], PDO::PARAM_STR);
                $stmt->bindParam(':care_staff', $row['care_staff'], PDO::PARAM_INT);
                $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
                $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
                $stmt->bindParam(':type_id', $row['type_id'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }
            if ($new_id > 0) {

                // thông báo đến người chăm sóc khách hàng (nếu không phải là người thêm kh)
                if ($row['care_staff'] != $row['care_staff_old']) {
                    require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                    $array_userid = array(
                        $row['care_staff']
                    );
                    $content = sprintf($lang_module['notification_new_care_staff'], nv_show_name_user($row['first_name'], $row['last_name']), $workforce_list[$user_info['userid']]['fullname']);
                    $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                    nv_send_notification($array_userid, $content, 'new_care_staff', $module_name, $url);
                }

                $nv_Cache->delMod($module_name);
                $nv_Cache->delMod('users');

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } elseif (empty($row['id'])) {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['content_customer'] . " " . $row['last_name'] . " " . $row['first_name'], $workforce_list[$user_info['userid']]['fullname']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . ($row['is_contacts'] ? '&is_contact=1' : '');
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['edit_customer'] . " " . $row['last_name'] . " " . $row['first_name'], $workforce_list[$user_info['userid']]['fullname']);
                }

                Header('Location: ' . $url);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}
// var_dump($admin_info['username']);die;
if (!empty($row['image']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['image'])) {
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
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
$row['note'] = htmlspecialchars(nv_editor_br2nl($row['note']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['note'] = nv_aleditor('note', '100%', '300px', $row['note']);
} else {
    $row['note'] = '<textarea style="width:100%;height:300px" name="note">' . $row['note'] . '</textarea>';
}

if ($row['is_contacts']) {
    $lang_module['customer_add'] = $lang_module['contact_add'];
}

$row['birthday'] = !empty($row['birthday']) ? nv_date('d/m/Y', $row['birthday']) : '';

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_customer_type_id as $value) {
    $xtpl->assign('TYPEID', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $row['type_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_type_id');
}
foreach ($array_customer_tags as $value) {
    $xtpl->assign('TAG', array(
        'key' => $value['tid'],
        'title' => $value['title'],
        'selected' => ($value['tid'] == $row['title']) ?' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_tag');
}


foreach ($workforce_list as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['userid'],
        'title' => $value['fullname'],
        'selected' => ($value['userid'] == $row['care_staff']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_care_staff');
}

foreach ($array_gender as $index => $value) {
    $ck = $index == $row['gender'] ? 'checked="checked"' : '';
    $xtpl->assign('GENDER', array(
        'index' => $index,
        'value' => $value,
        'checked' => $ck
    ));
    $xtpl->parse('main.gender');
}

if (!empty($row['other_phone'])) {
    $row['other_phone'] = explode('|', $row['other_phone']);
    foreach ($row['other_phone'] as $phone) {
        $xtpl->assign('OTHER_PHONE', $phone);
        $xtpl->parse('main.other_phone');
    }
}

if (!empty($row['other_email'])) {
    $row['other_email'] = explode('|', $row['other_email']);
    foreach ($row['other_email'] as $mail) {
        $xtpl->assign('OTHER_EMAIL', $mail);
        $xtpl->parse('main.other_email');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['customer_add'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';