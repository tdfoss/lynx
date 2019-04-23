<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 03-05-2010
 */
if (!defined('NV_IS_MOD_SEARCH')) {
    die('Stop!!!');
}

$where = ' AND (' . nv_like_logic('title', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('code', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('description', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('terms', $dbkeyword, $logic) . ')';

require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';
$where .= nv_invoice_premission($m_values['module_name']);

$db_slave->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $m_values['module_data'])
    ->where('1=1' . $where);
$num_items = $db_slave->query($db_slave->sql())
    ->fetchColumn();

if ($num_items) {
    require_once NV_ROOTDIR . '/modules/customer/site.functions.php';
    require_once NV_ROOTDIR . '/modules/invoice/language/' . NV_LANG_INTERFACE . '.php';
    require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';
    $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';

    $db_slave->select('id, title, code, customerid, status')
        ->limit($limit)
        ->offset(($page - 1) * $limit);
    $result = $db_slave->query($db_slave->sql());
    while (list ($id, $title, $code, $customerid, $status) = $result->fetch(3)) {
        $customer_info = nv_crm_customer_info($customerid);
        $status = $array_invoice_status[$status];
        $result_array[] = array(
            'link' => $link . 'detail&id=' . $id,
            'title' => BoldKeywordInStr($title, $key, $logic),
            'content' => BoldKeywordInStr('#' . $code . ' - ' . $customer_info['fullname'] . ' - ' . $status, $key, $logic)
        );
    }
}
