<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 22 Nov 2017 13:35:04 GMT
 */

if (!defined('NV_IS_MOD_OFFICE')) die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_money WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['type'] = $nv_Request->get_int('type', 'get', 1);
    $row['money'] = '';
    $row['date'] = NV_CURRENTTIME;
    $row['note'] = '';
}

$row['redirect'] = $nv_Request->get_string('redirect', 'post,get', '');

if ($nv_Request->isset_request('submit', 'post')) {
    $row['type'] = $nv_Request->get_int('type', 'post', 0);
    $row['money'] = $nv_Request->get_title('money', 'post', '');
    $row['note'] = $nv_Request->get_string('note', 'post', '');

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('date', 'post'), $m)) {
        $row['date'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['date'] = 0;
    }

    if (empty($row['type'])) {
        $error[] = $lang_module['error_required_type'];
    } elseif (empty($row['money'])) {
        $error[] = $lang_module['error_required_money'];
    }

    if (empty($error)) {
        $row['money'] = nv_make_number($row['money']);
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_money (type, date, money, note, addtime, userid) VALUES (:type, :date, :money, :note, ' . NV_CURRENTTIME . ', ' . $user_info['userid'] . ')');
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_money SET type = :type, date = :date, money = :money, note = :note WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':type', $row['type'], PDO::PARAM_INT);
            $stmt->bindParam(':date', $row['date'], PDO::PARAM_INT);
            $stmt->bindParam(':money', $row['money'], PDO::PARAM_STR);
            $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));

            $exc = $stmt->execute();
            if ($exc) {
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, '[' . $lang_module['add'] . '] ' . $lang_module['money_' . $row['type']], nv_number_format($row['money']), $user_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, '[' . $lang_module['edit'] . '] ' . $lang_module['money_' . $row['type']], nv_number_format($row['money']), $user_info['userid']);
                }
                $nv_Cache->delMod($module_name);

                if (!empty($row['redirect'])) {
                    $url = nv_redirect_decrypt($row['redirect']);
                } else {
                    $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['money'];
                }
                nv_redirect_location($url);
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
}

$row['date'] = !empty($row['date']) ? nv_date('d/m/Y', $row['date']) : '';
$lang_module['money_add'] = $lang_module['money_' . $row['type'] . '_add'];
$lang_module['money_date'] = $lang_module['money_' . $row['type'] . '_date'];

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('TEMPLATE', $module_info['template']);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['money_add'];
$array_mod_title[] = array(
    'title' => $lang_module['money_' . $row['type']],
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['money'] . '&amp;type=' . $row['type']
);
$array_mod_title[] = array(
    'title' => $page_title,
    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op
);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';