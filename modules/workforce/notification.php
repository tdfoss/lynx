<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if ($data['module'] != $module_name) {
    require_once NV_ROOTDIR . '/modules/' . $site_mods[$data['module']]['module_file'] . '/language/' . NV_LANG_DATA . '.php';
}

$data['title'] = $data['content']['content'];
$data['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $data['module'] . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $data['obid'];
