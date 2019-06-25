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
    $mquery = $db->query("SELECT title, module_data FROM " . $db_config['prefix'] . "_" . $lang . "_modules WHERE module_file = 'workforce'");
    while (list ($mod, $mod_data) = $mquery->fetch(3)) {
        $sql = array();
        $data = array();
        $data['workdays'] = 24; // tổng số ngày công trong tháng
        $data['insurrance'] = 10.5; // hệ số tính bảo hiểm
        $data['overtime'] = 150; // tỉ lệ lương làm thêm giờ
        $data['termofcontract'] = 60; // Thời hạn hợp đồng tối đa

        foreach ($data as $config_name => $config_value) {
            $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($mod) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
        }

        $result_info_workforce = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $mod_data);
        while (list ($id) = $result_info_workforce->fetch(3)) {
            $sql[] = "INSERT INTO " . NV_PREFIXLANG . '_' . $mod_data . "_info (rows_id) VALUES ('" . $id . "')";
        }

        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD  createtime int(11) unsigned NOT NULL DEFAULT '0' AFTER edittime;";
        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD  duetime int(11) unsigned NOT NULL DEFAULT '0' AFTER createtime;";
        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD  cycle tinyint(1) unsigned NOT NULL DEFAULT '0' AFTER duetime;";

        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD  position varchar(100) NOT NULL AFTER jointime;";

        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD  part varchar(100) NOT NULL COMMENT 'Thuộc bộ phận' AFTER position;";

        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_salary ADD holiday DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER workday, ADD holiday_salary DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER holiday;";

        $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_salary ADD bhxh DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER total;";

        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_part(
          id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
          parentid smallint(4) unsigned NOT NULL DEFAULT '0',
          title varchar(255) NOT NULL COMMENT 'Tên gọi bộ phận',
          alias varchar(255) NOT NULL DEFAULT '',
          office varchar(255) NOT NULL DEFAULT '',
          address varchar(255) NOT NULL DEFAULT '',
          phone varchar(20) NOT NULL DEFAULT '',
          fax varchar(20) NOT NULL DEFAULT '',
          website varchar(100) NOT NULL DEFAULT '',
          email varchar(255) NOT NULL DEFAULT '',
          note tinytext NOT NULL COMMENT 'Ghi chú',
          lev smallint(4) unsigned NOT NULL DEFAULT '0',
          numsub smallint(4) unsigned NOT NULL DEFAULT '0',
          subid varchar(255) NOT NULL NULL DEFAULT '',
          sort smallint(4) unsigned NOT NULL DEFAULT '0',
          weight smallint(4) unsigned NOT NULL DEFAULT '0',
          status tinyint(1) NOT NULL COMMENT 'Trạng thái',
          PRIMARY KEY (id)
          ) ENGINE=MyISAM";

        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_part_detail(
          userid mediumint(8) unsigned NOT NULL,
          part smallint(4) NOT NULL COMMENT 'Thuộc bộ phận',
          UNIQUE KEY userid(userid, part)
          ) ENGINE=MyISAM";

        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_history_salary(
          id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
          userid mediumint(8) unsigned NOT NULL,
          salary double unsigned NOT NULL,
          allowance double unsigned NOT NULL DEFAULT '0' COMMENT 'Phụ cấp',
          useradd mediumint(8) NOT NULL,
          addtime varchar(10) NOT NULL,
          PRIMARY KEY (id),
          UNIQUE KEY userid (userid,addtime)
          ) ENGINE=MyISAM";

        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_field (
    	fid mediumint(8) NOT NULL AUTO_INCREMENT,
    	field varchar(25) NOT NULL,
    	weight int(10) unsigned NOT NULL DEFAULT '1',
    	field_type enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
    	field_choices text NOT NULL,
    	sql_choices text NOT NULL,
    	match_type enum('none','alphanumeric','email','url','regex','callback') NOT NULL DEFAULT 'none',
    	match_regex varchar(250) NOT NULL DEFAULT '',
    	func_callback varchar(75) NOT NULL DEFAULT '',
    	min_length int(11) NOT NULL DEFAULT '0',
    	max_length bigint(20) unsigned NOT NULL DEFAULT '0',
    	required tinyint(3) unsigned NOT NULL DEFAULT '0',
    	show_profile tinyint(4) NOT NULL DEFAULT '1',
    	class varchar(50) NOT NULL DEFAULT '',
    	language text NOT NULL,
    	default_value varchar(255) NOT NULL DEFAULT '',
    	PRIMARY KEY (fid),
    	UNIQUE KEY field (field)
    ) ENGINE=MyISAM";

        $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_info (
    	rows_id mediumint(8) unsigned NOT NULL,
    	PRIMARY KEY (rows_id)
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
