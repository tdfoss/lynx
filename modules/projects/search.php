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
        OR ' . nv_like_logic('url_code', $dbkeyword, $logic) . '
        OR ' . nv_like_logic('content', $dbkeyword, $logic) . ')';

require_once NV_ROOTDIR . '/modules/projects/site.functions.php';
$where .= nv_projects_premission($m_values['module_name']);

$db_slave->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $m_values['module_data'])
    ->where('1=1' . $where);
$num_items = $db_slave->query($db_slave->sql())
    ->fetchColumn();

if ($num_items) {
    $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';

    $db_slave->select('id, title, content')
        ->limit($limit)
        ->offset(($page - 1) * $limit);
    $result = $db_slave->query($db_slave->sql());
    while (list ($id, $title, $content) = $result->fetch(3)) {
        $result_array[] = array(
            'link' => $link . 'detail&id=' . $id,
            'title' => BoldKeywordInStr($title, $key, $logic),
            'content' => BoldKeywordInStr(strip_tags($content), $key, $logic)
        );
    }
}
