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
    $sql = array();

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer ADD unit VARCHAR(255) NOT NULL COMMENT 'Đơn vị cá nhân' AFTER address;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_support ADD priority TINYINT(1) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Mức độ ưu tiên' AFTER useradd";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'projects', 'groups_manage', '1');";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'invoice', 'default_status', '0,1,2,3,4');";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'customer', 'groups_admin', '1'), ('" . $lang . "', 'customer', 'groups_manage', '1,2,3');";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_products ADD url TEXT NOT NULL AFTER vat;";

    foreach ($sql as $_sql) {
        try {
            $db->query($_sql);
        } catch (PDOException $e) {
            //
        }
    }
    $nv_Cache->delMod($mod);
}
die('OK');