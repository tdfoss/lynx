<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Mon, 26 Feb 2018 03:48:37 GMT
 */
if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$array_config = $module_config[$module_name];

if ($array_config['score_allow'] && $array_config['score_money'] > 0 && $array_config['money_score'] > 0) {
    define('NV_INVOICE_SCORE', true);
}

require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';

function nv_invoice_get_customer_score($customerid)
{
    global $db, $module_data, $array_config;

    $score = $db->query('SELECT score FROM ' . NV_PREFIXLANG . '_' . $module_data . '_score WHERE customerid=' . $customerid)->fetchColumn();

    $array = array(
        'score' => intval($score)
    );

    $array['score_money'] = nv_invoice_score_to_money($array['score']);

    return $array;
}

function nv_invoice_score_to_money($score)
{
    global $array_config;
    return number_format($score * intval($array_config['money_score']));
}

function nv_invoice_get_amount($amount)
{
    global $array_config;
    return round($amount / $array_config['money_score']);
}

function nv_invoice_get_score($grand_total)
{
    global $array_config;
    return round($grand_total / $array_config['score_money']);
}

function nv_invoice_score_histories($type = '+'){

}
