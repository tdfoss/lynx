<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 26 Feb 2018 06:08:31 GMT
 */
if (!defined('NV_IS_MOD_INVOICE')) die('Stop!!!');

if ($nv_Request->isset_request('get_time_end', 'post')) {
    $createtime = $nv_Request->get_title('createtime', 'post', '');
    $cycle = $nv_Request->get_int('cycle', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $createtime, $m)) {
        $createtime = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
        if ($duetime = nv_caculate_duetime($createtime, $cycle)) {
            die('OK_' . nv_date('d/m/Y', $duetime));
        }
    }
    die('NO');
}

if ($nv_Request->isset_request('get_item_info', 'post')) {
    $itemid = $nv_Request->get_int('itemid', 'post', 0);
    $module = $nv_Request->get_title('module', 'post', '');

    if (isset($site_mods[$module])) {
        $rows = $db->query('SELECT price, vat FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . ' WHERE id=' . $itemid)->fetch();
        if ($rows) {
            $rows['vat_price'] = ($rows['price'] * $rows['vat']) / 100;
            $rows['total'] = $rows['price'] + $rows['vat_price'];
            nv_jsonOutput($rows);
        }
    }
    die();
}

if ($nv_Request->isset_request('get_user_json', 'post, get')) {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('id, first_name, last_name, main_phone, main_email')
        ->from(NV_PREFIXLANG . '_customer')
        ->where('(first_name LIKE "%' . $q . '%"
            OR last_name LIKE "%' . $q . '%"
            OR main_phone LIKE "%' . $q . '%"
            OR other_phone LIKE "%' . $q . '%"
            OR main_email LIKE "%' . $q . '%"
            OR other_email LIKE "%' . $q . '%"
            OR address LIKE "%' . $q . '%"
            OR trading_person LIKE "%' . $q . '%"
            OR unit_name LIKE "%' . $q . '%"
            OR tax_code LIKE "%' . $q . '%"
            OR address_invoice LIKE "%' . $q . '%"
        )')
        ->order('first_name ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while (list ($customerid, $first_name, $last_name, $main_phone, $main_email) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $customerid,
            'fullname' => nv_show_name_user($first_name, $last_name),
            'phone' => $main_phone,
            'email' => $main_email
        );
    }

    header('Cache-Control: no-cache, must-revalidate');
    header('Content-type: application/json');

    ob_start('ob_gzhandler');
    echo json_encode($array_data);
    exit();
}

$row = array();
$error = array();
$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $lang_module['content'] = $lang_module['invoice_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
    $row['workforceid_old'] = $row['workforceid'];
    $row['detail'] = array();
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idinvoice=' . $row['id'] . ' ORDER BY weight');
    while ($_row = $result->fetch()) {
        $row['detail'][$_row['itemid'] . '_' . $_row['module']] = $_row;
    }
    $row['detail_old'] = $row['detail'];
    $row['customerid_old'] = $row['customerid'];
} else {
    $lang_module['content'] = $lang_module['add'];
    $row['id'] = 0;
    $row['title'] = '';
    $row['customerid'] = 0;
    $row['createtime'] = NV_CURRENTTIME;
    $row['duetime'] = 0;
    $row['performerid'] = $row['presenterid'] = $row['workforceid'] = $row['workforceid_old'] = 0;
    $row['terms'] = '';
    $row['description'] = '';
    $row['detail'] = $row['detail_old'] = array();
    $row['status'] = 0;
    $row['cycle'] = 0;
    $row['discount_percent'] = 0;
    $row['discount_value'] = 0;
    $row['auto_create'] = 0;
}

