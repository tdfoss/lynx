<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Thu, 08 Feb 2018 08:32:31 GMT
 */

if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sendto";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_template";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  useradd mediumint(8) NOT NULL,
  cc_id varchar(255) NOT NULL,
  content text NOT NULL,
  files varchar(255) NOT NULL,
  addtime int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sendto(
  email_id int(11) unsigned NOT NULL,
  customer_id mediumint(8) unsigned NOT NULL,
  UNIQUE KEY email_id (email_id,customer_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_template(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  image varchar(255) NOT NULL,
  weight smallint(4) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";