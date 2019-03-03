<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 13 Jan 2018 13:35:09 GMT
 */
if (!defined('NV_IS_MOD_PROJECT')) die('Stop!!!');

if ($nv_Request->isset_request('task_list', 'post')) {
    $projectid = $nv_Request->get_int('projectid', 'post', 0);
    $contents = nv_theme_project_task_lisk($projectid);
    nv_htmlOutput($contents);
}

if ($nv_Request->isset_request('change_status', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);

    list ($id, $title, $userid, $useradd, $status) = $db->query('SELECT id, title, workforceid, useradd, status FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch(3);
    if (empty($id)) {
        die('NO_' . $id);
    }

    $new_status = $nv_Request->get_int('new_status', 'post');

    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=' . $new_status . ', edittime=' . NV_CURRENTTIME . ' WHERE id=' . $id;
    $db->query($sql);

    require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
    $array_userid = array();
    if ($userid != $user_info['userid']) {
        $array_userid[] = $userid;
    }
    if ($useradd != $user_info['userid']) {
        $array_userid[] = $useradd;
    }

    $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $id;

    $name = $workforce_list[$user_info['userid']]['fullname'];
    $content = sprintf($lang_module['change_status'], $name, $title, $lang_module['status_select_' . $new_status]);
    nv_send_notification($array_userid, $content, 'change_status', $module_name, $url);

    $content = sprintf($lang_module['logs_project_change_status_note'], $title, $lang_module['status_select_' . $status], $lang_module['status_select_' . $new_status]);
    nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_project_edit'], $content, $user_info['userid'], $url);

    $nv_Cache->delMod($module_name);
    die('OK_' . $id);
}

if ($nv_Request->isset_request('sendinfo', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    if (nv_sendinfo_projects($id)) {
        die('OK_' . $lang_module['projects_sendinfo_success']);
    }
    die('NO_' . $lang_module['projects_sendinfo_error']);
}

$id = $nv_Request->get_int('id', 'get', 0);

$rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
if (!$rows) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

if ($nv_Request->isset_request('print', 'get')) {
    $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="print"')->fetchColumn();
    if (!empty($message)) {
        $customer_info = nv_crm_customer_info($rows['customerid']);
        $array_replace = array(
            'SITE_NAME' => $global_config['site_name'],
            'CAT' => !empty($rows['type_id']) ? $array_working_type_id[$rows['type_id']]['title'] : '',
            'CUSTOMER_FISRT_NAME' => $customer_info['first_name'],
            'CUSTOMER_LAST_NAME' => $customer_info['last_name'],
            'CUSTOMER_FULLNAME' => $customer_info['fullname'],
            'USER_WORK' => $workforce_list[$rows['workforceid']]['fullname'],
            'TITLE' => $rows['title'],
            'BEGIN_TIME' => !empty($rows['begintime']) ? nv_date('d/m/Y', $rows['begintime']) : '-',
            'END_TIME' => !empty($rows['endtime']) ? nv_date('d/m/Y', $rows['endtime']) : '-',
            'REAL_TIME' => !empty($rows['realtime']) ? nv_date('d/m/Y', $rows['realtime']) : '-',
            'PRICE' => !empty($rows['price']) ? nv_number_format($rows['price']) : '-',
            'VAT' => $rows['vat'],
            'CONTENT' => $rows['content'],
            'STATUS' => $lang_module['status_select_' . $rows['status']],
            'URL_DETAIL' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $rows['id']
        );
        $message = nv_unhtmlspecialchars($message);
        foreach ($array_replace as $index => $value) {
            $message = str_replace('[' . $index . ']', $value, $message);
        }
    }

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('CONTENT', $message);

    $xtpl->parse('print');
    $contents = $xtpl->text('print');

    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents, false);
    include NV_ROOTDIR . '/includes/footer.php';
}

if ($nv_Request->isset_request('download', 'get')) {
    $fileid = $nv_Request->get_int('fileid', 'get', 0);

    $rows['files'] = explode(',', $rows['files']);

    if (!isset($rows['files'][$fileid])) {
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true);
    }

    if (!file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $rows['files'][$fileid])) {
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true);
    }

    $file_info = pathinfo(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $rows['files'][$fileid]);
    $download = new NukeViet\Files\Download(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $rows['files'][$fileid], $file_info['dirname'], $file_info['basename'], true);
    $download->download_file();
    exit();
}

if ($nv_Request->isset_request('pdf', 'get')) {
    $fileid = $nv_Request->get_int('fileid', 'get', 0);

    $rows['files'] = explode(',', $rows['files']);

    if (!isset($rows['files'][$fileid])) {
        nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
    }

    if (!file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $rows['files'][$fileid])) {
        nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'], 404);
    }

    $file_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&download=1&id=' . $id . '&amp;fileid=' . $fileid;

    $contents = nv_theme_viewpdf($file_url);
    nv_htmlOutput($contents);
}

