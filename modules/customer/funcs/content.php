<?php
/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 04 Jan 2018 08:24:14 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

if ($nv_Request->isset_request('get_user_json', 'post, get')) {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('userid, first_name, last_name, username, email')
        ->from(NV_USERS_GLOBALTABLE)
        ->where('(first_name LIKE "%' . $q . '%"
            OR last_name LIKE "%' . $q . '%"
            OR username LIKE "%' . $q . '%"
            OR email LIKE "%' . $q . '%"
        ) AND userid NOT IN (SELECT userid_link FROM ' . NV_PREFIXLANG . '_customer)')
        ->order('first_name ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while (list ($userid, $first_name, $last_name, $username, $email) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $userid,
            'fullname' => nv_show_name_user($first_name, $last_name, $username),
            'email' => $email
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
    $lang_module['customer_add'] = $lang_module['customer_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc t2 ON t1.id=t2.customerid WHERE id=' . $row['id'] . ' AND t2.userid=' . $user_info['userid'] . ' AND permisson=1')->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_475BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        die();
    }
    $row['care_staff_old'] = $row['care_staff'];
    $row['tag_id'] = $row['tag_id_old'] = !empty($row['tag_id']) ? explode(',', $row['tag_id']) : array();
    $row['website'] = !empty($row['website']) ? explode(',', $row['website']) : array();
    $row['share_acc'] = $row['share_acc_old'] = array();
    $result = $db->query('SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc WHERE customerid=' . $row['id'] . ' AND permisson=2');
    while (list ($userid) = $result->fetch(3)) {
        $row['share_acc'][] = $userid;
    }
    $row['share_acc_old'] = $row['share_acc'];

    $row['userid_link_type'] = 0;
    if ($row['userid_link'] > 0) {
        $row['userid_link_type'] = 1;
    }

    // field
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $row['id'];
    $result_fd = $db->query($sql);
    $custom_fields = $result_fd->fetch();
} else {
    $row['id'] = 0;
    $row['first_name'] = '';
    $row['last_name'] = '';
    $row['tags'] = array();
    $row['share_accs'] = array();
    $row['main_phone'] = '';
    $row['other_phone'] = '';
    $row['main_email'] = '';
    $row['other_email'] = '';
    $row['facebook'] = '';
    $row['skype'] = '';
    $row['zalo'] = '';
    $row['website'] = array();
    $row['gender'] = 2;
    $row['address'] = '';
    $row['unit'] = 0;
    $row['userid'] = $row['care_staff'] = $row['care_staff_old'] = $user_info['userid'];
    $row['image'] = '';
    $row['note'] = '';
    $row['is_contacts'] = $nv_Request->get_int('is_contact', 'get', 0);
    $row['type_id'] = 0;
    $row['birthday'] = 0;
    $row['tag_id'] = $row['tag_id_old'] = array();
    $row['share_acc'] = $row['share_acc_old'] = array();
    $row['share_groups'] = 0;
    $row['userid_link'] = $row['userid_link_type'] = 0;
    $row['username'] = $row['password'] = $row['password1'] = '';
    $custom_field = array();
}

$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');
$row['adduser_email'] = 1;
$row['share_default'] = array(
    $row['userid'],
    $row['care_staff']
);

