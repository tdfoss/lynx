<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Sat, 05 May 2018 12:26:59 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

/**
 * nv_theme_customer_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_customer_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_crm_label($array, $label = 'warning')
{
    $html = '';
    foreach ($array as $value) {
        $html .= '<span class="label label-' . $label . '">' . $value . '</span>&nbsp;';
    }
    return $html;
}

function nv_theme_result_import_customer($array_data, $total_row)
{
    global $module_file, $lang_module, $module_info;

    $xtpl = new XTemplate('import.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('TOTAL_ROW', $total_row);
    $xtpl->assign('TOTAL_ROW_ERROR', $total_row - count($array_data));
    foreach ($array_data as $data) {
        $xtpl->assign('DATA', $data);
        $xtpl->parse('main.data_customer.data_result.loop');
    }
    $xtpl->parse('main.data_customer.data_result');
    return $xtpl->text('main.data_customer.data_result');
}

function nv_theme_customer_detail($customer_info, $id)
{
    global $module_name, $module_file, $lang_module, $module_info, $op, $array_field_config, $custom_fields, $client_info, $array_email_list, $array_invoice, $array_events, $array_customer_service, $array_customer_projects;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->assign('URL_EDIT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $id . '&redirect=' . nv_redirect_encrypt($client_info['selfurl']));
    $xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content');
    $xtpl->assign('URL_ADD_CONTACT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&is_contacts=1');
    $xtpl->assign('URL_DELETE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $id . '&amp;delete_checkss=' . md5($id . NV_CACHE_PREFIX . $client_info['session_id']));
    $xtpl->assign('URL_ADD_EMAIL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=email&amp;' . NV_OP_VARIABLE . '=content&amp;customerid=' . $id . '&amp;redirect=' . nv_redirect_encrypt($client_info['selfurl']));
    $xtpl->assign('URL_ADD_EVENT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=events-content');
    $xtpl->assign('CURRENT_LINK', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&id=' . $id);

    if (defined('NV_EMAIL')) {
        if (!empty($array_email_list)) {
            $i = 1;
            foreach ($array_email_list as $email) {
                $email['number'] = $i++;
                $xtpl->assign('EMAIL', $email);
                $xtpl->parse('main.email_tab_content.loop');
            }
        }
        $xtpl->parse('main.email_tab_content');
        $xtpl->parse('main.email_tab_title');
    }

    if (defined('NV_INVOICE')) {
        if (!empty($array_invoice)) {
            $i = 1;
            foreach ($array_invoice as $invoice) {
                $invoice['number'] = $i++;
                $xtpl->assign('INVOICE', $invoice);
                $xtpl->parse('main.invoice_tab_content.loop');
            }
        }
        $xtpl->parse('main.invoice_tab_content');
        $xtpl->parse('main.iscontacts.invoice_tab_title');
    }

    if (!empty($array_events)) {
        $i = 1;
        foreach ($array_events as $events) {
            $events['number'] = $i++;
            $xtpl->assign('EVENTS', $events);
            $xtpl->parse('main.events_tab_content.loop');
        }
        $xtpl->parse('main.events_tab_content');
        $xtpl->parse('main.events_tab_title');
    }

    if ($customer_info['is_contacts'] == 0) {
        if (defined('NV_SERVICES')) {
            if (!empty($array_customer_service)) {
                $i = 1;
                foreach ($array_customer_service as $service) {
                    $service['number'] = $i++;
                    $service['service'] = $array_services[$service['serviceid']]['title'];
                    $service['begintime'] = (empty($service['begintime'])) ? '' : nv_date('d/m/Y', $service['begintime']);
                    $service['endtime'] = (empty($service['endtime'])) ? '' : nv_date('d/m/Y', $service['endtime']);
                    $service['addtime'] = (empty($service['addtime'])) ? '' : nv_date('H:i d/m/Y', $service['addtime']);
                    $xtpl->assign('SERVICE', $service);
                    $xtpl->parse('main.service_tab_content.loop');
                }
            }
            $xtpl->parse('main.service_tab_content');
            $xtpl->parse('main.iscontacts.service_tab_title');
        }

        if (defined('NV_SERVICES')) {
            if (!empty($array_customer_projects)) {
                $i = 1;
                foreach ($array_customer_projects as $project) {
                    $project['number'] = $i++;
                    $project['begintime'] = (empty($project['begintime'])) ? '-' : nv_date('d/m/Y', $project['begintime']);
                    $project['endtime'] = (empty($project['endtime'])) ? '-' : nv_date('d/m/Y', $project['endtime']);
                    $project['realtime'] = (empty($project['realtime'])) ? '-' : nv_date('d/m/Y', $project['realtime']);
                    $project['status'] = $lang_module['project_status_' . $project['status']];
                    $xtpl->assign('PROJECT', $project);
                    $xtpl->parse('main.projects_tab_content.loop');
                    $i++;
                }
            }
            $xtpl->parse('main.projects_tab_content');
            $xtpl->parse('main.iscontacts.projects_tab_title');
        }

        $xtpl->parse('main.iscontacts');

        $xtpl->parse('main.customer_add');
    } elseif ($customer_info['permisson'] == 1) {
        $xtpl->parse('main.iscontacts_change');
        $xtpl->parse('main.contact_add');
    }

    if (isset($site_mods['support'])) {
        $xtpl->assign('URL_ADD_SUPPORT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=support&' . NV_OP_VARIABLE . '=content&customerid=' . $id);
        $xtpl->parse('main.support');
    }

    if (!empty($customer_info['tags'])) {
        foreach ($customer_info['tags'] as $tags) {
            $xtpl->assign('TAGS', $tags);
            $xtpl->parse('main.tags');
        }
    }
    if (!empty($customer_info['units'])) {
        foreach ($customer_info['units'] as $units) {
            $xtpl->assign('UNITS', $units);
            $xtpl->parse('main.unit');
        }
    }

    if (!empty($customer_info['share_accs'])) {
        foreach ($customer_info['share_accs'] as $share_acc) {
            $xtpl->assign('SHAREACC', $share_acc);
            $xtpl->parse('main.share_accs');
        }
    }

    if ($customer_info['permisson'] == 1) {
        if ($customer_info['is_contacts'] == 0) {
            $xtpl->parse('main.admin.customer_edit');
        } else {
            $xtpl->parse('main.admin.contact_edit');
        }
        $xtpl->parse('main.admin');
    }

    if (!empty($array_field_config)) {
        foreach ($array_field_config as $row) {
            if ($row['show_profile']) {
                $question_type = $row['field_type'];
                if ($question_type == 'checkbox') {
                    $result = explode(',', $custom_fields[$row['field']]);
                    $value = '';
                    foreach ($result as $item) {
                        $value .= $row['field_choices'][$item] . '<br />';
                    }
                } elseif ($question_type == 'multiselect' or $question_type == 'select' or $question_type == 'radio') {
                    $value = $row['field_choices'][$custom_fields[$row['field']]];
                } elseif ($question_type == 'date') {
                    $value = !empty($custom_fields[$row['field']]) ? nv_date('d/m/Y', $custom_fields[$row['field']]) : '';
                } else {
                    $value = $custom_fields[$row['field']];
                }
                if (empty($value)) {
                    $value = '-';
                }
                $xtpl->assign('FIELD', array(
                    'title' => $row['title'],
                    'value' => $value
                ));
                $xtpl->parse('main.field.loop');
            }
        }
        $xtpl->parse('main.field');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}
