<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 12 Jan 2018 09:51:27 GMT
 */
if (!defined('NV_IS_MOD_PROJECT')) die('Stop!!!');

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

$array_field_config = array();
$result_field = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_field ORDER BY weight ASC');
while ($row_field = $result_field->fetch()) {
    $language = unserialize($row_field['language']);
    $row_field['title'] = (isset($language[NV_LANG_DATA])) ? $language[NV_LANG_DATA][0] : $row['field'];
    $row_field['description'] = (isset($language[NV_LANG_DATA])) ? nv_htmlspecialchars($language[NV_LANG_DATA][1]) : '';
    if (!empty($row_field['field_choices'])) {
        $row_field['field_choices'] = unserialize($row_field['field_choices']);
    } elseif (!empty($row_field['sql_choices'])) {
        $row_field['sql_choices'] = explode('|', $row_field['sql_choices']);
        $query = 'SELECT ' . $row_field['sql_choices'][2] . ', ' . $row_field['sql_choices'][3] . ' FROM ' . $row_field['sql_choices'][1];
        $result = $db->query($query);
        $weight = 0;
        while (list ($key, $val) = $result->fetch(3)) {
            $row_field['field_choices'][$key] = $val;
        }
    }
    $array_field_config[] = $row_field;
}

if ($row['id'] > 0) {
    $lang_module['project_add'] = $lang_module['project_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
    $row['workforceid'] = $row['workforceid_old'] = !empty($row['workforceid']) ? array_map('intval', explode(',', $row['workforceid'])) : array();
    $row['files'] = !empty($row['files']) ? explode(',', $row['files']) : array();
    $row['files_old'] = $row['files'];

    // field
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $row['id'];
    $result = $db->query($sql);
    $custom_fields = $result->fetch();
} else {
    $row['id'] = 0;
    $row['customerid'] = 0;
    $row['workforceid'] = $row['workforceid_old'] = array();
    $row['title'] = '';
    $row['price'] = 0;
    $row['vat'] = 0;
    $row['begintime'] = 0;
    $row['endtime'] = 0;
    $row['realtime'] = 0;
    $row['url_code'] = '';
    $row['content'] = '';
    $row['status'] = 0;
    $row['type_id'] = 0;
    $row['sendinfo'] = 1;
    $row['files'] = $row['files_old'] = array();
    $custom_field = array();
}

$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['customerid'] = $nv_Request->get_int('customerid', 'post', 0);
    $row['workforceid'] = $nv_Request->get_typed_array('workforceid', 'post', 'int');
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['price'] = $nv_Request->get_title('price', 'post', 0);
    $row['price'] = nv_price_format($row['price']);
    $row['vat'] = $nv_Request->get_title('vat', 'post', 0);
    $row['vat'] = nv_price_format($row['vat']);
    $row['files'] = $nv_Request->get_array('files', 'post');

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('begintime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['begintime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['begintime'] = 0;
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('endtime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['endtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['endtime'] = 0;
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('realtime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['realtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['realtime'] = 0;
    }
    $row['url_code'] = $nv_Request->get_string('url_code', 'post', '');
    $row['content'] = $nv_Request->get_editor('content', '', NV_ALLOWED_HTML_TAGS);
    $row['status'] = $nv_Request->get_int('status', 'post', 1);
    $row['type_id'] = $nv_Request->get_int('type_id', 'post', 0);
    $row['sendinfo'] = $nv_Request->get_int('sendinfo', 'post', 0);

    $workforceid = !empty($row['workforceid']) ? implode(',', $row['workforceid']) : '';

    // field
    $custom_fields = $nv_Request->get_array('custom_fields', 'post');
    if (!empty($array_field_config)) {
        require NV_ROOTDIR . '/modules/' . $module_file . '/fields.check.php';
    }

    if (empty($row['customerid'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_customerid'],
            'input' => 'customerid'
        ));
    } elseif (empty($row['workforceid'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_workforceid'],
            'input' => 'workforceid'
        ));
    } elseif (empty($row['title'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_title'],
            'input' => 'title'
        ));
    } else {
        if (isset($_FILES['upload_fileupload']) && !empty($_FILES['upload_fileupload']['name'][0])) {
            $array_files = normalizeFiles($_FILES['upload_fileupload']);
            foreach ($array_files as $file) {
                $upload = new NukeViet\Files\Upload($global_config['file_allowed_ext'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
                $upload_info = $upload->save_file($file, NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload, false);
                @unlink($file['tmp_name']);
                if (empty($upload_info['error'])) {
                    mt_srand((double) microtime() * 1000000);
                    $maxran = 1000000;
                    $random_num = mt_rand(0, $maxran);
                    $random_num = md5($random_num);
                    $nv_pathinfo_filename = nv_pathinfo_filename($upload_info['name']);
                    $new_name = NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $nv_pathinfo_filename . '.' . $random_num . '.' . $upload_info['ext'];
                    $rename = nv_renamefile($upload_info['name'], $new_name);
                    if ($rename[0] == 1) {
                        $fileupload = $new_name;
                    } else {
                        $fileupload = $upload_info['name'];
                    }
                    @chmod($fileupload, 0644);
                    $row['files'][] = str_replace(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/', '', $fileupload);
                } else {
                    nv_jsonOutput(array(
                        'error' => 1,
                        'msg' => $upload_info['error'],
                        'input' => 'listfile'
                    ));
                }
                unset($upload, $upload_info);
            }
        }
    }

    try {
        $new_id = 0;
        $files = !empty($row['files']) ? implode(',', $row['files']) : '';
        if (empty($row['id'])) {
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (customerid, workforceid, title, begintime, endtime, realtime, price, vat, url_code, content, files, useradd, addtime, status, type_id) VALUES (:customerid, :workforceid, :title, :begintime, :endtime, :realtime, :price, :vat, :url_code, :content, :files, ' . $user_info['userid'] . ', ' . NV_CURRENTTIME . ', :status, :type_id)';
            $data_insert = array();
            $data_insert['customerid'] = $row['customerid'];
            $data_insert['workforceid'] = $workforceid;
            $data_insert['title'] = $row['title'];
            $data_insert['begintime'] = $row['begintime'];
            $data_insert['endtime'] = $row['endtime'];
            $data_insert['realtime'] = $row['realtime'];
            $data_insert['price'] = $row['price'];
            $data_insert['vat'] = $row['vat'];
            $data_insert['url_code'] = $row['url_code'];
            $data_insert['content'] = $row['content'];
            $data_insert['files'] = $files;
            $data_insert['status'] = $row['status'];
            $data_insert['type_id'] = $row['type_id'];
            $new_id = $db->insert_id($_sql, 'id', $data_insert);
        } else {
            $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET customerid = :customerid, workforceid = :workforceid, title = :title, price = :price, vat = :vat, begintime = :begintime, endtime = :endtime, realtime = :realtime, url_code = :url_code, content = :content, files = :files, edittime = ' . NV_CURRENTTIME . ', status = :status, type_id = :type_id WHERE id=' . $row['id']);
            $stmt->bindParam(':customerid', $row['customerid'], PDO::PARAM_INT);
            $stmt->bindParam(':workforceid', $workforceid, PDO::PARAM_STR);
            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $row['price'], PDO::PARAM_STR);
            $stmt->bindParam(':vat', $row['vat'], PDO::PARAM_STR);
            $stmt->bindParam(':begintime', $row['begintime'], PDO::PARAM_INT);
            $stmt->bindParam(':endtime', $row['endtime'], PDO::PARAM_INT);
            $stmt->bindParam(':realtime', $row['realtime'], PDO::PARAM_INT);
            $stmt->bindParam(':url_code', $row['url_code'], PDO::PARAM_STR, strlen($row['url_code']));
            $stmt->bindParam(':content', $row['content'], PDO::PARAM_STR, strlen($row['content']));
            $stmt->bindParam(':files', $files, PDO::PARAM_STR);
            $stmt->bindParam(':status', $row['status'], PDO::PARAM_INT);
            $stmt->bindParam(':type_id', $row['type_id'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                $new_id = $row['id'];
            }
        }

        if ($new_id > 0) {

            if ($row['id'] > 0) {
                if (!empty($array_field_config)) {
                    $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_info SET ' . implode(', ', $query_field) . ' WHERE rows_id=' . $new_id);
                }
            } else {
                $query_field['rows_id'] = $new_id;
                $db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_info (' . implode(', ', array_keys($query_field)) . ') VALUES (' . implode(', ', array_values($query_field)) . ')');
            }

            if ($row['workforceid'] != $row['workforceid_old']) {
                $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_performer (projectid, userid) VALUES( :projectid, :userid)');
                foreach ($row['workforceid'] as $userid) {
                    if (!in_array($userid, $row['workforceid_old'])) {
                        $sth->bindParam(':projectid', $new_id, PDO::PARAM_INT);
                        $sth->bindParam(':userid', $userid, PDO::PARAM_INT);
                        $sth->execute();
                    }
                }

                foreach ($row['workforceid_old'] as $userid) {
                    if (!in_array($userid, $row['workforceid'])) {
                        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_performer WHERE userid = ' . $userid . ' AND projectid=' . $new_id);
                    }
                }
            }

            if ($row['files'] != $row['files_old']) {
                foreach ($row['files_old'] as $path) {
                    if (!in_array($path, $row['files'])) {
                        if (file_exists(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path)) {
                            nv_deletefile(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path);
                        }
                    }
                }
            }

            $redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $new_id;

            if (empty($row['id'])) {
                // notification
                if ($workforceid != $user_info['userid']) {
                    require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                    $array_userid = array(
                        $workforceid
                    );
                    $content = sprintf($lang_module['new_project'], $row['title']);
                    $url = NV_MY_DOMAIN . $redirect;
                    nv_send_notification($array_userid, $content, 'new_project', $module_name, $url);
                }

                if ($row['sendinfo']) {
                    // gửi mail thông báo khách hàng
                    nv_sendinfo_projects($new_id);
                }
                $content = sprintf($lang_module['logs_project_add_note'], $row['title']);
                nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_project_add'], $content, $user_info['userid'], $redirect);
            } else {
                $content = sprintf($lang_module['logs_project_edit_note'], $row['title']);
                nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_project_edit'], $content, $user_info['userid'], $redirect);
            }

            $nv_Cache->delMod($module_name);

            if (!empty($row['redirect'])) {
                $url = nv_redirect_decrypt($row['redirect']);
            } else {
                $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;
            }
            nv_jsonOutput(array(
                'error' => 0,
                'redirect' => $url
            ));
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_unknow']
        ));
    }
}

if (empty($row['begintime'])) {
    $row['begintime'] = '';
} else {
    $row['begintime'] = date('d/m/Y', $row['begintime']);
}

if (empty($row['endtime'])) {
    $row['endtime'] = '';
} else {
    $row['endtime'] = date('d/m/Y', $row['endtime']);
}

if (empty($row['realtime'])) {
    $row['realtime'] = '';
} else {
    $row['realtime'] = date('d/m/Y', $row['realtime']);
}

$customer_info = array();
if (!empty($row['customerid'])) {
    $customer_info = nv_crm_customer_info($row['customerid']);
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
    $row['content'] = nv_aleditor('content', '100%', '200px', $row['content'], 'Basic');
} else {
    $row['content'] = '<textarea style="width:100%;height:200px" name="content">' . $row['content'] . '</textarea>';
}

$row['price'] = !empty($row['price']) ? $row['price'] : '';
$row['vat'] = !empty($row['vat']) ? $row['price'] : '';

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

$i = 0;
if (!empty($row['files']) and !empty($row['id'])) {
    $path = '';
    if (file_exists(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path)) {
        foreach ($row['files'] as $path) {
            $xtpl->assign('FILES', array(
                'index' => $i++,
                'path' => NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path,
                'basename' => basename($path)
            ));
            $xtpl->parse('main.view_files');
        }
    }
}

if (!empty($workforce_list)) {
    foreach ($workforce_list as $user) {
        $user['selected'] = in_array($user['userid'], $row['workforceid']) ? 'selected="selected"' : '';
        $xtpl->assign('WORKFORCE', $user);
        $xtpl->parse('main.workforce');
    }
}

foreach ($array_working_type_id as $value) {
    $xtpl->assign('TYPEID', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $row['type_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_type_id');
}

if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customer');
}

foreach ($array_status as $index => $value) {
    $sl = $index == $row['status'] ? 'selected="selected"' : '';
    $xtpl->assign('STATUS', array(
        'index' => $index,
        'value' => $value,
        'selected' => $sl
    ));
    $xtpl->parse('main.status');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

if (empty($row['id'])) {
    $xtpl->parse('main.sendinfo');
}

if (!empty($array_field_config)) {
    foreach ($array_field_config as $_row) {
        if ($row['id'] == 0 and empty($custom_fields)) {
            if (!empty($_row['field_choices'])) {
                if ($_row['field_type'] == 'date') {
                    $_row['value'] = ($_row['field_choices']['current_date']) ? NV_CURRENTTIME : $_row['default_value'];
                } elseif ($_row['field_type'] == 'number') {
                    $_row['value'] = $_row['default_value'];
                } else {
                    $temp = array_keys($_row['field_choices']);
                    $tempkey = intval($_row['default_value']) - 1;
                    $_row['value'] = (isset($temp[$tempkey])) ? $temp[$tempkey] : '';
                }
            } else {
                $_row['value'] = $_row['default_value'];
            }
        } else {
            $_row['value'] = (isset($custom_fields[$_row['field']])) ? $custom_fields[$_row['field']] : $_row['default_value'];
        }
        $_row['required'] = ($_row['required']) ? 'required' : '';

        $xtpl->assign('FIELD', $_row);
        if ($_row['required']) {
            $xtpl->parse('main.field.loop.required');
        }
        if ($_row['field_type'] == 'textbox' or $_row['field_type'] == 'number') {
            $xtpl->parse('main.field.loop.textbox');
        } elseif ($_row['field_type'] == 'date') {
            $_row['value'] = (empty($_row['value'])) ? '' : date('d/m/Y', $_row['value']);
            $xtpl->assign('FIELD', $_row);
            $xtpl->parse('main.field.loop.date');
        } elseif ($_row['field_type'] == 'textarea') {
            $_row['value'] = nv_htmlspecialchars(nv_br2nl($_row['value']));
            $xtpl->assign('FIELD', $_row);
            $xtpl->parse('main.field.loop.textarea');
        } elseif ($_row['field_type'] == 'editor') {
            $_row['value'] = htmlspecialchars(nv_editor_br2nl($_row['value']));
            if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
                $array_tmp = explode('@', $_row['class']);
                $edits = nv_aleditor('custom_fields[' . $_row['field'] . ']', $array_tmp[0], $array_tmp[1], $_row['value']);
                $xtpl->assign('EDITOR', $edits);
                $xtpl->parse('main.field.loop.editor');
            } else {
                $_row['class'] = '';
                $xtpl->assign('FIELD', $_row);
                $xtpl->parse('main.field.loop.textarea');
            }
        } elseif ($_row['field_type'] == 'select') {
            foreach ($_row['field_choices'] as $key => $value) {
                $xtpl->assign('FIELD_CHOICES', array(
                    'key' => $key,
                    'selected' => ($key == $_row['value']) ? ' selected="selected"' : '',
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop.select.loop');
            }
            $xtpl->parse('main.field.loop.select');
        } elseif ($_row['field_type'] == 'radio') {
            $number = 0;
            foreach ($_row['field_choices'] as $key => $value) {
                $xtpl->assign('FIELD_CHOICES', array(
                    'id' => $_row['fid'] . '_' . $number++,
                    'key' => $key,
                    'checked' => ($key == $_row['value']) ? ' checked="checked"' : '',
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop.radio');
            }
        } elseif ($_row['field_type'] == 'checkbox') {
            $number = 0;
            $valuecheckbox = (!empty($_row['value'])) ? explode(',', $_row['value']) : array();
            foreach ($_row['field_choices'] as $key => $value) {
                $xtpl->assign('FIELD_CHOICES', array(
                    'id' => $_row['fid'] . '_' . $number++,
                    'key' => $key,
                    'checked' => (in_array($key, $valuecheckbox)) ? ' checked="checked"' : '',
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop.checkbox');
            }
        } elseif ($_row['field_type'] == 'multiselect') {
            foreach ($_row['field_choices'] as $key => $value) {
                $xtpl->assign('FIELD_CHOICES', array(
                    'key' => $key,
                    'selected' => ($key == $_row['value']) ? ' selected="selected"' : '',
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop.multiselect.loop');
            }
            $xtpl->parse('main.field.loop.multiselect');
        }
        $xtpl->parse('main.field.loop');
    }
    $xtpl->parse('main.field');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['project_add'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
