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
$customer_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id . nv_customer_premission($module_name))->fetch();
if (!$customer_info) {
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=manage_cusomer');
    die();
}

$customer_info['fullname'] = nv_show_name_user($customer_info['first_name'], $customer_info['last_name']);
$customer_info['gender'] = $array_gender[$customer_info['gender']];
$customer_info['addtime'] = nv_date('H:i d/m/Y', $customer_info['addtime']);
$customer_info['edittime'] = !empty($customer_info['edittime']) ? nv_date('H:i d/m/Y', $customer_info['edittime']) : '';
$customer_info['care_staff'] = !empty($customer_info['care_staff']) ? $workforce_list[$customer_info['care_staff']]['fullname'] : '';
$customer_info['type_id'] = !empty($customer_info['type_id']) ? $array_customer_type_id[$customer_info['type_id']]['title'] : '';
$customer_info['birthday'] = !empty($customer_info['birthday']) ? nv_date('d/m/Y', $customer_info['birthday']) : '';

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
    $array_invoice_status = array(
        0 => $lang_module['invoice_status_0'],
        1 => $lang_module['invoice_status_1'],
        2 => $lang_module['invoice_status_2']
    );
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

$other_phone = !empty($customer_info['other_phone']) ? explode('|', $customer_info['other_phone']) : array();
$customer_info['other_phone'] = nv_theme_crm_label($other_phone);

$other_email = !empty($customer_info['other_email']) ? explode('|', $customer_info['other_email']) : array();
$customer_info['other_email'] = nv_theme_crm_label($other_email);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('CUSTOMER', $customer_info);
$xtpl->assign('URL_EDIT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $id . '&redirect=' . nv_redirect_encrypt($client_info['selfurl']));
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content');
$xtpl->assign('URL_DELETE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $id . '&amp;delete_checkss=' . md5($id . NV_CACHE_PREFIX . $client_info['session_id']));
$xtpl->assign('URL_ADD_EMAIL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=email&amp;' . NV_OP_VARIABLE . '=content&amp;customerid=' . $id . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']));
$xtpl->assign('CURRENT_LINK', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&id=' . $id);

if (defined('NV_EMAIL')) {
    if (!empty($array_email_list)) {
        $i = 1;
        foreach ($array_email_list as $email) {
            $email['number'] = $i++;
            $xtpl->assign('EMAIL', $email);
            $xtpl->parse('main.email_tab_content.loop');
        }
    }
    $xtpl->parse('main.email_tab_content');
    $xtpl->parse('main.email_tab_title');
}

if (defined('NV_INVOICE')) {
    if (!empty($array_invoice)) {
        $i = 1;
        foreach ($array_invoice as $invoice) {
            $invoice['number'] = $i++;
            $xtpl->assign('INVOICE', $invoice);
            $xtpl->parse('main.invoice_tab_content.loop');
        }
    }
    $xtpl->parse('main.invoice_tab_content');
    $xtpl->parse('main.iscontacts.invoice_tab_title');
}

if ($customer_info['is_contacts'] == 0) {
    if (defined('NV_SERVICES')) {
        if (!empty($array_customer_service)) {
            $i = 1;
            foreach ($array_customer_service as $service) {
                $service['number'] = $i++;
                $service['service'] = $array_services[$service['serviceid']]['title'];
                $service['begintime'] = (empty($service['begintime'])) ? '' : nv_date('d/m/Y', $service['begintime']);
                $service['endtime'] = (empty($service['endtime'])) ? '' : nv_date('d/m/Y', $service['endtime']);
                $service['addtime'] = (empty($service['addtime'])) ? '' : nv_date('H:i d/m/Y', $service['addtime']);
                $xtpl->assign('SERVICE', $service);
                $xtpl->parse('main.service_tab_content.loop');
            }
        }
        $xtpl->parse('main.service_tab_content');
        $xtpl->parse('main.iscontacts.service_tab_title');
    }

    if (defined('NV_SERVICES')) {
        if (!empty($array_customer_projects)) {
            $i = 1;
            foreach ($array_customer_projects as $project) {
                $project['number'] = $i++;
                $project['begintime'] = (empty($project['begintime'])) ? '-' : nv_date('d/m/Y', $project['begintime']);
                $project['endtime'] = (empty($project['endtime'])) ? '-' : nv_date('d/m/Y', $project['endtime']);
                $project['realtime'] = (empty($project['realtime'])) ? '-' : nv_date('d/m/Y', $project['realtime']);
                $project['status'] = $lang_module['project_status_' . $project['status']];
                $xtpl->assign('PROJECT', $project);
                $xtpl->parse('main.projects_tab_content.loop');
                $i++;
            }
        }
        $xtpl->parse('main.projects_tab_content');
        $xtpl->parse('main.iscontacts.projects_tab_title');
    }

    $xtpl->parse('main.iscontacts');
} else {
    $xtpl->parse('main.iscontacts_change');
}

if (isset($site_mods['support'])) {
    $xtpl->assign('URL_ADD_SUPPORT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=support&' . NV_OP_VARIABLE . '=content&customerid=' . $id);
    $xtpl->parse('main.support');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $customer_info['fullname'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';