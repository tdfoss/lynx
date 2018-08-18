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
            OR trading_person LIKE "%' . $q . '%"
            OR unit_name LIKE "%' . $q . '%"
            OR tax_code LIKE "%' . $q . '%"
            OR address_invoice LIKE "%' . $q . '%"
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

if ($row['id'] > 0) {
    $lang_module['project_add'] = $lang_module['project_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
    $row['workforceid'] = $row['workforceid_old'] = !empty($row['workforceid']) ? array_map('intval', explode(',', $row['workforceid'])) : array();
} else {
    $row['id'] = 0;
    $row['customerid'] = 0;
    $row['workforceid'] = $row['workforceid_old'] = array();
    $row['title'] = '';
    $row['price'] = 0;
    $row['begintime'] = 0;
    $row['endtime'] = 0;
    $row['realtime'] = 0;
    $row['url_code'] = '';
    $row['content'] = '';
    $row['status'] = 0;
    $row['type_id'] = 0;
    $row['sendinfo'] = 1;
}

$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['customerid'] = $nv_Request->get_int('customerid', 'post', 0);
    $row['workforceid'] = $nv_Request->get_typed_array('workforceid', 'post', 'int');
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['price'] = $nv_Request->get_int('price', 'post', 0);

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

    if (empty($row['customerid'])) {
        $error[] = $lang_module['error_required_customerid'];
    } elseif (empty($row['workforceid'])) {
        $error[] = $lang_module['error_required_workforceid'];
    } elseif (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    }

    if (empty($error)) {
        try {
            $new_id = 0;
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (customerid, workforceid, title, price, begintime, endtime, realtime, url_code, content, useradd, addtime, status, type_id) VALUES (:customerid, :workforceid, :title, :begintime, :endtime, :realtime, :url_code, :content, ' . $user_info['userid'] . ', ' . NV_CURRENTTIME . ', :status, :type_id)';
                $data_insert = array();
                $data_insert['customerid'] = $row['customerid'];
                $data_insert['workforceid'] = $workforceid;
                $data_insert['title'] = $row['title'];
		$data_insert['price'] = $row['price'];
                $data_insert['begintime'] = $row['begintime'];
                $data_insert['endtime'] = $row['endtime'];
                $data_insert['realtime'] = $row['realtime'];
                $data_insert['url_code'] = $row['url_code'];
                $data_insert['content'] = $row['content'];
                $data_insert['status'] = $row['status'];
                $data_insert['type_id'] = $row['type_id'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET customerid = :customerid, workforceid = :workforceid, title = :title, price = :price, begintime = :begintime, endtime = :endtime, realtime = :realtime, url_code = :url_code, content = :content, edittime = ' . NV_CURRENTTIME . ', status = :status, type_id = :type_id WHERE id=' . $row['id']);
                $stmt->bindParam(':customerid', $row['customerid'], PDO::PARAM_INT);
                $stmt->bindParam(':workforceid', $workforceid, PDO::PARAM_STR);
                $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
		$stmt->bindParam(':price', $row['price'], PDO::PARAM_INT);
                $stmt->bindParam(':begintime', $row['begintime'], PDO::PARAM_INT);
                $stmt->bindParam(':endtime', $row['endtime'], PDO::PARAM_INT);
                $stmt->bindParam(':realtime', $row['realtime'], PDO::PARAM_INT);
                $stmt->bindParam(':url_code', $row['url_code'], PDO::PARAM_STR, strlen($row['url_code']));
                $stmt->bindParam(':content', $row['content'], PDO::PARAM_STR, strlen($row['content']));
                $stmt->bindParam(':status', $row['status'], PDO::PARAM_INT);
                $stmt->bindParam(':type_id', $row['type_id'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {

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

                if (empty($row['id'])) {
                    // notification
                    if ($workforceid != $user_info['userid']) {
                        require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                        $array_userid = array(
                            $workforceid
                        );
                        $content = sprintf($lang_module['new_project'], $row['title']);
                        $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                        nv_send_notification($array_userid, $content, 'new_project', $module_name, $url);
                    }

                    if ($row['sendinfo']) {
                        // gửi mail thông báo khách hàng
                        $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="new_project"')->fetchColumn();
                        if (!empty($message)) {
                            $customer_info = nv_crm_customer_info($row['customerid']);
                            $array_replace = array(
                                'SITE_NAME' => $global_config['site_name'],
                                'CUSTOMER_FISRT_NAME' => $customer_info['first_name'],
                                'CUSTOMER_LAST_NAME' => $customer_info['last_name'],
                                'USER_WORK' => $workforce_list[$workforceid]['fullname'],
                                'TITLE' => $row['title'],
                                'BEGIN_TIME' => !empty($row['begintime']) ? nv_date('d/m/Y', $row['begintime']) : '-',
                                'END_TIME' => !empty($row['endtime']) ? nv_date('d/m/Y', $row['endtime']) : '-',
                                'PRICE' => !empty($row['price']) ? nv_number_format($row['price']) : '-',
                                'CONTENT' => $row['content'],
                                'STATUS' => $lang_module['status_' . $row['status']],
                                'URL_DETAIL' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $new_id
                            );
                            $message = nv_unhtmlspecialchars($message);
                            foreach ($array_replace as $index => $value) {
                                $message = str_replace('[' . $index . ']', $value, $message);
                            }
                            $subject = sprintf($lang_module['new_project_title'], $global_config['site_name'], $row['title']);

                            require_once NV_ROOTDIR . '/modules/email/site.functions.php';
                            $sendto_id = array(
                                $row['customerid']
                            );
                            nv_email_send($subject, $message, 0, $sendto_id);
                        }
                    }
                }

                $nv_Cache->delMod($module_name);

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;
                }
                Header('Location: ' . $url);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
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

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

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
