    <?php

    /**
     * @Project NUKEVIET 4.x
     * @Author TDFOSS.,LTD (contact@tdfoss.vn)
     * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
     * @Createdate Sat, 05 May 2018 23:45:39 GMT
     */
    if (!defined('NV_IS_MOD_WORKFORCE')) die('Stop!!!');

    $id = $nv_Request->get_int('id', 'get', 0);

    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id)->fetch();
    if (!$result) {
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
    }

    $result['fullname'] = nv_show_name_user($result['first_name'], $result['last_name']);
    $result['gender'] = $array_gender[$result['gender']];
    $result['status'] = $lang_module['status_' . $result['status']];
    $result['addtime'] = nv_date('H:i d/m/Y', $result['addtime']);
    $result['edittime'] = !empty($result['edittime']) ? nv_date('H:i d/m/Y', $result['edittime']) : '';
    $result['birthday'] = !empty($result['birthday']) ? nv_date('d/m/Y', $result['birthday']) : '';
    if ($result['jointime'] > 0) {
        $result['jointime'] = nv_date('d/m/Y', $result['jointime']);
    }

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('URL_EDIT', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $id);
    $xtpl->assign('URL_DELETE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;delete_id=' . $id . '&amp;delete_checkss=' . md5($id . NV_CACHE_PREFIX .  $client_info['session_id']));
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('WORKFORCE', $result);

    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme($contents);
    include NV_ROOTDIR . '/includes/footer.php';
