<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Mon, 26 Feb 2018 06:10:40 GMT
 */
if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_detail";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_transaction";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  code varchar(6) NOT NULL,
  customerid mediumint(8) unsigned NOT NULL,
  createtime int(11) unsigned NOT NULL DEFAULT '0',
  duetime int(11) unsigned NOT NULL DEFAULT '0',
  paytime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian xác nhận thanh toán',
  cycle tinyint(1) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  workforceid smallint(4) unsigned NOT NULL,
  presenterid mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Người giới thiệu',
  performerid mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Người thực hiện',
  terms text NOT NULL,
  description text NOT NULL,
  grand_total double unsigned NOT NULL DEFAULT '0',
  discount_percent tinyint(2) unsigned NOT NULL DEFAULT '0',
  discount_value double unsigned NOT NULL DEFAULT '0',
  sended smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Số lượt gửi thông tin hóa đơn',
  addtime int(11) unsigned NOT NULL,
  updatetime int(11) unsigned NOT NULL DEFAULT '0',
  useradd mediumint(8) unsigned NOT NULL,
  reminder tinyint(1) unsigned NOT NULL DEFAULT '1',
  auto_create tinyint(1) unsigned NOT NULL DEFAULT '0',
  weight smallint(4) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_detail(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  idinvoice mediumint(8) unsigned NOT NULL,
  idcustomer mediumint(8) unsigned NOT NULL,
  module varchar(50) NOT NULL,
  itemid mediumint(8) NOT NULL,
  unit_price double NOT NULL DEFAULT '0',
  quantity int(11) unsigned NOT NULL COMMENT 'Số lượng',
  price double unsigned NOT NULL,
  vat smallint(4) unsigned NOT NULL DEFAULT '0',
  total double unsigned NOT NULL,
  note text NOT NULL,
  weight mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY idinvoice (idinvoice,idcustomer,module,itemid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_transaction(
  id int(11) NOT NULL AUTO_INCREMENT,
  invoiceid mediumint(8) unsigned NOT NULL,
  transaction_time int(11) unsigned NOT NULL,
  transaction_status int(11) NOT NULL,
  payment varchar(100) NOT NULL DEFAULT '',
  payment_amount double NOT NULL DEFAULT '0',
  payment_data text NOT NULL,
  note TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent(
  action varchar(100) NOT NULL,
  econtent text NOT NULL,
  PRIMARY KEY (action)
) ENGINE=MyISAM";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent (action, econtent) VALUES('newinvoice', '<div style=\"line-height: 27px\">Kính gửi <strong>&#91;FULLNAME&#93;!</strong><br /> Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của <strong>TDFOSS.,LTD</strong> trong thời gian qua.<br /> <br /> Hôm nay, chúng tôi gửi email này để thông báo về việc khởi tạo hóa đơn&nbsp;mới cho các dịch vụ của chúng tôi mà bạn đang (hoặc bắt đầu) sử dụng. Bạn cần thanh toán (theo thông tin chi tiết bên duới) để không làm dán đoạn dịch vụ.<br /> <br /> <strong>THÔNG TIN HÓA ĐƠN</strong> <ul> <li><strong>Mã:</strong> #&#91;CODE&#93;</li> <li><strong>Ngày tạo:</strong> &#91;CREATETIME&#93;</li> <li><strong>Ngày hết hạn thanh toán:</strong> &#91;DUETIME&#93;</li> <li><strong>Trạng thái thanh toán:</strong> &#91;STATUS&#93;</li> </ul> <strong>CHI TIẾT HÓA ĐƠN</strong><br /> &#91;TABLE&#93;<br /> <br /> <strong>HƯỚNG DẪN THANH TOÁN</strong> <ul> <li>Vui lòng xem tại&nbsp;<a href=\"https://tdfoss.vn/huong-dan-thanh-toan.html\">https://tdfoss.vn/huong-dan-thanh-toan.html</a></li> <li>Nội dung thanh toán (nếu có) ghi rõ <strong>Thanh toan hoa don #&#91;CODE&#93;</strong></li> </ul> <br /> Xin chân thành cảm ơn!</div>')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent (action, econtent) VALUES('newconfirm', '')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_econtent (action, econtent) VALUES('contentpdf', '')";

$data = array();
$data['groups_manage'] = 1;
$data['groups_admin'] = 1;
$data['default_status'] = '0,1,2,3,4';

foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}