<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Mon, 12 Feb 2018 07:01:21 GMT
 */

if ( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobtitle";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_part";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_products";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_workforce";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobtitle(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi chức vụ',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_part(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  parentid smallint(4) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL COMMENT 'Tên gọi bộ phận',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  lev smallint(4) unsigned NOT NULL DEFAULT '0',
  numsub smallint(4) unsigned NOT NULL DEFAULT '0',
  subid varchar(255) DEFAULT '',
  sort smallint(4) unsigned NOT NULL DEFAULT '0',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_products(
  id smallint(10) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  price double unsigned NOT NULL,
  description text NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '0',
  weight smallint(4) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_workforce(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  partid smallint(4) unsigned NOT NULL COMMENT 'Thuộc bộ phận',
  jobtitleid smallint(4) unsigned NOT NULL,
  userid mediumint(8) unsigned NOT NULL,
  first_name varchar(100) NOT NULL,
  last_name varchar(50) NOT NULL,
  gender tinyint(1) unsigned NOT NULL DEFAULT '1',
  birthday int(11) unsigned NOT NULL DEFAULT '0',
  main_phone varchar(20) NOT NULL,
  other_phone varchar(255) NOT NULL,
  main_email varchar(100) NOT NULL,
  other_email varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  knowledge text NOT NULL COMMENT 'Thông tin học vấn',
  image varchar(255) NOT NULL,
  jointime int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  useradd mediumint(8) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";