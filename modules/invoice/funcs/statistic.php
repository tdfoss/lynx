<?php
/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 26 Feb 2018 06:08:31 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

$groups_admin = !empty($array_config['groups_admin']) ? explode(',', $array_config['groups_admin']) : array();
$groups_admin = array_map('intval', $groups_admin);
if (empty(array_intersect($groups_admin, $user_info['in_groups']))) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

$year = date('Y', NV_CURRENTTIME);
$month = date('m', NV_CURRENTTIME);
$money = 'money';
$array_money_in = $array_money_out = $array_money_real = array();

// thu từ hóa đơn
$result = $db->query('SELECT transaction_time, payment_amount FROM ' . NV_PREFIXLANG . '_' . $module_data . '_transaction WHERE DATE_FORMAT(FROM_UNIXTIME(transaction_time),"%Y") = ' . $year);
while (list ($transaction_time, $payment_amount) = $result->fetch(3)) {
    $time = intval(date('m', $transaction_time));
    if (isset($array_money_in[$time])) {
        $array_money_in[] += $payment_amount;
    } else {
        $array_money_in[$time] = $payment_amount;
    }
}

$array_label = array();
for ($i = 1; $i <= $month; $i++) {
    $array_label[] = sprintf($lang_module['months'], $i);

    if (!isset($array_money_in[$i])) {
        $array_money_in[$i] = 0;
    }

    if (!isset($array_money_out[$i])) {
        $array_money_out[$i] = 0;
    }
}

// thu chi từ các module khác
foreach ($site_mods as $mod => $arr_mod) {
    if (file_exists(NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/invoice.php')) {
        include NV_ROOTDIR . '/modules/' . $arr_mod['module_file'] . '/invoice.php';
    }
}

ksort($array_money_in);
ksort($array_money_out);

// doanh thu
for ($i = 1; $i <= $month; $i++) {
    $array_money_real[$i] = $array_money_in[$i] - $array_money_out[$i];
}

$datasets = array();
$datasets[] = array(
    'label' => $lang_module['moneyin'],
    'backgroundColor' => "blue",
    'data' => array_values($array_money_in)
);
$datasets[] = array(
    'label' => $lang_module['moneyout'],
    'backgroundColor' => "red",
    'data' => array_values($array_money_out)
);
$datasets[] = array(
    'label' => $lang_module['profit'],
    'borderColor' => 'green',
    'data' => array_values($array_money_real),
    'type' => 'line',
    'fill' => false
);

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('LABEL', json_encode($array_label));
$xtpl->assign('DATASETS', json_encode($datasets));

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['statistic'];
$array_mod_title[] = array(
    'title' => $page_title
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';