if ($nv_Request->isset_request('submit', 'post')) {
    $row['first_name'] = $nv_Request->get_title('first_name', 'post', '');
    $row['last_name'] = $nv_Request->get_title('last_name', 'post', '');
    $row['main_phone'] = $nv_Request->get_title('main_phone', 'post', '');
    $row['other_phone'] = $nv_Request->get_array('other_phone', 'post');
    $row['other_phone'] = !empty($row['other_phone']) ? implode('|', $row['other_phone']) : '';
    $row['main_email'] = $nv_Request->get_title('main_email', 'post', '');
    $row['other_email'] = $nv_Request->get_array('other_email', 'post');
    $row['other_email'] = !empty($row['other_email']) ? implode('|', $row['other_email']) : '';
    $row['facebook'] = $nv_Request->get_title('facebook', 'post', '');
    $row['skype'] = $nv_Request->get_title('skype', 'post', '');
    $row['zalo'] = $nv_Request->get_title('zalo', 'post', '');
    $row['website'] = $nv_Request->get_array('website', 'post');
    $row['gender'] = $nv_Request->get_int('gender', 'post', 2);
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['unit'] = $nv_Request->get_title('unit', 'post');
    $row['care_staff'] = $nv_Request->get_int('care_staff', 'post', 0);
    $row['image'] = $nv_Request->get_title('image', 'post', '');
    $row['note'] = $nv_Request->get_editor('note', '', NV_ALLOWED_HTML_TAGS);
    $row['is_contacts'] = $nv_Request->get_int('is_contacts', 'post', 0);
    $row['type_id'] = $nv_Request->get_int('type_id', 'post', 0);
    $row['tag_id'] = $nv_Request->get_array('tag_id', 'post');
    $row['share_acc'] = $nv_Request->get_typed_array('share_acc', 'post', 'int');
    $row['share_groups'] = $nv_Request->get_int('share_groups', 'post', 0);

    // field
    $custom_fields = $nv_Request->get_array('custom_fields', 'post');
    if (!empty($array_field_config)) {
        require NV_ROOTDIR . '/modules/' . $module_file . '/fields.check.php';
    }

    if (!empty($row['website'])) {
        foreach ($row['website'] as $index => $url) {
            if (!nv_is_url($url)) {
                unset($row['website'][$index]);
            }
        }
    }

    if (!empty($row['tag_id'])) {
        foreach ($row['tag_id'] as $index => $value) {
            if (!is_numeric($value)) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_tags(title) VALUES (:title)';
                $data_insert = array(
                    'title' => $value
                );
                $row['tag_id'][$index] = $db->insert_id($_sql, 'id', $data_insert);
            }
        }
    }
    $tag_id = !empty($row['tag_id']) ? implode(',', $row['tag_id']) : '';

    if (!empty($row['unit'])) {
        if (!is_numeric($row['unit'])) {
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_units(title) VALUES (:title)';
            $data_insert = array(
                'title' => $row['unit']
            );
            $row['unit'] = $db->insert_id($_sql, 'id', $data_insert);
        }
    }

    if (!empty($row['share_acc'])) {
        foreach ($row['share_acc'] as $index => $value) {
            if ($value == $user_info['userid'] || $value == $row['care_staff']) {
                unset($row['share_acc'][$index]);
            }
        }
    }
    $share_acc = !empty($row['share_acc']) ? implode(',', $row['share_acc']) : '';

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

    // Thông tin tài khoản thành viên
    $row['userid_link_type'] = $nv_Request->get_int('userid_link_type', 'post', 0);
    if ($row['userid_link_type'] == 0) {
        $row['userid_link'] = 0;
    } elseif ($row['userid_link_type'] == 1) {
        $row['userid_link'] = $nv_Request->get_int('userid_link', 'post', 1);
        if (empty($row['userid_link'])) {
            $error[] = $lang_module['error_required_userid_link'];
        }
    } elseif ($row['userid_link_type'] == 2) {
        $row['email'] = $nv_Request->get_title('email', 'post', '');
        $row['username'] = $nv_Request->get_title('username', 'post', '');
        $row['password'] = $nv_Request->get_title('password', 'post', '');
        $row['password1'] = $nv_Request->get_title('password1', 'post', '');
        $row['adduser_email'] = $nv_Request->get_int('adduser_email', 'post', 0);

        if (($check = nv_check_valid_email($row['email'])) != '') {
            $error[] = $check;
        }

        if (empty($row['username'])) {
            $error[] = $lang_module['error_required_username'];
        }

        if (!empty($row['password']) && $row['password'] != $row['password1']) {
            $error[] = $lang_module['error_password_like'];
        }

        if (empty($row['password'])) {
            $_len = round(($global_config['nv_upassmin'] + $global_config['nv_upassmax']) / 2);
            $row['password'] = nv_genpass($_len, $global_config['nv_upass_type']);
        }
    }

    if (empty($error)) {

        if (!empty($row['tag_id'])) {
            foreach ($row['tag_id'] as $index => $value) {
                if (!is_numeric($value)) {
                    $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_tags(title) VALUES (:title)';
                    $data_insert = array(
                        'title' => $value
                    );
                    $row['tag_id'][$index] = $db->insert_id($_sql, 'id', $data_insert);
                }
            }
        }
        $tag_id = !empty($row['tag_id']) ? implode(',', $row['tag_id']) : '';
        $share_acc = !empty($row['share_acc']) ? implode(',', $row['share_acc']) : '';

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

        try {
            $new_id = 0;
            $website = !empty($row['website']) ? implode(',', $row['website']) : '';
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (note, first_name, last_name, main_phone, other_phone, main_email, other_email, birthday, facebook, skype, zalo, website, gender, address, unit, care_staff, image, addtime, userid, is_contacts, type_id, tag_id,share_acc,share_groups, userid_link) VALUES (:note, :first_name, :last_name, :main_phone, :other_phone, :main_email, :other_email, :birthday, :facebook, :skype, :zalo, :website, :gender, :address, :unit, :care_staff, :image, ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ', :is_contacts, :type_id, :tag_id, :share_acc , :share_groups, :userid_link)';
                $data_insert = array();
                $data_insert['first_name'] = $row['first_name'];
                $data_insert['last_name'] = $row['last_name'];
                $data_insert['main_phone'] = $row['main_phone'];
                $data_insert['other_phone'] = $row['other_phone'];
                $data_insert['main_email'] = $row['main_email'];
                $data_insert['other_email'] = $row['other_email'];
                $data_insert['birthday'] = $row['birthday'];
                $data_insert['facebook'] = $row['facebook'];
                $data_insert['skype'] = $row['skype'];
                $data_insert['zalo'] = $row['zalo'];
                $data_insert['website'] = $website;
                $data_insert['gender'] = $row['gender'];
                $data_insert['address'] = $row['address'];
                $data_insert['unit'] = $row['unit'];
                $data_insert['care_staff'] = $row['care_staff'];
                $data_insert['image'] = $row['image'];
                $data_insert['note'] = $row['note'];
                $data_insert['is_contacts'] = $row['is_contacts'];
                $data_insert['type_id'] = $row['type_id'];
                $data_insert['tag_id'] = $tag_id;
                $data_insert['share_acc'] = $share_acc;
                $data_insert['share_groups'] = $row['share_groups'];
                $data_insert['userid_link'] = $row['userid_link'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET first_name = :first_name, last_name = :last_name, main_phone = :main_phone, other_phone = :other_phone, main_email = :main_email, other_email = :other_email, birthday = :birthday, facebook = :facebook, skype = :skype, zalo = :zalo, website = :website, gender = :gender, address = :address, unit = :unit, care_staff = :care_staff, image = :image, edittime=' . NV_CURRENTTIME . ', note = :note, type_id = :type_id, tag_id = :tag_id, share_acc = :share_acc, share_groups = :share_groups, userid_link = :userid_link WHERE id=' . $row['id']);
                $stmt->bindParam(':first_name', $row['first_name'], PDO::PARAM_STR);
                $stmt->bindParam(':last_name', $row['last_name'], PDO::PARAM_STR);
                $stmt->bindParam(':main_phone', $row['main_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':other_phone', $row['other_phone'], PDO::PARAM_STR);
                $stmt->bindParam(':main_email', $row['main_email'], PDO::PARAM_STR);
                $stmt->bindParam(':other_email', $row['other_email'], PDO::PARAM_STR);
                $stmt->bindParam(':birthday', $row['birthday'], PDO::PARAM_INT);
                $stmt->bindParam(':facebook', $row['facebook'], PDO::PARAM_STR);
                $stmt->bindParam(':skype', $row['skype'], PDO::PARAM_STR);
                $stmt->bindParam(':zalo', $row['zalo'], PDO::PARAM_STR);
                $stmt->bindParam(':website', $website, PDO::PARAM_STR);
                $stmt->bindParam(':gender', $row['gender'], PDO::PARAM_INT);
                $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
                $stmt->bindParam(':unit', $row['unit'], PDO::PARAM_STR);
                $stmt->bindParam(':care_staff', $row['care_staff'], PDO::PARAM_INT);
                $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
                $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
                $stmt->bindParam(':type_id', $row['type_id'], PDO::PARAM_INT);
                $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_STR);
                $stmt->bindParam(':share_acc', $share_acc, PDO::PARAM_STR);
                $stmt->bindParam(':share_groups', $row['share_groups'], PDO::PARAM_INT);
                $stmt->bindParam(':userid_link', $row['userid_link'], PDO::PARAM_INT);
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

                if ($row['tag_id'] != $row['tag_id_old']) {
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_tags_customer (tid, customerid) VALUES(:tid, :customerid)');
                    foreach ($row['tag_id'] as $tag_id) {
                        if (!in_array($tag_id, $row['tag_id_old'])) {
                            $sth->bindParam(':tid', $tag_id, PDO::PARAM_INT);
                            $sth->bindParam(':customerid', $new_id, PDO::PARAM_INT);
                            $sth->execute();
                        }
                    }

                    foreach ($row['tag_id_old'] as $tag_id_old) {
                        if (!in_array($tag_id_old, $row['tag_id'])) {
                            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags_customer WHERE tid=' . $tag_id_old . ' AND customerid=' . $new_id);
                        }
                    }
                }

                $array_userid = array(
                    $user_info['userid'],
                    $row['care_staff']
                );

                if (empty($row['id'])) {
                    $array_userid = array_unique($array_userid);
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc (userid, customerid, permisson) VALUES(:userid, :customerid, 1)');
                    foreach ($array_userid as $userid) {
                        $sth->bindParam(':userid', $userid, PDO::PARAM_INT);
                        $sth->bindParam(':customerid', $new_id, PDO::PARAM_INT);
                        $sth->execute();
                    }
                }

                if ($row['share_acc'] != $row['share_acc_old']) {
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc (userid, customerid, permisson) VALUES(:userid, :customerid, 2)');
                    foreach ($row['share_acc'] as $share_acc) {
                        if (!in_array($share_acc, $row['share_acc_old']) && !in_array($share_acc, $array_userid)) {
                            $sth->bindParam(':userid', $share_acc, PDO::PARAM_INT);
                            $sth->bindParam(':customerid', $new_id, PDO::PARAM_INT);
                            $sth->execute();
                        }
                    }

                    foreach ($row['share_acc_old'] as $share_acc_old) {
                        if (!in_array($share_acc_old, $row['share_acc'])) {
                            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc WHERE userid=' . $share_acc_old . ' AND customerid=' . $new_id);
                        }
                    }
                }

                // liên kết tài khoản, tạo tài khoản mới
                if ($row['userid_link_type'] == 2) {
                    $row['gender'] = $row['gender'] ? 'M' : 'F';
                    $userid = nv_users_add($row['username'], $row['password'], $row['email'], $row['first_name'], $row['last_name'], $row['gender'], $row['birthday'], $row['adduser_email']);
                    if ($userid > 0) {
                        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET userid_link=' . $userid . ' WHERE id=' . $new_id);
                    }
                }

                if (empty($row['id'])) {
                    // gửi mail giới thiệu với khách hàng mới
                    if (!empty($row['type_id'])) {
                        $contentdata = $db->query('SELECT title_mail,content FROM ' . NV_PREFIXLANG . '_' . $module_data . '_types WHERE id=' . $row['type_id'])->fetch();
                        if (!empty($contentdata)) {
                            require_once NV_ROOTDIR . '/modules/email/site.functions.php';
                            $sendto_id = array(
                                $new_id
                            );

                            $subject = $contentdata['title_mail'];
                            $message = $contentdata['content'];
                            $array_replace = array(
                                'FIRSTNAME' => $row['first_name'],
                                'LASTNAME' => $row['last_name'],
                                'FULLNAME' => nv_show_name_user($row['first_name'], $row['last_name'])
                            );

                            $subject = nv_unhtmlspecialchars($subject);
                            $message = nv_unhtmlspecialchars($message);

                            foreach ($array_replace as $index => $value) {
                                $subject = str_replace('[' . $index . ']', $value, $subject);
                                $message = str_replace('[' . $index . ']', $value, $message);
                            }

                            nv_email_send($subject, $message, $user_info['userid'], $sendto_id);
                        }
                    }
                }

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

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } elseif (empty($row['id'])) {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['content_customer'] . " " . $row['last_name'] . " " . $row['first_name'], $user_info['userid']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . ($row['is_contacts'] ? '&is_contact=1' : '');
                    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['title_customer'], $workforce_list[$user_info['userid']]['fullname'] . " " . $lang_module['edit_customer'] . " " . $row['last_name'] . " " . $row['first_name'], $user_info['userid']);
                }

                $nv_Cache->delMod($module_name);
                $nv_Cache->delMod('users');
                Header('Location: ' . $url);
                die();
            }
        } catch (PDOException $e) {
            var_dump($e); die;
            trigger_error($e->getMessage());
        }
    }
}
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
    $row['note'] = nv_aleditor('note', '100%', '300px', $row['note'], 'Basic');
} else {
    $row['note'] = '<textarea style="width:100%;height:300px" name="note">' . $row['note'] . '</textarea>';
}
if ($row['is_contacts']) {
    $lang_module['customer_add'] = $lang_module['contact_add'];
}
$row['birthday'] = !empty($row['birthday']) ? nv_date('d/m/Y', $row['birthday']) : '';
$row['ck_adduser_email'] = $row['adduser_email'] ? 'checked="checked"' : '';

