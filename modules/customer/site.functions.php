<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!isset($site_mods['workforce'])) {
    $workforce_list = array();
    $where = '';

    $where .= !empty($array_config['groups_manage']) ? ' AND userid IN (SELECT userid FROM ' . NV_USERS_GLOBALTABLE . '_groups_managers WHERE group_id IN (' . $array_config['groups_manage'] . '))' : '';
    $result = $db->query('SELECT userid, first_name, last_name, username, email FROM ' . NV_USERS_GLOBALTABLE . ' WHERE active=1' . $where);
    while ($row = $result->fetch()) {
        $row['fullname'] = nv_show_name_user($row['first_name'], $row['last_name'], $row['username']);
        $workforce_list[$row['userid']] = $row;
    }
}

if (empty($workforce_list)) {
    $contents = nv_theme_alert($lang_module['workforce_empty_title'], $lang_module['workforce_empty_content'], 'danger');
    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
}

function nv_crm_customer_info($customerid)
{
    global $db;

    $customer_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_customer WHERE id=' . $customerid)->fetch();
    if ($customer_info) {
        $customer_info['fullname'] = nv_show_name_user($customer_info['first_name'], $customer_info['last_name']);
        $customer_info['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=customer&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $customerid;

        if (!empty($customer_info['photo']) && file_exists(NV_ROOTDIR . '/' . $customer_info['photo'])) {
            $customer_info['photo'] = NV_BASE_SITEURL . $customer_info['photo'];
        } else {
            $customer_info['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
        }
    }
    return $customer_info;
}

function nv_crm_customer_info_by_userid($userid)
{
    global $db;

    $customer_info = $db->query('SELECT t1.*, t1.id customer_id, t2.userid id FROM ' . NV_PREFIXLANG . '_customer t1 INNER JOIN ' . NV_USERS_GLOBALTABLE . ' t2 ON t1.userid_link=t2.userid WHERE t2.userid=' . $userid)->fetch();
    if ($customer_info) {
        $customer_info['fullname'] = nv_show_name_user($customer_info['first_name'], $customer_info['last_name']);
        $customer_info['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=customer&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $customer_info['customer_id'];

        if (!empty($customer_info['photo']) && file_exists(NV_ROOTDIR . '/' . $customer_info['photo'])) {
            $customer_info['photo'] = NV_BASE_SITEURL . $customer_info['photo'];
        } else {
            $customer_info['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
        }
    }
    return $customer_info;
}

function nv_customer_delete($customerid)
{
    global $db, $module_data, $user_info;

    $rows = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_share_acc t2 ON t1.id=t2.customerid WHERE id=' . $customerid . ' AND t2.userid=' . $user_info['userid'] . ' AND permisson=1')->fetch();
    if ($rows) {
        $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_customer WHERE id = ' . $customerid);
        if ($count) {
            // xóa dữ liệu bảng khách hàng - dịch vụ
            //$db->exec('DELETE FROM ' . NV_PREFIXLANG . '_customer_products WHERE id_customer = ' . $customerid);

            // xóa dữ liệu bảng khách hàng - sản phẩm
            //$db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id_customer = ' . $customerid);

            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_customer_share_acc WHERE customerid = ' . $customerid);
        }
        return $count;
    }
}