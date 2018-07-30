<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

function nv_crm_customer_info($customerid)
{
    global $db;

    $customer_info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_customer WHERE id=' . $customerid)->fetch();
    if ($customer_info) {
        $customer_info['fullname'] = nv_show_name_user($customer_info['first_name'], $customer_info['last_name']);
        $customer_info['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=customer&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $customerid;
    }
    return $customer_info;
}

function nv_customer_delete($customerid)
{
    global $db, $module_data;

    $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_customer WHERE id = ' . $customerid);
    if ($count) {
        // xóa dữ liệu bảng khách hàng - dịch vụ
        //$db->exec('DELETE FROM ' . NV_PREFIXLANG . '_customer_products WHERE id_customer = ' . $customerid);

        // xóa dữ liệu bảng khách hàng - sản phẩm
        //$db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id_customer = ' . $customerid);
    }
    return $count;
}