<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 02 Jan 2018 08:50:17 GMT
 */
if (!defined('NV_IS_MOD_PRODUCTS')) die('Stop!!!');

//change status
if ($nv_Request->isset_request('change_status', 'post, get')) {
    $id = $nv_Request->get_int('id', 'post, get', 0);
    $content = 'NO_' . $id;

    $query = 'SELECT active FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (isset($row['active'])) {
        $active = ($row['active']) ? 0 : 1;
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

if ($nv_Request->isset_request('ajax_action', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $new_vid = $nv_Request->get_int('new_vid', 'post', 0);
    $content = 'NO_' . $id;
    if ($new_vid > 0) {
        $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id!=' . $id . ' ORDER BY weight ASC';
        $result = $db->query($sql);
        $weight = 0;
        while ($row = $result->fetch()) {
            ++$weight;
            if ($weight == $new_vid) ++$weight;
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $weight . ' WHERE id=' . $row['id'];
            $db->query($sql);
        }
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $new_vid . ' WHERE id=' . $id;
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
        nv_delete_products($id);
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            $userid = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
            if ($userid) {
                $array_name[] = $workforce_list[$userid]['fullname'];
            }
            nv_delete_products($id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$q = $nv_Request->get_title('q', 'post,get');

$page = $nv_Request->get_int('page', 'post,get', 1);
$is_contact = $nv_Request->get_int('is_contact', 'get', 0);
$where = '';
if ($nv_Request->isset_request('ordername', 'get')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'get');
    $nv_Request->set_Cookie('ordername', $array_search['ordername']);
} elseif ($nv_Request->isset_request('ordername', 'cookie')) {
    $array_search['ordername'] = $nv_Request->get_title('ordername', 'cookie');
} else {
    $array_search['ordername'] = 'first_name';
}

if ($nv_Request->isset_request('ordertype', 'get')) {
    $array_search['ordertype'] = $nv_Request->get_title('ordertype', 'get');
    $nv_Request->set_Cookie('ordertype', $array_search['ordertype']);
} elseif ($nv_Request->isset_request('ordername', 'cookie')) {
    $array_search['ordertype'] = $nv_Request->get_title('ordertype', 'cookie');
} else {
    $array_search['ordertype'] = 'asc';
}
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;is_contact=' . $is_contact;
if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND (id LIKE "%' . $array_search['q'] . '%"
        OR title LIKE "%' . $array_search['q'] . '%"
        OR catid LIKE "%' . $array_search['q'] . '%"
        OR price LIKE "%' . $array_search['q'] . '%"
        OR vat LIKE "%' . $array_search['q'] . '%"
        OR url LIKE "%' . $array_search['q'] . '%"
        OR active LIKE "%' . $array_search['q'] . '%"
        OR note LIKE "%' . $array_search['q'] . '%"

    )';
}

$array_search = array(
    'q' => $nv_Request->get_title('q', 'post,get'),
    'catid' => $nv_Request->get_int('catid', 'post,get', 0)
);

// var_dump($array_search);die;
if (!empty($array_search['catid'])) {
    $base_url .= '&catid=' . $array_search['catid'];
    $where .= ' AND catid=' . $array_search['catid'];
}

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . NV_PREFIXLANG . '_' . $module_data . '')
        ->where('1=1' . $where);

    if (!empty($q)) {
        $db->where('title LIKE :q_title OR price LIKE :q_price');
    }
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_title', '%' . $q . '%');
        $sth->bindValue(':q_price', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('weight ASC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_title', '%' . $q . '%');
        $sth->bindValue(':q_price', '%' . $q . '%');
    }
    $sth->execute();
}


$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('Q', $q);
$xtpl->assign('URL_ADD', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content']);

foreach ($array_type as $value) {
    $xtpl->assign('TYPE', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $array_search['catid']) ? ' selected="selected"' : ''

    ));
    $xtpl->parse('main.select_type');
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
if (!empty($q)) {
    $base_url .= '&q=' . $q;
}
$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}
$number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
while ($view = $sth->fetch()) {
    $view['price'] = !empty($view['price']) ? $view['price'] : '';

    for ($i = 1; $i <= $num_items; ++$i) {
        $xtpl->assign('WEIGHT', array(
            'key' => $i,
            'title' => $i,
            'selected' => ($i == $view['weight']) ? ' selected="selected"' : ''
        ));
        $xtpl->parse('main.loop.weight_loop');
    }
    $xtpl->assign('CHECK', $view['active'] == 1 ? 'checked' : '');
    $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '&amp;id=' . $view['id'];
    $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
    $view['catid'] = !empty($view['catid']) ? $array_type[$view['catid']]['title'] : '';

    //     var_dump($array_type);die;
    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');
}

$array_action = array(
    'delete_list_id' => $lang_global['delete']
);
foreach ($array_action as $key => $value) {
    $xtpl->assign('ACTION', array(
        'key' => $key,
        'value' => $value
    ));
    $xtpl->parse('main.action_top');
    $xtpl->parse('main.action_bottom');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['products'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';