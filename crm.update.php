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

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_products ADD catid smallint(4) unsigned NOT NULL AFTER title";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'projects', 'groups_manage', '1');";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'invoice', 'default_status', '0,1,2,3,4');";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'customer', 'groups_admin', '1'), ('" . $lang . "', 'customer', 'groups_manage', '1,2,3');";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_products ADD url TEXT NOT NULL AFTER vat;";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_projects_task( taskid int(11) unsigned NOT NULL, projectid mediumint(8) unsigned NOT NULL, UNIQUE KEY taskid(taskid, projectid) ) ENGINE=MyISAM";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_products_cat (id smallint(4) NOT NULL AUTO_INCREMENT,title varchar(255) NOT NULL,note text NOT NULL,weight smallint(4) unsigned NOT NULL,PRIMARY KEY (id)) ENGINE=MyISAM;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_workforce_salary CHANGE total total DOUBLE NOT NULL COMMENT 'Tổng';";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_workforce_salary CHANGE received received DOUBLE NOT NULL COMMENT 'Thực nhận';";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_customer_tags (tid smallint(4) NOT NULL AUTO_INCREMENT,title varchar(255) NOT NULL COMMENT 'Tiêu đề', note text  NOT NULL COMMENT 'Ghi chú',PRIMARY KEY (tid)) ENGINE=MyISAM;";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_customer_tags_customer( tid smallint(4) NOT NULL, customerid mediumint(8) unsigned NOT NULL, UNIQUE KEY tid (tid, customerid) ) ENGINE=MyISAM";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer ADD tag_id VARCHAR(100) NOT NULL AFTER type_id;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer ADD share_acc varchar(100) NOT NULL COMMENT 'share với tài khoản' AFTER tag_id;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer ADD share_groups smallint(4) unsigned NOT NULL COMMENT 'share với group' AFTER share_acc;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_projects ADD vat DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER price;";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'workreport', 'allow_days', '1');";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_invoice_detail ADD unit_price double NOT NULL DEFAULT '0' AFTER itemid;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_projects ADD files TEXT NOT NULL AFTER content;";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'projects', 'default_status', '1,2,3');";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'notification', 'slack_tocken', '');";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_invoice ADD paytime INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER duetime;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_invoice CHANGE sended sended SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Số lượt gửi thông tin hóa đơn';";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_email ADD status tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER addtime;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_products ADD price_unit tinyint(1) NOT NULL AFTER vat";

    $sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', 'workreport', 'type_content', '1');";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_customer_share_acc(
           userid smallint(4) NOT NULL,
           customerid mediumint(8) unsigned NOT NULL,
           permisson tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Quyền',
           UNIQUE KEY tid (userid, customerid)
         ) ENGINE=MyISAM;";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_customer_units(
           tid smallint(4) NOT NULL AUTO_INCREMENT,
           title varchar(255) NOT NULL COMMENT 'Tiêu đề',
           note text NOT NULL COMMENT 'Ghi chú',
           PRIMARY KEY (tid)
         ) ENGINE=MyISAM;";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_customer_units_customer(
           tid smallint(4) NOT NULL,
           customerid mediumint(8) unsigned NOT NULL,
           UNIQUE KEY tid (tid, customerid)
         ) ENGINE=MyISAM;";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_products_price_unit(
           id tinyint(2) NOT NULL AUTO_INCREMENT,
           title varchar(255) NOT NULL,
           active tinyint(1) unsigned NOT NULL DEFAULT '1',
           weight tinyint(2) NOT NULL DEFAULT '0',
           PRIMARY KEY (id)
         ) ENGINE=MyISAM;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer CHANGE care_staff care_staff MEDIUMINT(8) UNSIGNED NOT NULL COMMENT 'Nhân viên chăm sóc KH';";

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_projects_field (
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

    $sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_projects_info (
    	rows_id mediumint(8) unsigned NOT NULL,
    	PRIMARY KEY (rows_id)
    ) ENGINE=MyISAM";

    $sql[] = 'INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_projects_econtent (action, econtent) VALUES("print", "<div style=\"line-height: 27px\"> <div style=\"text-align: center;\"><span style=\"font-size:18px;\"><strong>THÔNG TIN DỰ ÁN</strong></span></div> <div style=\"text-align: center;\"><strong>[TITLE]</strong></div> <br /> Danh mục dự án:&nbsp;<strong>[CAT]</strong><br /> Họ tên khách hàng:&nbsp;<strong>[CUSTOMER_FULLNAME]</strong><br /> Thời gian bắt đầu:&nbsp;<strong>[BEGIN_TIME]</strong><br /> Thời gian hoàn thành dự kiến:&nbsp;<strong>[END_TIME]</strong><br /> Thời gian hoàn thành thực tế:&nbsp;<strong>[REAL_TIME]</strong><br /> Chi phí:&nbsp;<strong>[PRICE]</strong><br /> Thuế:&nbsp;<strong>[VAT]%</strong><br /> <strong>[STATUS]</strong>: Trạng thái<br /> <br /> [CONTENT]</div>")';

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_services_price_unit ADD note text NOT NULL AFTER title;";

    $sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_customer ADD website VARCHAR(255) NOT NULL AFTER zalo;";

    foreach ($sql as $_sql) {
        try {
            $db->query($_sql);
        } catch (PDOException $e) {
            //
        }
    }
    $nv_Cache->delAll();
}
die('OK');