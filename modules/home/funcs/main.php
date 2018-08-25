<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 3-6-2010 0:14
 */
if (!defined('NV_IS_MOD_HOME')) die('Stop!!!');

define('NV_IS_FILE_SITEINFO', true);

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$disabled_module = array(
    'users'
);

//Noi dung chinh cua trang
$info = $pending_info = array();

foreach ($site_mods as $mod => $value) {
    if (!in_array($mod, $disabled_module)) {
        if (file_exists(NV_ROOTDIR . '/modules/' . $value['module_file'] . '/siteinfo.php')) {
            $siteinfo = $pendinginfo = array();
            $mod_data = $value['module_data'];

            include NV_ROOTDIR . '/modules/' . $value['module_file'] . '/siteinfo.php';

            if (!empty($siteinfo)) {
                $info[$mod]['caption'] = $value['custom_title'];
                $info[$mod]['field'] = $siteinfo;
            }

            if (!empty($pendinginfo)) {
                $pending_info[$mod]['caption'] = $value['custom_title'];
                $pending_info[$mod]['field'] = $pendinginfo;
            }
        }
    }
}

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);

// Thong tin thong ke tu cac module
if (!empty($info) or !empty($pending_info)) {
    if (!empty($info)) {
        $i = 0;
        foreach ($info as $if) {
            foreach ($if['field'] as $field) {
                $xtpl->assign('KEY', $field['key']);
                $xtpl->assign('VALUE', $field['value']);
                $xtpl->assign('MODULE', $if['caption']);

                if (!empty($field['link'])) {
                    $xtpl->assign('LINK', $field['link']);
                    $xtpl->parse('main.info.loop.link');
                } else {
                    $xtpl->parse('main.info.loop.text');
                }

                $xtpl->parse('main.info.loop');
            }
        }

        $xtpl->parse('main.info');
    }

    // Thong tin dang can duoc xu ly tu cac module
    if (!empty($pending_info)) {
        $i = 0;
        foreach ($pending_info as $if) {
            foreach ($if['field'] as $field) {
                $xtpl->assign('KEY', $field['key']);
                $xtpl->assign('VALUE', $field['value']);
                $xtpl->assign('MODULE', $if['caption']);

                if (!empty($field['link'])) {
                    $xtpl->assign('LINK', $field['link']);
                    $xtpl->parse('main.pendinginfo.loop.link');
                } else {
                    $xtpl->parse('main.pendinginfo.loop.text');
                }

                $xtpl->parse('main.pendinginfo.loop');
            }
        }

        $xtpl->parse('main.pendinginfo');
    }
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_site_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");