$user = array();
if ($row['userid_link'] > 0) {
    $user = $db->query('SELECT userid, first_name, last_name, username FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $row['userid_link'])->fetch();
}

$row['userid_link_type_1_style'] = $row['userid_link_type_2_style'] = 'style="display: none"';
if ($row['userid_link_type'] == 1) {
    $row['userid_link_type_1_style'] = '';
} elseif ($row['userid_link_type'] == 2) {
    $row['userid_link_type_2_style'] = '';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
foreach ($array_part_list as $key => $value) {
    $xtpl->assign('PART', array(
        'key' => $key,
        'value' => $value['title'],
        'selected' => ($key == $row['share_groups']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.share_groups');
}
foreach ($workforce_list as $value) {
    $xtpl->assign('SHAREWF', array(
        'key' => $value['userid'],
        'title' => $value['fullname'],
        'selected' => in_array($value['userid'], $row['share_acc']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.share_account');
}
foreach ($array_customer_type_id as $value) {
    $xtpl->assign('TYPEID', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $row['type_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_type_id');
}
foreach ($array_customer_tags as $value) {
    $xtpl->assign('TAGS', array(
        'key' => $value['tid'],
        'title' => $value['title'],
        'selected' => in_array($value['tid'], $row['tag_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.tags');
}
foreach ($array_customer_units as $value) {
    $xtpl->assign('UNITS', array(
        'key' => $value['tid'],
        'title' => $value['title'],
        'selected' => $value['tid'] == $row['unit'] ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.units');
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

$array_userid_link_type = array(
    0 => $lang_module['userid_link_0'],
    1 => $lang_module['userid_link_1'],
    2 => $lang_module['userid_link_2']
);
foreach ($array_userid_link_type as $index => $value) {
    $xtpl->assign('OPTION', array(
        'key' => $index,
        'title' => $value,
        'checked' => $row['userid_link_type'] == $index ? 'checked="checked"' : ''
    ));
    $xtpl->parse('main.userid_link_type');
}

if (!empty($user)) {
    $user['fullname'] = nv_show_name_user($user['first_name'], $user['last_name']);
    $xtpl->assign('USER', $user);
    $xtpl->parse('main.user');
}

if (!empty($row['website'])) {
    foreach ($row['website'] as $website) {
        $xtpl->assign('WEBSITE', $website);
        $xtpl->parse('main.website');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
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

$page_title = $lang_module['customer_add'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
