<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 04 Jan 2018 08:24:14 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

if ($nv_Request->isset_request('change_contacts', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $query = 'SELECT is_contacts FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (empty($id)) {
        die('NO_' . $lang_module['error_no_id']);
    }
    
    $query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET is_contacts=0 WHERE id=' . $id;
    $db->query($query);
    
    $nv_Cache->delMod($module_name);
    die('OK_' . $lang_module['queue_success']);
}

$id = $nv_Request->get_int('id', 'post,get', 0);
$customer_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc t2 ON t1.id=t2.customerid WHERE id=' . $id . nv_customer_premission($module_name) . ' AND t2.userid=' . $user_info['userid'])->fetch();
if (!$customer_info) {
    Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=manage_cusomer');
    die();
}

$customer_info['fullname'] = nv_show_name_user($customer_info['first_name'], $customer_info['last_name']);
$customer_info['gender'] = $array_gender[$customer_info['gender']];
$customer_info['addtime'] = nv_date('H:i d/m/Y', $customer_info['addtime']);
$customer_info['edittime'] = !empty($customer_info['edittime']) ? nv_date('H:i d/m/Y', $customer_info['edittime']) : '';
$customer_info['care_staff'] = !empty($customer_info['care_staff']) ? $workforce_list[$customer_info['care_staff']]['fullname'] : '';
$customer_info['type_id'] = !empty($customer_info['type_id']) ? $array_customer_type_id[$customer_info['type_id']]['title'] : '';
$customer_info['birthday'] = !empty($customer_info['birthday']) ? nv_date('d/m/Y', $customer_info['birthday']) : '';
$customer_info['share_groups'] = !empty($customer_info['share_groups']) ? $array_part_list[$customer_info['share_groups']]['title'] : '';
$customer_info['website_str'] = '';
if (!empty($customer_info['website'])) {
    $customer_info['website_str'] = array();
    $customer_info['website'] = explode(',', $customer_info['website']);
    foreach ($customer_info['website'] as $url) {
        $customer_info['website_str'][] = '<a target="_blank" href="' . $url . '">' . $url . '</a>';
    }
    $customer_info['website_str'] = implode(', ', $customer_info['website_str']);
}

$array_customer_service = array();
$array_customer_products = array();
$array_customer_projects = array();
$array_email_list = array();
$current_link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&id=' . $id;

if (isset($site_mods['services'])) {
    define('NV_SERVICES', true);
    
    $_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_services WHERE active=1 ORDER BY weight';
    $array_services = $nv_Cache->db($_sql, 'id', 'services');
    
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_services_customer WHERE customerid=' . $id . ' ORDER BY id DESC');
    while ($row = $result->fetch()) {
        $array_customer_service[] = $row;
    }
    $customer_info['count_services'] = sizeof($array_customer_service);
}

if (isset($site_mods['projects'])) {
    define('NV_PROJECTS', true);
    
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_projects WHERE customerid=' . $id . ' ORDER BY id DESC');
    while ($row = $result->fetch()) {
        $array_customer_projects[] = $row;
    }
    $customer_info['count_projects'] = sizeof($array_customer_projects);
}

if (isset($site_mods['email'])) {
    define('NV_EMAIL', true);
    
    $result = $db->query('SELECT t1.id, t1.title, t1.addtime, t1.useradd FROM ' . NV_PREFIXLANG . '_email t1 INNER JOIN ' . NV_PREFIXLANG . '_email_sendto t2 ON t1.id=t2.email_id WHERE t2.customer_id=' . $id . ' ORDER BY id DESC');
    while ($row = $result->fetch()) {
        $row['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=email&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $row['id'];
        $row['addtime'] = nv_date('H:i d/m/Y', $row['addtime']);
        $row['useradd'] = !empty($row['useradd']) ? $workforce_list[$row['useradd']]['fullname'] : $lang_module['system'];
        $array_email_list[] = $row;
    }
    $customer_info['count_emails'] = sizeof($array_email_list);
}

if (isset($site_mods['invoice'])) {
    define('NV_INVOICE', true);
    $array_invoice = array();
    require_once NV_ROOTDIR . '/modules/invoice/language/' . NV_LANG_INTERFACE . '.php';
    require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';
    $result = $db->query('SELECT id, title, code, addtime, duetime, grand_total, status FROM ' . NV_PREFIXLANG . '_invoice WHERE customerid=' . $id . ' ORDER BY id DESC');
    while ($row = $result->fetch()) {
        $row['createtime'] = !empty($row['createtime']) ? nv_date('H:i d/m/Y', $row['createtime']) : '';
        $row['duetime'] = !empty($row['duetime']) ? nv_date('H:i d/m/Y', $row['duetime']) : '';
        $row['addtime'] = nv_date('H:i d/m/Y', $row['addtime']);
        $row['grand_total'] = number_format($row['grand_total']);
        $row['status'] = $array_invoice_status[$row['status']];
        $row['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=invoice&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $row['id'];
        $array_invoice[] = $row;
    }
    $customer_info['count_invoices'] = sizeof($array_invoice);
}

$customer_info['share_accs'] = array();
if (!empty($customer_info['share_acc'])) {
    $customer_info['share_acc'] = explode(',', $customer_info['share_acc']);
    foreach ($customer_info['share_acc'] as $share_acc) {
        $customer_info['share_accs'][] = $workforce_list[$share_acc]['fullname'];
    }
}

$customer_info['tags'] = array();
if (!empty($customer_info['tag_id'])) {
    $customer_info['tag_id'] = explode(',', $customer_info['tag_id']);
    foreach ($customer_info['tag_id'] as $tag_id) {
        $customer_info['tags'][] = $array_customer_tags[$tag_id]['title'];
    }
}

$customer_info['units'] = array();
if (!empty($customer_info['unit'])) {
    $customer_info['unit'] = explode(',', $customer_info['unit']);
    foreach ($customer_info['unit'] as $units) {
        $customer_info['units'][] = $array_customer_units[$units]['title'];
    }
}

$other_phone = !empty($customer_info['other_phone']) ? explode('|', $customer_info['other_phone']) : array();
$customer_info['other_phone'] = nv_theme_crm_label($other_phone);

$other_email = !empty($customer_info['other_email']) ? explode('|', $customer_info['other_email']) : array();
$customer_info['other_email'] = nv_theme_crm_label($other_email);

$page_title = $customer_info['fullname'];
$array_mod_title[] = array(
    'title' => $page_title
);

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
$result_field = $db->query($sql);
$custom_fields = $result_field->fetch();

$contents = nv_theme_customer_detail($customer_info, $id);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';