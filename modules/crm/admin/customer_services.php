<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 04 Jan 2018 04:28:29 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

if ($nv_Request->isset_request('ajax_action', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $new_vid = $nv_Request->get_int('new_vid', 'post', 0);
    $content = 'NO_' . $id;
    if ($new_vid > 0) {
        $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id!=' . $id . ' ORDER BY weight ASC';
        $result = $db->query($sql);
        $weight = 0;
        while ($row = $result->fetch()) {
            ++$weight;
            if ($weight == $new_vid) ++$weight;
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services SET weight=' . $weight . ' WHERE id=' . $row['id'];
            $db->query($sql);
        }
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services SET weight=' . $new_vid . ' WHERE id=' . $id;
        $db->query($sql);
        $content = 'OK_' . $id;
    }
    $nv_Cache->delMod($module_name);
    include NV_ROOTDIR . '/includes/header.php';
    echo $content;
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}
if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $weight = 0;
        $sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id =' . $db->quote($id);
        $result = $db->query($sql);
        list ($weight) = $result->fetch(3);
        
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services  WHERE id = ' . $db->quote($id));
        if ($weight > 0) {
            $sql = 'SELECT id, weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE weight >' . $weight;
            $result = $db->query($sql);
            while (list ($id, $weight) = $result->fetch(3)) {
                $weight--;
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services SET weight=' . $weight . ' WHERE id=' . intval($id));
            }
        }
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['id_customer'] = $nv_Request->get_int('id_customer', 'post', 0);
    $row['id_services'] = $nv_Request->get_int('id_services', 'post', 0);
    $row['id_user'] = $nv_Request->get_int('id_user', 'post', 0);
    $row['time_add'] = $nv_Request->get_title('time_add', 'post', '');
    $row['time_exp'] = $nv_Request->get_title('time_exp', 'post', '');
    $row['id_order'] = $nv_Request->get_int('id_order', 'post', 0);
    
    if (empty($row['id_customer'])) {
        $error[] = $lang_module['error_required_id_customer'];
    } elseif (empty($row['id_services'])) {
        $error[] = $lang_module['error_required_id_services'];
    } elseif (empty($row['id_user'])) {
        $error[] = $lang_module['error_required_id_user'];
    } elseif (empty($row['time_add'])) {
        $error[] = $lang_module['error_required_time_add'];
    } elseif (empty($row['time_exp'])) {
        $error[] = $lang_module['error_required_time_exp'];
    }
    
    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services (id_customer, id_services, id_user, time_add, time_exp, id_order, weight) VALUES (:id_customer, :id_services, :id_user, :time_add, :time_exp, :id_order, :weight)');
                
                $weight = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services')->fetchColumn();
                $weight = intval($weight) + 1;
                $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
            
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services SET id_customer = :id_customer, id_services = :id_services, id_user = :id_user, time_add = :time_add, time_exp = :time_exp, id_order = :id_order WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':id_customer', $row['id_customer'], PDO::PARAM_INT);
            $stmt->bindParam(':id_services', $row['id_services'], PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $row['id_user'], PDO::PARAM_INT);
            $stmt->bindParam(':time_add', $row['time_add'], PDO::PARAM_STR);
            $stmt->bindParam(':time_exp', $row['time_exp'], PDO::PARAM_STR);
            $stmt->bindParam(':id_order', $row['id_order'], PDO::PARAM_INT);
            
            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['id_customer'] = 0;
    $row['id_services'] = 0;
    $row['id_user'] = 0;
    $row['time_add'] = '';
    $row['time_exp'] = '';
    $row['id_order'] = 0;
}
$array_id_customer_crm = array();
$_sql = 'SELECT id,name_client FROM nv4_vi_crm_customer';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_id_customer_crm[$_row['id']] = $_row;
}

$array_id_services_crm = array();
$_sql = 'SELECT id,title FROM nv4_vi_crm_services';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_id_services_crm[$_row['id']] = $_row;
}

$array_id_user_users = array();
$_sql = 'SELECT userid,first_name FROM nv4_users';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_id_user_users[$_row['userid']] = $_row;
}

$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . NV_PREFIXLANG . '_' . $module_data . '_customer_services');
    
    if (!empty($q)) {
        $db->where('id_customer LIKE :q_id_customer OR id_services LIKE :q_id_services OR id_user LIKE :q_id_user OR time_add LIKE :q_time_add OR time_exp LIKE :q_time_exp OR id_order LIKE :q_id_order');
    }
    $sth = $db->prepare($db->sql());
    
    if (!empty($q)) {
        $sth->bindValue(':q_id_customer', '%' . $q . '%');
        $sth->bindValue(':q_id_services', '%' . $q . '%');
        $sth->bindValue(':q_id_user', '%' . $q . '%');
        $sth->bindValue(':q_time_add', '%' . $q . '%');
        $sth->bindValue(':q_time_exp', '%' . $q . '%');
        $sth->bindValue(':q_id_order', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();
    
    $db->select('*')
        ->order('weight ASC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());
    
    if (!empty($q)) {
        $sth->bindValue(':q_id_customer', '%' . $q . '%');
        $sth->bindValue(':q_id_services', '%' . $q . '%');
        $sth->bindValue(':q_id_user', '%' . $q . '%');
        $sth->bindValue(':q_time_add', '%' . $q . '%');
        $sth->bindValue(':q_time_exp', '%' . $q . '%');
        $sth->bindValue(':q_id_order', '%' . $q . '%');
    }
    $sth->execute();
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_id_customer_crm as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['name_client'],
        'selected' => ($value['id'] == $row['id_customer']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_id_customer');
}
foreach ($array_id_services_crm as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $row['id_services']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_id_services');
}
foreach ($array_id_user_users as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['userid'],
        'title' => $value['first_name'],
        'selected' => ($value['userid'] == $row['id_user']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_id_user');
}
$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
    while ($view = $sth->fetch()) {
        for ($i = 1; $i <= $num_items; ++$i) {
            $xtpl->assign('WEIGHT', array(
                'key' => $i,
                'title' => $i,
                'selected' => ($i == $view['weight']) ? ' selected="selected"' : ''
            ));
            $xtpl->parse('main.view.loop.weight_loop');
        }
        $view['id_customer'] = $array_id_customer_crm[$view['id_customer']]['name_client'];
        $view['id_services'] = $array_id_services_crm[$view['id_services']]['title'];
        $view['id_user'] = $array_id_user_users[$view['id_user']]['first_name'];
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }
    $xtpl->parse('main.view');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['customer_services'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';