<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2017 mynukeviet. All rights reserved
 * @Createdate Thu, 16 Nov 2017 14:20:02 GMT
 */
if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  type tinyint(1) unsigned NOT NULL,
  date int(11) unsigned NOT NULL,
  money double NOT NULL,
  note text NOT NULL,
  addtime int(11) unsigned NOT NULL,
  userid mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$data = array(
    'workgroup' => 4,
    'groupmanager' => 4
);

foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}