<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Sun, 14 Jan 2018 08:03:09 GMT
 */
if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_types";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_performer";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_task";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_field";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_info";

$result = $db->query("SHOW TABLE STATUS LIKE '" . $db_config['prefix'] . "\_" . $lang . "\_comment'");
$rows = $result->fetchAll();
if (sizeof($rows)) {
    $sql_drop_module[] = "DELETE FROM " . $db_config['prefix'] . "_" . $lang . "_comment WHERE module='" . $module_name . "'";
}

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id mediumint(8) NOT NULL AUTO_INCREMENT,
  customerid mediumint(8) unsigned NOT NULL COMMENT 'ID khách hàng',
  workforceid varchar(255) NOT NULL COMMENT 'Nhân viên phụ trách',
  title varchar(255) NOT NULL,
  begintime int(11) unsigned NOT NULL,
  endtime int(11) unsigned NOT NULL DEFAULT '0',
  realtime int(11) unsigned NOT NULL DEFAULT '0',
  price double unsigned NOT NULL DEFAULT '0',
  vat double unsigned NOT NULL DEFAULT '0',
  url_code text NOT NULL,
  content text NOT NULL,
  files text NOT NULL,
  useradd smallint(4) unsigned NOT NULL COMMENT 'Nhân viên tạo',
  addtime int(11) unsigned NOT NULL,
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  type_id smallint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_types(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Loại dự án',
  note text NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent(
  action varchar(100) NOT NULL,
  econtent text NOT NULL,
  PRIMARY KEY (action)
) ENGINE=MyISAM";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent (action, econtent) VALUES('new_project', 'Xin chào <strong>[CUSTOMER_LAST_NAME] [CUSTOMER_FISRT_NAME]</strong>. Dự án&nbsp;<strong>[TITLE]</strong> đã được khởi tạo tại <strong>[SITE_NAME]</strong>. Dưới đây là thông tin chi tiết về dự án. <ul> <li><strong>Tên dự án:</strong>&nbsp;[TITLE]</li> <li><strong>Thời gian bắt đầu: </strong>[BEGIN_TIME]</li> <li><strong>Thời gian hoàn thành (dự kiến):</strong>&nbsp;[END_TIME]</li> <li><strong>Trạng thái:&nbsp;</strong>[STATUS]</li> </ul> [CONTENT]<br /> <br /> Mọi thông tin, hoạt động đến dự án sẽ được thông báo qua thư này.<br /> Chúc quý khách hàng một ngày làm làm việc hiệu quả!')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent (action, econtent) VALUES('print', '<div style=\"line-height: 27px\"> <div style=\"text-align: center;\"><span style=\"font-size:18px;\"><strong>THÔNG TIN DỰ ÁN</strong></span></div> <div style=\"text-align: center;\"><strong>[TITLE]</strong></div> <br /> Danh mục dự án:&nbsp;<strong>[CAT]</strong><br /> Họ tên khách hàng:&nbsp;<strong>[CUSTOMER_FULLNAME]</strong><br /> Thời gian bắt đầu:&nbsp;<strong>[BEGIN_TIME]</strong><br /> Thời gian hoàn thành dự kiến:&nbsp;<strong>[END_TIME]</strong><br /> Thời gian hoàn thành thực tế:&nbsp;<strong>[REAL_TIME]</strong><br /> Chi phí:&nbsp;<strong>[PRICE]</strong><br /> Thuế:&nbsp;<strong>[VAT]%</strong><br /> <strong>[STATUS]</strong>: Trạng thái<br /> <br /> [CONTENT]</div>')";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_performer(
  projectid int(11) unsigned NOT NULL,
  userid mediumint(8) unsigned NOT NULL,
  follow tinyint(1) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY projectid (projectid,userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_task(
  taskid int(11) unsigned NOT NULL,
  projectid mediumint(8) unsigned NOT NULL,
  UNIQUE KEY taskid(taskid, projectid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_field (
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

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_info (
	rows_id mediumint(8) unsigned NOT NULL,
	PRIMARY KEY (rows_id)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'perpagecomm', '5')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timeoutcomm', '360')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowattachcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'alloweditorcomm', '0')";

$data = array();
$data['groups_manage'] = 1;
$data['default_status'] = '1,2,3';

foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}