$rows['price'] = number_format($rows['price'], 0, '', '.');
$rows['begintime'] = !empty($rows['begintime']) ? nv_date('d/m/Y', $rows['begintime']) : '-';
$rows['endtime'] = !empty($rows['endtime']) ? nv_date('d/m/Y', $rows['endtime']) : '-';
$rows['realtime'] = !empty($rows['realtime']) ? nv_date('d/m/Y', $rows['realtime']) : '-';
$rows['content'] = nv_nl2br($rows['content']);
$rows['type_id'] = !empty($rows['type_id']) ? $array_working_type_id[$rows['type_id']]['title'] : '';
$rows['price'] = !empty($rows['price']) ? $rows['price'] : '-';
$rows['vat'] = !empty($rows['vat']) ? $rows['vat'] : '-';

$rows['performer_str'] = array();
$performer = !empty($rows['workforceid']) ? explode(',', $rows['workforceid']) : array();
foreach ($performer as $userid) {
    $rows['performer_str'][] = $workforce_list[$userid]['fullname'];
}
$rows['performer_str'] = !empty($rows['performer_str']) ? implode(', ', $rows['performer_str']) : '';

$rows['content'] = nv_projects_makeLinks($rows['content']);
$rows['customer'] = nv_crm_customer_info($rows['customerid']);

if (!empty($rows['files'])) {
    $files = explode(',', $rows['files']);
    $rows['files'] = array();
    foreach ($files as $file_id => $file) {
        $file_title = (!preg_match("/^http*/", $file)) ? basename($file) : $lang_module['click_to_download'];
        $rows['files'][] = array(
            'title' => $file_title,
            'key' => md5($file_id . $file_title),
            'ext' => nv_getextension($file_title),
            'titledown' => $lang_module['download'] . ' ' . (count($files) > 1 ? $file_id + 1 : ''),
            'src' => NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $file,
            'url' => (!preg_match("/^http*/", $file)) ? NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=download&amp;id=' . $rows['id'] . '&amp;index=' . $file_id . '&amp;table=answer' : $file,
            'urlpdf' => $client_info['selfurl'] . '&amp;pdf=1&amp;fileid=' . $file_id,
            'urldoc' => (preg_match("/^http*/", $file)) ? $file : 'https://docs.google.com/viewer?embedded=true&url=' . NV_MY_DOMAIN . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $file
        );
    }
}

// comment
if (isset($site_mods['comment']) and isset($module_config[$module_name]['activecomm'])) {
    define('NV_COMM_ID', $id);
    define('NV_COMM_AREA', $module_info['funcs'][$op]['func_id']);
    $allowed = $module_config[$module_name]['allowed_comm'];
    if ($allowed == '-1') {
        $allowed = $rows['allowed_comm'];
    }

    define('NV_PER_PAGE_COMMENT', 5);

    require_once NV_ROOTDIR . '/modules/comment/comment.php';
    $area = (defined('NV_COMM_AREA')) ? NV_COMM_AREA : 0;
    $checkss = md5($module_name . '-' . $area . '-' . NV_COMM_ID . '-' . $allowed . '-' . NV_CACHE_PREFIX);

    $url_info = parse_url($client_info['selfurl']);
    $content_comment = nv_comment_module($module_name, $checkss, $area, NV_COMM_ID, $allowed, 1);
} else {
    $content_comment = '';
}

$array_field_config = array();
$result_field = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_field WHERE show_profile=1 ORDER BY weight ASC');
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

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $id;
$result = $db->query($sql);
$custom_fields = $result->fetch();

$subject = 'Re: ' . sprintf($lang_module['new_project_title'], $global_config['site_name'], $rows['title']);
$array_control = array(
    'url_add' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content',
    'url_edit' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $rows['id'] . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']),
    'url_delete' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $rows['id'] . '&amp;delete_checkss=' . md5($rows['id'] . NV_CACHE_PREFIX . $client_info['session_id']),
    'url_sendmail' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=email&amp;' . NV_OP_VARIABLE . '=content&amp;customerid=' . $rows['customerid'] . '&amp;title=' . urlencode($subject) . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']),
    'url_creatinvoice' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=invoice&amp;' . NV_OP_VARIABLE . '=content&amp;projectid=' . $rows['id'],
    'url_print' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $rows['id'] . '&amp;print=1'
);

$contents = nv_theme_project_detail($rows, $content_comment, $array_control);

$page_title = $rows['title'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
