<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Mon, 12 Feb 2018 07:01:21 GMT
 */
if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_types";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags_customer";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_share_acc";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_units";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_field";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_info";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events_type";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id mediumint(8) NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL COMMENT 'Tên',
  last_name varchar(100) NOT NULL COMMENT 'Họ và tên đệm',
  main_phone varchar(20) NOT NULL COMMENT 'Số điện thoại',
  other_phone varchar(255) NOT NULL COMMENT 'Số điện thoại khác',
  main_email varchar(100) NOT NULL COMMENT 'Email',
  other_email varchar(255) NOT NULL COMMENT 'Email khác',
  birthday int(11) unsigned NOT NULL DEFAULT '0',
  facebook varchar(255) NOT NULL,
  skype varchar(50) NOT NULL,
  zalo varchar(255) NOT NULL,
  website varchar(255) NOT NULL,
  gender tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Giới tính',
  address varchar(255) NOT NULL COMMENT 'Địa chỉ',
  unit varchar(255) NOT NULL COMMENT 'Đơn vị công tác',
  care_staff mediumint(8) unsigned NOT NULL COMMENT 'Nhân viên chăm sóc KH',
  image varchar(255) NOT NULL,
  addtime int(11) unsigned NOT NULL COMMENT 'Thời gian thêm',
  edittime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian sửa',
  userid_link mediumint(8) unsigned NOT NULL COMMENT 'Tài khoản liên kết',
  userid mediumint(8) unsigned NOT NULL COMMENT 'Người thêm',
  note text NOT NULL COMMENT 'Ghi chú',
  is_contacts tinyint(1) NOT NULL COMMENT 'Loại khách hàng',
  type_id smallint(4) unsigned NOT NULL DEFAULT '0',
  tag_id varchar(100) NOT NULL,
  share_acc varchar(100) NOT NULL COMMENT 'share với tài khoản',
  share_groups smallint(4) unsigned NOT NULL COMMENT 'share với group',
  PRIMARY KEY (id),
  UNIQUE KEY main_phone (main_phone),
  UNIQUE KEY main_email (main_email)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_types(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Loại khách hàng',
  note text NOT NULL COMMENT 'Ghi chú',
  title_mail varchar(255) NOT NULL COMMENT 'tiêu đề mail chào mừng',
  content text NOT NULL COMMENT 'Nội dung mail chào mừng',
  birthday_title varchar(255) NOT NULL COMMENT 'Tiêu đề chúc mừng sinh nhật',
  birthday_content text NOT NULL COMMENT 'Nội dung chúc mừng sinh nhật',
  weight smallint(4) unsigned NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags(
  tid smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tiêu đề',
  note text NOT NULL COMMENT 'Ghi chú',
  PRIMARY KEY (tid)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_tags_customer(
  tid smallint(4) NOT NULL,
  customerid mediumint(8) unsigned NOT NULL,
  UNIQUE KEY tid (tid, customerid)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_units(
  tid smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tiêu đề',
  note text NOT NULL DEFAULT '' COMMENT 'Ghi chú',
  PRIMARY KEY (tid)
) ENGINE=MyISAM;";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_share_acc(
  userid smallint(4) NOT NULL,
  customerid mediumint(8) unsigned NOT NULL,
  permisson tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Quyền',
  UNIQUE KEY tid (userid, customerid, permisson)
) ENGINE=MyISAM;";

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

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events (
	id mediumint(8) unsigned NOT NULL,
    customer_id mediumint(8) unsigned NOT NULL,
    event_type_id tinyint(2) unsigned NOT NULL DEFATLT '0' COMMENT 'Loại sự kiện',
    content text NOT NULL,
    userid mediumint(8) unsigned NOT NULL COMMENT 'Người thực hiện',
    eventtime int(11) unsigned NOT NULL,
    addtime int(11) unsigned NOT NULL,
	PRIMARY KEY (id),
    KEY customer_id(customer_id),
    KEY event_type_id(event_type_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events_type(
  id tinyint(2) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  note text NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$data = array();
$array_config['groups_admin'] = '1';
$array_config['groups_manage'] = '1,2,3';

foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}

$sql_create_module[] = "INSERT INTO " . NV_CRONJOBS_GLOBALTABLE . " (start_time, inter_val, run_file, run_func, params, del, is_sys, act, last_time, last_result, vi_cron_name) VALUES (1547838000, 1440, 'customer_happy_birthday.php', 'cron_customer_happy_birthday', '', 0, 0, 1, 1547865509, 1, 'Gửi thư chúc mừng sinh nhật khách hàng');";
