<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 02 Dec 2015 08:26:04 GMT
 */
define('NV_SYSTEM', true);

// Xac dinh thu muc goc cua site
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __file__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/includes/mainfile.php';
require NV_ROOTDIR . '/includes/core/user_functions.php';

// Duyệt tất cả các ngôn ngữ
$language_query = $db->query('SELECT lang FROM ' . $db_config['prefix'] . '_setup_language WHERE setup = 1');
while (list ($lang) = $language_query->fetch(3)) {
    // Duyet laws va module ao
    $mquery = $db->query("SELECT title, module_data FROM " . $db_config['prefix'] . "_" . $lang . "_modules WHERE module_file = 'projects'");
    while (list ($mod, $mod_data) = $mquery->fetch(3)) {
        $sql = array();
        
        $result_info_project = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $mod_data);
        while (list ($id) = $result_info_project->fetch(3)) {
            $sql[] = "INSERT INTO " . NV_PREFIXLANG . '_' . $mod_data . "_info (rows_id) VALUES ('" . $id . "')";
        }
        
        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " CHANGE workforceid workforceid VARCHAR(255) NOT NULL COMMENT 'Nhân viên phụ trách' ";
        
        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_performer(
          projectid int(11) unsigned NOT NULL,
          userid mediumint(8) unsigned NOT NULL,
          follow tinyint(1) unsigned NOT NULL DEFAULT '1',
          UNIQUE KEY projectid (projectid,userid)
        ) ENGINE=MyISAM";
        
        foreach ($sql as $_sql) {
            try {
                $db->query($_sql);
            } catch (PDOException $e) {
                //
            }
        }
        $nv_Cache->delMod($mod);
    }
}
die('OK');