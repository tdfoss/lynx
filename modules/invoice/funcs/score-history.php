<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 26 Feb 2018 06:08:20 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);

$array_search = array(
    'customerid' => $nv_Request->get_int('customerid', 'get', 0)
);

$db->sqlreset()
    ->select('*')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_score_history t1')
    ->join('INNER JOIN ' . NV_PREFIXLANG . '_customer t2 ON t1.customerid = t2.id INNER JOIN ' . NV_PREFIXLANG . '_invoice t3 ON t1.invoiceid = t3.id')
    ->where('t1.customerid=' . $array_search['customerid']);
$sth = $db->prepare($db->sql());

$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('t1.id, first_name, last_name, t1.invoiceid, t1.score, t1.addtime, t1.note,t1.useradd,t3.code')
    ->order('t1.addtime')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);

$sth = $db->prepare($db->sql());
$sth->execute();

$customer_info = nv_crm_customer_info($array_search['customerid']);
$page_title = $lang_module['score_history_of'] = sprintf($lang_module['score_history_of'], $customer_info['fullname']);

$xtpl = new XTemplate('score_history.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

$array_users = array();
while ($view = $sth->fetch()) {
    $view['invoiceid'] = $view['code'];
    $view['score'] = nv_number_format($view['score']);
    $array['score_money'] = number_format((int) ($view['score']) * intval($array_config['money_score']));
    $view['money'] = nv_number_format($array['score_money']);
    $view['customerid'] = nv_show_name_user($view['first_name'], $view['last_name']);    
    $view['useradd'] = $workforce_list[$view['useradd']]['fullname'];
    $view['addtime'] = nv_date('H:i d/m/Y', $view['addtime']);
    $view['note'] = $view['note'];
    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$array_mod_title[] = array(
    'title' => $lang_module['score'],
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=score'
);

$array_mod_title[] = array(
    'title' => $lang_module['score_history']
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';