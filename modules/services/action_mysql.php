<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Tue, 16 Jan 2018 10:00:54 GMT
 */

if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customer";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_price_unit";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  price double unsigned NOT NULL,
  price_unit tinyint(1) NOT NULL,
  vat double unsigned NOT NULL DEFAULT '0',
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  note text NOT NULL,
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customer(
  id mediumint(8) NOT NULL AUTO_INCREMENT,
  customerid mediumint(8) NOT NULL,
  serviceid smallint(4) NOT NULL,
  title varchar(255) NOT NULL,
  note text NOT NULL,
  price double unsigned NOT NULL DEFAULT '0',
  month smallint(4) unsigned NOT NULL COMMENT 'Số tháng thanh toán',
  begintime int(11) unsigned NOT NULL DEFAULT '0',
  endtime int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  useradd mediumint(8) unsigned NOT NULL,
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  useredit mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_price_unit(
  id tinyint(2) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  weight tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";