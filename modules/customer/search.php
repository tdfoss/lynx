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

$where = ' AND (' . nv_like_logic('first_name', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('last_name', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('CONCAT(last_name," ",first_name)', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('main_phone', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('other_phone', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('main_email', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('other_email', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('facebook', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('skype', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('zalo', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('address', $dbkeyword, $logic) . '
    )';

$db_slave->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $m_values['module_data'])
    ->where('1=1' . $where);
$num_items = $db_slave->query($db_slave->sql())
    ->fetchColumn();

if ($num_items) {
    $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';

    $db_slave->select('id, first_name, last_name, main_email, main_phone')
        ->limit($limit)
        ->offset(($page - 1) * $limit);
    $result = $db_slave->query($db_slave->sql());
    while (list ($id, $first_name, $last_name, $main_email, $main_phone) = $result->fetch(3)) {
        $tilterow = nv_show_name_user($first_name, $last_name, $main_email);
        $result_array[] = array(
            'link' => $link . 'detail&id=' . $id,
            'title' => BoldKeywordInStr($tilterow, $key, $logic),
            'content' => BoldKeywordInStr($main_phone . ' - ' . $main_email, $key, $logic)
        );
    }
}
