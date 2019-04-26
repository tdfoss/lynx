<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 27 Feb 2018 05:52:30 GMT
 */
if (!defined('NV_IS_MOD_PRODUCTS')) die('Stop!!!');

//change status
if ($nv_Request->isset_request('change_status', 'post, get')) {
    $id = $nv_Request->get_int('id', 'post, get', 0);
    $content = 'NO_' . $id;
    
    $query = 'SELECT active FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (isset($row['active'])) {
        if ($row['active'] == 2) {
            $active = 1;
        } else {
            $active = ($row['active']) ? 0 : 1;
        }
        $query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET active=' . intval($active) . ' WHERE id=' . $id;
        $db->query($query);
        $content = 'OK_' . $id;
    }
    $nv_Cache->delMod($module_name);
    include NV_ROOTDIR . '/includes/header.php';
    echo $content;
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}

$id = $nv_Request->get_int('id', 'get', 0);
$rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
if (!$rows) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

// Fetch Limit
$show_view = true;
$per_page = 10;
$page = $nv_Request->get_int('page', 'post,get', 1);
$db->sqlreset()
    ->select('COUNT(*)')
    ->from('' . NV_PREFIXLANG . '_invoice_detail t1')
    ->join(' INNER JOIN ' . NV_PREFIXLANG . '_customer t2 ON t1.idcustomer=t2.id INNER JOIN ' . NV_PREFIXLANG . '_invoice t3 ON t1.idinvoice=t3.id')
    ->where('1=1 AND t1.itemid=' . $id . ' AND t1.module=' . "'$module_name'");
$sth = $db->prepare($db->sql());
$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('t2.id as idcustomer, t2.first_name,t2.last_name,t2.main_phone,t2.main_email,t3.addtime,t3.code,t3.id')
    ->order('t3.addtime DESC')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

$rows['vat'] = !empty($rows['vat']) ? $rows['vat'] : '-';
$rows['price'] = !empty($rows['price']) ? number_format($rows['price']) : '-';
$rows['price'] = !empty($rows['price']) ? $rows['price'] : '-';
$rows['price_unit'] = !empty($rows['price_unit']) ? $array_price_unit[$rows['price_unit']]['title'] : '-';
$rows['total_buy'] = $db->query('select count(quantity) as total from nv4_vi_invoice_detail where itemid=' . $id . ' AND module=' . "'$module_name'")->fetch();
$rows['total_buy'] = $rows['total_buy']['total'];
$rows['link_add'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'];
$rows['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '&amp;id=' . $rows['id'];
$rows['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $rows['id'] . '&amp;delete_checkss=' . md5($rows['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
$rows['catid'] = !empty($rows['catid']) ? $array_type[$rows['catid']]['title'] : '-';
$xtpl->assign('CHECK', $rows['active'] == 1 ? 'checked' : '');
$xtpl->assign('ROWS', $rows);

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $rows['id'];

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}

$number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
while ($view = $sth->fetch()) {
    $view['number'] = $number++;
    $view['fullname'] = nv_show_name_user($view['first_name'], $view['last_name']);
    $view['addtime'] = !empty($view['addtime']) ? nv_date('H:i d/m/Y', $view['addtime']) : '-';
    $view['url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=invoice&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
    $view['url_customer'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=customer&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['idcustomer'];
    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');
$page_title = $lang_module['product_detail'];
$array_mod_title[] = array(
    'title' => $rows['title']
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