if ($nv_Request->isset_request('submit', 'post')) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['customerid'] = $nv_Request->get_int('customerid', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('createtime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['createtime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['createtime'] = 0;
    }
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('duetime', 'post'), $m)) {
        $_hour = 23;
        $_min = 23;
        $row['duetime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['duetime'] = 0;
    }
    $row['workforceid'] = $nv_Request->get_int('workforceid', 'post', 0);
    $row['presenterid'] = $nv_Request->get_int('presenterid', 'post', 0);
    $row['performerid'] = $nv_Request->get_int('performerid', 'post', 0);
    $row['terms'] = $nv_Request->get_string('terms', 'post', '');
    $row['description'] = $nv_Request->get_string('description', 'post', '');
    $row['status'] = $nv_Request->get_int('status', 'post', 0);
    $row['cycle'] = $nv_Request->get_int('cycle', 'post', 0);
    $row['discount_percent'] = $nv_Request->get_int('discount_percent', 'post', 0);
    $row['auto_create'] = $nv_Request->get_int('auto_create', 'post', 0);

    $row['detail'] = array();
    $detail = $nv_Request->get_array('detail', 'post');
    $i = 1;
    $grand_total = 0;
    foreach ($detail as $index => $value) {
        if ($value['itemid'] > 0 && !empty($value['module'])) {
            $value['weight'] = $i;
            $value['price'] = preg_replace('/[^0-9]/', '', $value['price']);
            $grand_total += nv_caculate_total($value['price'], $value['quantity'], $value['vat']);
            $row['detail'][$value['itemid'] . '_' . $value['module']] = $value;
            $i++;
        }
    }

    $row['discount_value'] = 0;
    if (!empty($row['discount_percent'])) {
        $row['discount_value'] = ($row['discount_percent'] * $grand_total) / 100;
    }

    $grand_total = $grand_total - $row['discount_value'];

    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    } elseif (empty($row['customerid'])) {
        $error[] = $lang_module['error_required_customerid'];
    }

    if (empty($error)) {
        try {
            $new_id = 0;
            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (title, customerid, createtime, duetime, cycle, workforceid, presenterid, performerid, terms, description, grand_total, discount_percent, discount_value, addtime, useradd, status, auto_create) VALUES (:title, :customerid, :createtime, :duetime, :cycle, :workforceid,  :presenterid, :performerid, :terms, :description, ' . $grand_total . ', :discount_percent, :discount_value, ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ', :status, :auto_create)';
                $data_insert = array();
                $data_insert['title'] = $row['title'];
                $data_insert['customerid'] = $row['customerid'];
                $data_insert['createtime'] = $row['createtime'];
                $data_insert['duetime'] = $row['duetime'];
                $data_insert['cycle'] = $row['cycle'];
                $data_insert['workforceid'] = $row['workforceid'];
                $data_insert['presenterid'] = $row['presenterid'];
                $data_insert['performerid'] = $row['performerid'];
                $data_insert['terms'] = $row['terms'];
                $data_insert['description'] = $row['description'];
                $data_insert['status'] = $row['status'];
                $data_insert['discount_percent'] = $row['discount_percent'];
                $data_insert['discount_value'] = $row['discount_value'];
                $data_insert['auto_create'] = $row['auto_create'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET title = :title, customerid = :customerid, createtime = :createtime, duetime = :duetime, cycle = :cycle, workforceid = :workforceid, presenterid = :presenterid, performerid = :performerid, terms = :terms, description = :description, grand_total = :grand_total, discount_percent = :discount_percent, discount_value = :discount_value, status = :status, auto_create = :auto_create WHERE id=' . $row['id']);
                $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
                $stmt->bindParam(':customerid', $row['customerid'], PDO::PARAM_INT);
                $stmt->bindParam(':createtime', $row['createtime'], PDO::PARAM_INT);
                $stmt->bindParam(':duetime', $row['duetime'], PDO::PARAM_INT);
                $stmt->bindParam(':cycle', $row['cycle'], PDO::PARAM_INT);
                $stmt->bindParam(':workforceid', $row['workforceid'], PDO::PARAM_INT);
                $stmt->bindParam(':presenterid', $row['presenterid'], PDO::PARAM_INT);
                $stmt->bindParam(':performerid', $row['performerid'], PDO::PARAM_INT);
                $stmt->bindParam(':terms', $row['terms'], PDO::PARAM_STR, strlen($row['terms']));
                $stmt->bindParam(':description', $row['description'], PDO::PARAM_STR, strlen($row['description']));
                $stmt->bindParam(':grand_total', $grand_total, PDO::PARAM_STR);
                $stmt->bindParam(':status', $row['status'], PDO::PARAM_INT);
                $stmt->bindParam(':discount_percent', $row['discount_percent'], PDO::PARAM_INT);
                $stmt->bindParam(':discount_value', $row['discount_value'], PDO::PARAM_STR);
                $stmt->bindParam(':auto_create', $row['auto_create'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {
                if ($row['id'] == 0) {
                    $i = 1;
                    $format_code = '%06s';
                    $auto_code = vsprintf($format_code, $new_id);

                    $stmt = $db->prepare('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE code= :code');
                    $stmt->bindParam(':code', $auto_code, PDO::PARAM_STR);
                    $stmt->execute();
                    while ($stmt->rowCount()) {
                        $auto_code = vsprintf($format_code, ($new_id + $i++));
                    }

                    $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET code= :code WHERE id=' . $new_id);
                    $stmt->bindParam(':code', $auto_code, PDO::PARAM_STR);
                    $stmt->execute();

                    $notify_title = '#' . $row['code'] . ' - ' . $row['title'];
                    nv_invoice_new_notification($new_id, $notify_title, $row['workforceid']);
                } else {
                    if ($row['workforceid'] != $row['workforceid_old']) {
                        $notify_title = '#' . $row['code'] . ' - ' . $row['title'];
                        nv_invoice_new_notification($new_id, $notify_title, $row['workforceid']);
                    }
                }

                $detail = array_keys($row['detail']);
                $detail_old = array_keys($row['detail_old']);
                if ($detail != $detail_old) {
                    $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_detail (idinvoice, idcustomer, module, itemid, quantity, price, vat, total, note, weight) VALUES(:idinvoice, :idcustomer, :module, :itemid, :quantity, :price, :vat, :total, :note, :weight)');
                    foreach ($row['detail'] as $service) {
                        if (!in_array($service['itemid'] . '_' . $service['module'], array_keys($row['detail_old']), true)) {
                            $service['note'] = !empty($service['note']) ? $service['note'] : '';
                            $total = $service['price'] * $service['quantity'];
                            $total = $total + (($total * $service['vat']) / 100);
                            $sth->bindParam(':idinvoice', $new_id, PDO::PARAM_INT);
                            $sth->bindParam(':idcustomer', $row['customerid'], PDO::PARAM_INT);
                            $sth->bindParam(':module', $service['module'], PDO::PARAM_STR);
                            $sth->bindParam(':itemid', $service['itemid'], PDO::PARAM_INT);
                            $sth->bindParam(':quantity', $service['quantity'], PDO::PARAM_INT);
                            $sth->bindParam(':price', $service['price'], PDO::PARAM_STR);
                            $sth->bindParam(':vat', $service['vat'], PDO::PARAM_STR);
                            $sth->bindParam(':total', $total, PDO::PARAM_STR);
                            $sth->bindParam(':note', $service['note'], PDO::PARAM_STR);
                            $sth->bindParam(':weight', $service['weight'], PDO::PARAM_INT);
                            $sth->execute();
                        }
                    }

                    foreach ($row['detail_old'] as $serviceid_old) {
                        if (!in_array($serviceid_old['itemid'] . '_' . $serviceid_old['module'], array_keys($row['detail']))) {
                            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_detail WHERE idcustomer = ' . $row['customerid'] . ' AND idinvoice=' . $new_id . ' AND module=' . $db->quote($serviceid_old['module']) . ' AND itemid=' . $serviceid_old['itemid']);
                        }
                    }
                } else {
                    if ($row['customerid'] != $row['customerid_old']) {
                        $sth = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_detail SET idcustomer = :idcustomer WHERE idinvoice = :idinvoice AND idcustomer = :idcustomer_old');
                        $sth->bindParam(':idinvoice', $new_id, PDO::PARAM_INT);
                        $sth->bindParam(':idcustomer', $row['customerid'], PDO::PARAM_INT);
                        $sth->bindParam(':idcustomer_old', $row['customerid_old'], PDO::PARAM_INT);
                        $sth->execute();
                    }

                    $sth = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_detail SET quantity = :quantity, price = :price, vat = :vat, total = :total, note = :note, weight = :weight WHERE idinvoice = :idinvoice AND idcustomer = :idcustomer AND module = :module AND itemid = :itemid');
                    foreach ($row['detail'] as $service) {
                        $total = $service['price'] * $service['quantity'];
                        $total = $total + (($total * $service['vat']) / 100);
                        $sth->bindParam(':idinvoice', $new_id, PDO::PARAM_INT);
                        $sth->bindParam(':idcustomer', $row['customerid'], PDO::PARAM_INT);
                        $sth->bindParam(':module', $service['module'], PDO::PARAM_STR);
                        $sth->bindParam(':itemid', $service['itemid'], PDO::PARAM_INT);
                        $sth->bindParam(':quantity', $service['quantity'], PDO::PARAM_INT);
                        $sth->bindParam(':price', $service['price'], PDO::PARAM_STR);
                        $sth->bindParam(':vat', $service['vat'], PDO::PARAM_STR);
                        $sth->bindParam(':total', $total, PDO::PARAM_STR);
                        $sth->bindParam(':note', $service['note'], PDO::PARAM_STR);
                        $sth->bindParam(':weight', $service['weight'], PDO::PARAM_INT);
                        $sth->execute();
                    }
                }

                $nv_Cache->delMod($module_name);

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                }

                Header('Location: ' . $url);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

if (empty($row['createtime'])) {
    $row['createtime'] = '';
} else {
    $row['createtime'] = date('d/m/Y', $row['createtime']);
}

if (empty($row['duetime'])) {
    $row['duetime'] = '';
} else {
    $row['duetime'] = date('d/m/Y', $row['duetime']);
}

$row['discount_percent'] = !empty($row['discount_percent']) ? $row['discount_percent'] : '';
$row['ck_auto_create'] = $row['auto_create'] ? 'checked="checked"' : '';

$customer_info = array();
if (!empty($row['customerid'])) {
    $customer_info = nv_crm_customer_info($row['customerid']);
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($customer_info)) {
    $xtpl->assign('CUSTOMER', $customer_info);
    $xtpl->parse('main.customer');
}

if (!empty($workforce_list)) {
    foreach ($workforce_list as $user) {
        $user['selected'] = $user['userid'] == $row['workforceid'] ? 'selected="selected"' : '';
        $user['selected1'] = $user['userid'] == $row['presenterid'] ? 'selected="selected"' : '';
        $user['selected2'] = $user['userid'] == $row['performerid'] ? 'selected="selected"' : '';
        $xtpl->assign('USER', $user);
        $xtpl->parse('main.user');
        $xtpl->parse('main.user1');
        $xtpl->parse('main.user2');
    }
}

$default = array(
    array(
        'index' => 0,
        'module' => 'services',
        'itemid' => 0,
        'quantity' => 1,
        'price' => 0,
        'vat' => 0,
        'total' => 0,
        'note' => ''
    )
);
$row['detail'] = !empty($row['detail']) ? $row['detail'] : $default;

$i = 0;
$array_total = array(
    'item_total' => 0,
    'vat_total' => 0,
    'grand_total' => 0
);
foreach ($row['detail'] as $item) {
    $item['index'] = $i;
    $item['number'] = $i + 1;
    $item['vat_price'] = ($item['price'] * $item['vat']) / 100;

    $array_total['item_total'] += ($item['price'] * $item['quantity']);
    $array_total['vat_total'] += $item['vat_price'];

    $item['vat_price'] = nv_number_format($item['vat_price']);
    $item['price'] = nv_number_format($item['price']);
    $item['total'] = nv_number_format($item['total']);

    $xtpl->assign('ITEM', $item);

    if ($item['module'] == 'services') {
        if (!empty($array_services)) {
            foreach ($array_services as $services) {
                $services['selected'] = ($item['module'] == 'services' && $services['id'] == $item['itemid']) ? 'selected="selected"' : '';
                $xtpl->assign('SERVICES', $services);
                $xtpl->parse('main.items.services.loop');
            }
        }
        $xtpl->parse('main.items.services');
    } elseif ($item['module'] == 'products') {
        if (!empty($array_products)) {
            foreach ($array_products as $products) {
                $products['selected'] = ($item['module'] == 'products' && $products['id'] == $item['itemid']) ? 'selected="selected"' : '';
                $xtpl->assign('PRODUCTS', $products);
                $xtpl->parse('main.items.products.loop');
            }
        }
        $xtpl->parse('main.items.products');
    }

    $xtpl->parse('main.items');
    $i++;
}
$array_total['grand_total'] = $array_total['item_total'] + $array_total['vat_total'];
$grand_total = $array_total['grand_total'];
$array_total = array_map('nv_number_format', $array_total);
$array_total['grand_total_string'] = nv_convert_number_to_words($grand_total);
$xtpl->assign('TOTAL', $array_total);
$xtpl->assign('COUNT', sizeof($row['detail']));

if (!empty($array_services)) {
    foreach ($array_services as $services) {
        $xtpl->assign('SERVICES', $services);
        $xtpl->parse('main.services_js');
    }
}

if (!empty($array_products)) {
    foreach ($array_products as $products) {
        $xtpl->assign('PRODUCTS', $products);
        $xtpl->parse('main.products_js');
    }
}

foreach ($array_status as $index => $value) {
    $sl = $index == $row['status'] ? 'selected="selected"' : '';
    $xtpl->assign('STATUS', array(
        'index' => $index,
        'value' => $value,
        'selected' => $sl
    ));
    $xtpl->parse('main.status');
}

for ($i = 1; $i <= 24; $i++) {
    $xtpl->assign('CYCLE', array(
        'key' => $i,
        'value' => sprintf($lang_module['cycle_month'], $i),
        'selected' => $i == $row['cycle'] ? 'selected="selected"' : ''
    ));
    $xtpl->parse('main.cycle');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['content'];
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&id=' . $row['id']
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';