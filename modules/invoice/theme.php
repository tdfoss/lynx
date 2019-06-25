<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Mon, 26 Feb 2018 03:48:37 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

/**
 * nv_theme_invoice_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_invoice_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_invoice_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_invoice_detail($row, $array_invoice_products, $array_control, $downpdf, $sendmail, $content_comment)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_services, $array_products, $array_projects, $site_mods, $db;

    $lang_module['send_mail'] = $row['sended'] > 0 ? (sprintf($lang_module['resend_mail'], $row['sended'] + 1)) : $lang_module['send_mail'];
    $templateCSS = file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/css/pdf.css') ? $global_config['module_theme'] : 'default';

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('ROW', $row);
    $xtpl->assign('CONTROL', $array_control);
    $xtpl->assign('TEMPLATE_CSS', $templateCSS);
    $xtpl->assign('TRANSACTION', nv_transaction_list($row['id']));

    if (!empty($array_invoice_products)) {
        $i = 1;
        foreach ($array_invoice_products as $orders) {

            $orders['number'] = $i++;
            $orders['vat_price'] = ($orders['price'] * $orders['vat']) / 100;
            $orders['vat_price'] = nv_number_format($orders['vat_price']);
            $orders['price'] = nv_number_format($orders['price']);
            $orders['unit_price'] = nv_number_format($orders['unit_price']);
            $orders['total'] = nv_number_format($orders['total']);

            if ($orders['module'] == 'services') {
                $orders['money_unit'] = $array_services[$orders['itemid']]['title_unit'];
                $orders['itemid'] = $array_services[$orders['itemid']]['title'];
            } elseif ($orders['module'] == 'products') {
                $orders['money_unit'] = $array_products[$orders['itemid']]['title_unit'];
                $orders['itemid'] = $array_products[$orders['itemid']]['title'];
            } elseif ($orders['module'] == 'projects') {
                $orders['itemid'] = $array_projects[$orders['itemid']]['title'];
            }

            $xtpl->assign('ORDERS', $orders);

            if ($orders['vat'] > 0) {
                $xtpl->parse('main.invoice_list.loop.vat');
            } else {
                $xtpl->parse('main.invoice_list.loop.vat_empty');
            }

            $xtpl->parse('main.invoice_list.loop');
        }
        $xtpl->parse('main.invoice_list');
    }

    if (!empty($row['terms'])) {
        $xtpl->parse('main.terms');
    }

    if (!empty($row['description'])) {
        $xtpl->parse('main.description');
    }

    if (!empty($row['discount_percent']) && !empty($row['discount_value'])) {
        $xtpl->parse('main.discount');
    }

    if (defined('NV_INVOICE_ADMIN')) {
        if ($row['status'] == 0 || $row['status'] == 3 || $row['status'] == 4) {
            $xtpl->parse('main.admin.button_funs.invoice_payment_confirm');
        }

        if (isset($site_mods['support'])) {
            $xtpl->parse('main.admin.button_funs.support');
        }

        if (isset($site_mods['support'])) {
            $xtpl->parse('main.admin.button_funs.support');
        }

        if (empty($downpdf) && empty($sendmail)) {
            if (class_exists('Mpdf\Mpdf')) {
                $xtpl->parse('main.admin.button_funs.export_pdf');
            }
            $xtpl->parse('main.admin.button_funs');
            $xtpl->parse('main.admin.non_title_pdf');
        } else {
            $xtpl->parse('main.admin.dompdf_link');
        }
        $xtpl->parse('main.admin');
        $xtpl->parse('main.transaction_add');
    }

    if (!empty($content_comment)) {
        $xtpl->assign('COMMENT', $content_comment);
        $xtpl->parse('main.comment');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_invoice_transaction($invoice, $array_data)
{
    global $module_info, $module_file, $lang_module, $array_transaction_status;

    $array_data['transaction_time'] = nv_date('d/m/Y', $array_data['transaction_time']);

    if (defined('NV_INVOICE_SCORE')) {
        $lang_module['score_customer_note'] = sprintf($lang_module['score_customer_note'], $invoice['customer']['fullname'], $invoice['customer']['score'], $invoice['customer']['score_money']);
    }

    $xtpl = new XTemplate('transaction.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('DATA', $array_data);
    $xtpl->assign('INVOICE', $invoice);

    $array_type = array(
        1 => $lang_module['transaction_type_1']
    );
    if (defined('NV_INVOICE_SCORE')) {
        $array_type[2] = $lang_module['transaction_type_2'];
    }
    foreach ($array_type as $index => $value) {
        $sl = $index == 1 ? 'checked="checked"' : '';
        $xtpl->assign('TYPE', array(
            'index' => $index,
            'value' => $value,
            'selected' => $sl
        ));
        $xtpl->parse('main.type');
    }

    if (defined('NV_INVOICE_SCORE')) {
        $xtpl->parse('main.score_customer_note');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}
