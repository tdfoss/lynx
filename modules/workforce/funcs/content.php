<?php
/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 07 Jan 2018 03:36:43 GMT
 */
if (!defined('NV_IS_MOD_WORKFORCE')) die('Stop!!!');

if ($nv_Request->isset_request('get_time_end', 'post')) {
    $createtime = $nv_Request->get_title('createtime', 'post', '');
    $cycle = $nv_Request->get_int('cycle', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $createtime, $m)) {
        $createtime = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
        if ($duetime = nv_caculate_duetime($createtime, $cycle)) {
            die('OK_' . nv_date('d/m/Y', $duetime));
        }
    }
    die('NO');
}

$error = array();
$array_part = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_part')->fetch();
if (empty($array_part)) {
    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=part';
    $contents = nv_theme_alert($lang_module['error_data_part_title'], $lang_module['error_data_part_content'], 'danger', $url, $lang_module['part_manage']);
    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
}

$row = array();
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
    $lang_module['workforce_add'] = $lang_module['workforce_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
    $row['part'] = $row['part_old'] = !empty($row['part']) ? array_map('intval', explode(',', $row['part'])) : array();

    // field
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $row['id'];
    $result = $db->query($sql);
    $custom_fields = $result->fetch();
} else {
    $row['id'] = 0;
    $row['first_name'] = '';
    $row['last_name'] = '';
    $row['gender'] = 1;
    $row['birthday'] = 0;
    $row['main_phone'] = '';
    $row['other_phone'] = '';
    $row['main_email'] = '';
    $row['other_email'] = '';
    $row['address'] = '';
    $row['position'] = '';
    $row['knowledge'] = '';
    $row['image'] = '';
    $row['addtime'] = 0;
    $row['edittime'] = 0;
    $row['useradd'] = 0;
    $row['status'] = 1;
    $row['userid'] = 0;
    $row['jointime'] = 0;
    $row['part'] = $row['part_old'] = array();
    $row['username'] = '';
    $row['password'] = '';
    $row['looppassword'] = '';
   $row['createtime'] = 0;
    $row['duetime'] = 0;
    $row['cycle'] = 0;
    $custom_field = array();
}
$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');
if ($nv_Request->isset_request('submit', 'post')) {
    $username = $row['username'] = $nv_Request->get_title('username', 'post', '');
    $row['password'] = $nv_Request->get_title('password', 'post', '', 0);
    $row['looppassword'] = $nv_Request->get_title('looppassword', 'post', '', 0);
    $firstname = $row['first_name'] = $nv_Request->get_title('first_name', 'post', '');
    $lastname = $row['last_name'] = $nv_Request->get_title('last_name', 'post', '');
    $gender = $row['gender'] = $nv_Request->get_int('gender', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('birthday', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['birthday'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['birthday'] = 0;
    }
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('jointime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['jointime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['jointime'] = 0;
    }
    $row['main_phone'] = $nv_Request->get_title('main_phone', 'post', '');
    $row['other_phone'] = $nv_Request->get_title('other_phone', 'post', '');
    $email = $row['main_email'] = $nv_Request->get_title('main_email', 'post', '');
    $row['other_email'] = $nv_Request->get_title('other_email', 'post', '');
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['position'] = $nv_Request->get_title('position', 'post', '');
    $row['part'] = $nv_Request->get_typed_array('part', 'post', 'int');
    $row['knowledge'] = $nv_Request->get_string('knowledge', 'post', '');
    $row['image'] = $nv_Request->get_title('image', 'post', '');
    $row['userid'] = $nv_Request->get_int('userid', 'post', 0);
    $row['btn_radio'] = $nv_Request->get_int('portion_selection', 'post', 0);
    if (is_file(NV_DOCUMENT_ROOT . $row['image'])) {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['image'] = '';
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('createtime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['createtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['createtime'] = 0;
    }
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('duetime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['duetime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['duetime'] = 0;
    }
    $row['cycle'] = $nv_Request->get_int('cycle', 'post', 0);

    $ingroups = $array_config['groups_use'];

    if (empty($row['first_name'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_first_name'],
            'input' => 'first_name'
        ));
    } elseif (empty($row['last_name'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_last_name'],
            'input' => 'last_name'
        ));
    } elseif (empty($row['birthday'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_birthday'],
            'input' => 'birthday'
        ));
    } elseif (empty($row['main_phone'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_main_phone'],
            'input' => 'main_phone'
        ));
    } elseif (empty($row['main_email'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_main_email'],
            'input' => 'main_email'
        ));
    } elseif (empty($row['part'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_part'],
            'input' => 'part'
        ));
    }
    if (!empty($row['btn_radio'])) {
        if (empty($row['username'])) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => $lang_module['error_required_username'],
                'input' => 'username'
            ));
        } elseif (empty($row['looppassword'])) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => $lang_module['error_required_looppassword'],
                'input' => 'looppassword'
            ));
        } elseif ($row['password'] != $row['looppassword']) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => $lang_module['error_required_pass'],
                'input' => 'looppassword'
            ));
        }
        $userid = nv_createaccount($username, $row['password'], $email, $ingroups, $firstname, $lastname, $row['gender']);
    } else {
        $userid = $row['userid'];
        if (empty($row['userid'])) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => $lang_module['error_required_choiceuserid'],
                'input' => 'userid'
            ));
        }
    }

    // field
    $custom_fields = $nv_Request->get_array('custom_fields', 'post');
    if (!empty($array_field_config)) {
        require NV_ROOTDIR . '/modules/' . $module_file . '/fields.check.php';
    }

    if (empty($error)) {
        try {
            $part = !empty($row['part']) ? implode(',', $row['part']) : '';
            if (empty($row['id'])) {
                $weight = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data)->fetchColumn();
                $weight = intval($weight) + 1;

                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (userid, first_name, last_name, gender, birthday, main_phone, other_phone, main_email, other_email, address, knowledge, image, jointime, position, part, addtime, edittime, useradd, createtime, duetime, cycle, weight, branch_id) VALUES (:userid, :first_name, :last_name, :gender, :birthday, :main_phone, :other_phone, :main_email, :other_email, :address, :knowledge, :image, :jointime, :position, :part, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ', :createtime, :duetime, :cycle, :weight, :branch_id)';
                $data_insert = array();
                $data_insert['userid'] = $userid;
                $data_insert['first_name'] = $row['first_name'];
                $data_insert['last_name'] = $row['last_name'];
                $data_insert['gender'] = $row['gender'];
                $data_insert['birthday'] = $row['birthday'];
                $data_insert['main_phone'] = $row['main_phone'];
                $data_insert['other_phone'] = $row['other_phone'];
                $data_insert['main_email'] = $row['main_email'];
                $data_insert['other_email'] = $row['other_email'];
                $data_insert['address'] = $row['address'];
                $data_insert['knowledge'] = $row['knowledge'];
                $data_insert['image'] = $row['image'];
                $data_insert['jointime'] = $row['jointime'];
                $data_insert['position'] = $row['position'];
                $data_insert['part'] = $part;
                $data_insert['createtime'] = $row['createtime'];
                $data_insert['duetime'] = $row['duetime'];
                $data_insert['cycle'] = $row['cycle'];
                $data_insert['weight'] = $weight;
                $data_insert['branch_id'] = $global_config['branch_id'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET userid = :userid, first_name = :first_name, last_name = :last_name, gender = :gender, birthday = :birthday, main_phone = :main_phone, other_phone = :other_phone, main_email = :main_email, other_email = :other_email, address = :address, knowledge = :knowledge, image = :image, jointime = :jointime, position = :position, part = :part, edittime = ' . NV_CURRENTTIME . ', createtime = :createtime, duetime = :duetime, cycle = :cycle WHERE id=' . $row['id']);
                $stmt->bindParam(':userid', $row['userid'], PDO::PARAM_INT);
                $stmt->bindParam(':first_name', $row['first_name'], PDO::PARAM_STR);
                $stmt->bindParam(':last_name', $row['last_name'], PDO::PARAM_STR);
                $stmt->bindParam(':gender', $row['gender'], PDO::PARAM_INT);
                $stmt->bindParam(':birthday', $row['birthday'], PDO::PARAM_INT);
                $stmt->bindParam(':main_phone', $row['main_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':other_phone', $row['other_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':main_email', $row['main_email'], PDO::PARAM_STR);
                $stmt->bindParam(':other_email', $row['other_email'], PDO::PARAM_STR);
                $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
                $stmt->bindParam(':knowledge', $row['knowledge'], PDO::PARAM_STR, strlen($row['knowledge']));
                $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
                $stmt->bindParam(':jointime', $row['jointime'], PDO::PARAM_INT);
                $stmt->bindParam(':position', $row['position'], PDO::PARAM_INT);
                $stmt->bindParam(':part', $part, PDO::PARAM_INT);
                $stmt->bindParam(':createtime', $row['createtime'], PDO::PARAM_INT);
                $stmt->bindParam(':duetime', $row['duetime'], PDO::PARAM_INT);
                $stmt->bindParam(':cycle', $row['cycle'], PDO::PARAM_INT);
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

                if ($row['part'] != $row['part_old']) {
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_part_detail (userid, part) VALUES(:userid, :part)');
                    foreach ($row['part'] as $partid) {
                        if (!in_array($partid, $row['part_old'])) {
                            $sth->bindParam(':userid', $userid, PDO::PARAM_INT);
                            $sth->bindParam(':part', $partid, PDO::PARAM_INT);
                            $sth->execute();
                        }
                    }
                    foreach ($row['part_old'] as $partid) {
                        if (!in_array($partid, $row['part'])) {
                            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_part_detail WHERE userid = ' . $row['userid'] . ' AND part=' . $partid);
                        }
                    }
                }

                $nv_Cache->delMod($module_name);
                $nv_Cache->delMod('users');

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
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
}

$row['birthday'] = !empty($row['birthday']) ? date('d/m/Y', $row['birthday']) : '';
$row['jointime'] = !empty($row['jointime']) ? date('d/m/Y', $row['jointime']) : '';
if (!empty($row['image']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['image'])) {
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
}
$userinfo = array();
if ($row['userid'] > 0) {
    $userinfo = $rows = $db->query('SELECT userid, first_name, last_name, username FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $row['userid'])->fetch();
    $userinfo['fullname'] = nv_show_name_user($userinfo['first_name'], $userinfo['last_name'], $userinfo['username']);
}

if (empty($row['createtime'])) {
    $row['createtime'] = '';
} else {
    $row['createtime'] = date('d/m/Y', $row['createtime']);
}

if (empty($row['duetime'])) {
    $row['duetime'] = '';
} else {
    $row['duetime'] = date('d/m/Y', $row['duetime']);
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('URL_USERS', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&get_user_json=1');

for ($i = 1; $i <= $array_config['termofcontract']; $i++) {
    $xtpl->assign('CYCLE', array(
        'key' => $i,
        'value' => sprintf($lang_module['cycle_month'], $i),
        'selected' => $i == $row['cycle'] ? 'selected="selected"' : ''
    ));
    $xtpl->parse('main.cycle');
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

foreach ($array_part_list as $partid => $rows_i) {
    $sl = in_array($partid, $row['part']) ? ' selected="selected"' : '';
    $xtpl->assign('pid', $rows_i['id']);
    $xtpl->assign('ptitle', $rows_i['title']);
    $xtpl->assign('pselect', $sl);
    $xtpl->parse('main.parent_loop');
}
if (!empty($userinfo)) {
    $xtpl->assign('USER_INFO', $userinfo);
    $xtpl->parse('main.user_info');
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

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');
$page_title = $lang_module['workforce_add'];
$array_mod_title[] = array(
    'title' => $lang_module['workforce'],
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name
);
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
