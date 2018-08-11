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
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  catid smallint(4) unsigned NOT NULL,
  price double unsigned NOT NULL,
  vat double unsigned NOT NULL DEFAULT '0',
  url text NOT NULL,
  active tinyint(1) unsigned NOT NULL DEFAULT '1',
  note text NOT NULL,
  weight smallint(4) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  note text NOT NULL,
  weight smallint(4) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM;";