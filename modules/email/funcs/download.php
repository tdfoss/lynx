<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 07 Feb 2018 09:53:43 GMT
 */

if (!defined('NV_IS_MOD_EMAIL')) die('Stop!!!');

$id = $nv_Request->get_int('id', 'get', 0);
$file_src = $db->query('SELECT files FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetchColumn();
if ($file_src) {
    $file_src = NV_ROOTDIR . '/' . $file_src;
    $download = new NukeViet\Files\Download($file_src, NV_UPLOADS_REAL_DIR . '/' . $module_upload);
    $download->download_file();
    exit();
}
die('Nothing to download!');