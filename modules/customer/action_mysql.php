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
  gender tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Giới tính',
  address varchar(255) NOT NULL COMMENT 'Địa chỉ',
  unit varchar(255) NOT NULL COMMENT 'Đơn vị công tác',
  trading_person varchar(255) NOT NULL COMMENT 'Người giao dịch',
  unit_name varchar(255) NOT NULL COMMENT 'Đơn vị',
  tax_code varchar(30) NOT NULL COMMENT 'Mã số thuế',
  address_invoice varchar(255) NOT NULL COMMENT 'Địa chỉ đơn vị',
  care_staff smallint(4) unsigned NOT NULL COMMENT 'Nhân viên chăm sóc KH',
  image varchar(255) NOT NULL,
  addtime int(11) unsigned NOT NULL COMMENT 'Thời gian thêm',
  edittime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian sửa',
  userid mediumint(8) unsigned NOT NULL COMMENT 'Người thêm',
  note text NOT NULL COMMENT 'Ghi chú',
  is_contacts tinyint(1) NOT NULL COMMENT 'Loại khách hàng',
  type_id smallint(4) unsigned NOT NULL DEFAULT '0',
  tag_id varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_types(
  id smallint(4) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Loại khách hàng',
  note text NOT NULL COMMENT 'Ghi chú',
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

$data = array();
$array_config['groups_admin'] = '1';
$array_config['groups_manage'] = '1,2,3';

foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}
