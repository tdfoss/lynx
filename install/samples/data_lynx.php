<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2019 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 05 May 2019 01:38:25 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$sample_base_siteurl = '/';
$sql_create_table = array();


$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_banners_plans`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_banners_plans` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `blang` char(2) DEFAULT '',
  `title` varchar(250) NOT NULL,
  `description` text,
  `form` varchar(100) NOT NULL,
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `act` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `require_image` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `uploadtype` varchar(255) NOT NULL DEFAULT '',
  `uploadgroup` varchar(255) NOT NULL DEFAULT '',
  `exp_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM  AUTO_INCREMENT=4  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_banners_plans` (`id`, `blang`, `title`, `description`, `form`, `width`, `height`, `act`, `require_image`, `uploadtype`, `uploadgroup`, `exp_time`) VALUES (1, '', 'Quang cao giua trang', '', 'sequential', 575, 72, 1, 1, 'images,flash', '', 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_banners_plans` (`id`, `blang`, `title`, `description`, `form`, `width`, `height`, `act`, `require_image`, `uploadtype`, `uploadgroup`, `exp_time`) VALUES (2, '', 'Quang cao trai', '', 'sequential', 212, 800, 1, 1, 'images,flash', '', 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_banners_plans` (`id`, `blang`, `title`, `description`, `form`, `width`, `height`, `act`, `require_image`, `uploadtype`, `uploadgroup`, `exp_time`) VALUES (3, '', 'Quang cao Phai', '', 'random', 250, 500, 1, 1, 'images,flash', '', 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_banners_rows`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_banners_rows` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `clid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `file_name` varchar(255) NOT NULL,
  `file_ext` varchar(100) NOT NULL,
  `file_mime` varchar(100) NOT NULL,
  `width` int(4) unsigned NOT NULL DEFAULT '0',
  `height` int(4) unsigned NOT NULL DEFAULT '0',
  `file_alt` varchar(255) DEFAULT '',
  `imageforswf` varchar(255) DEFAULT '',
  `click_url` varchar(255) DEFAULT '',
  `target` varchar(10) NOT NULL DEFAULT '_blank',
  `bannerhtml` mediumtext NOT NULL,
  `add_time` int(11) unsigned NOT NULL DEFAULT '0',
  `publ_time` int(11) unsigned NOT NULL DEFAULT '0',
  `exp_time` int(11) unsigned NOT NULL DEFAULT '0',
  `hits_total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `act` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `clid` (`clid`)
) ENGINE=MyISAM  AUTO_INCREMENT=4  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_banners_rows` (`id`, `title`, `pid`, `clid`, `file_name`, `file_ext`, `file_mime`, `width`, `height`, `file_alt`, `imageforswf`, `click_url`, `target`, `bannerhtml`, `add_time`, `publ_time`, `exp_time`, `hits_total`, `act`, `weight`) VALUES (2, 'vinades', 2, 1, 'vinades.jpg', 'jpg', 'image/jpeg', 212, 400, '', '', 'http://vinades.vn', '_blank', '', 1514880771, 1514880771, 0, 0, 1, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_banners_rows` (`id`, `title`, `pid`, `clid`, `file_name`, `file_ext`, `file_mime`, `width`, `height`, `file_alt`, `imageforswf`, `click_url`, `target`, `bannerhtml`, `add_time`, `publ_time`, `exp_time`, `hits_total`, `act`, `weight`) VALUES (3, 'Quang cao giua trang', 1, 1, 'webnhanh.jpg', 'png', 'image/jpeg', 575, 72, '', '', 'http://webnhanh.vn', '_blank', '', 1514880771, 1514880771, 0, 0, 1, 1)";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'closed_site', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'admin_theme', 'admin_adminlte')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'date_pattern', 'l, d/m/Y')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'time_pattern', 'H:i')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'online_upd', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'statistic', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'site_phone', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'mailer_mode', 'smtp')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'smtp_host', 'smtp.gmail.com')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'smtp_ssl', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'smtp_port', '465')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'verify_peer_ssl', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'verify_peer_name_ssl', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'smtp_username', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'smtp_password', 'DNTYt9EgF_nEo81I1mz7zw,,')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'googleAnalyticsID', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'googleAnalyticsSetDomainName', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'googleAnalyticsMethod', 'classic')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'googleMapsAPI', 'AIzaSyC8ODAzZ75hsAufVBSffnwvKfTOT6TnnNQ')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'searchEngineUniqueID', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'metaTagsOgp', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'pageTitleMode', 'pagetitle')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'description_length', '170')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_unickmin', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_unickmax', '20')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_upassmin', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_upassmax', '32')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'dir_forum', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_unick_type', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'nv_upass_type', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowmailchange', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowuserpublic', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowquestion', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowloginchange', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowuserlogin', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowuserloginmulti', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'allowuserreg', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'is_user_forum', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'openid_servers', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'openid_processing', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'user_check_pass_time', '1800')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'auto_login_after_reg', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'whoviewuser', '2')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'ssl_https', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'facebook_client_id', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'facebook_client_secret', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'google_client_id', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'google_client_secret', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_gfx_num', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'notification_active', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'notification_autodel', '15')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'site_keywords', 'NukeViet, portal, mysql, php')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'block_admin_ip', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'admfirewall', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'dump_autobackup', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'dump_backup_ext', 'gz')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'dump_backup_day', '30')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'gfx_chk', '3')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'file_allowed_ext', 'adobe,archives,audio,documents,flash,images,real,video')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'forbid_extensions', 'php,php3,php4,php5,phtml,inc')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'forbid_mimes', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'nv_max_size', '268435456')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'upload_checking_mode', 'lite')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'upload_alt_require', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'upload_auto_alt', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'upload_chunk_size', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'useactivate', '2')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'allow_sitelangs', 'vi')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'read_type', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'rewrite_enable', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'rewrite_optional', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'rewrite_endurl', '/')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'rewrite_exturl', '.html')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'rewrite_op_mod', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'autocheckupdate', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'autoupdatetime', '24')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'gzip_method', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'authors_detail_main', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'spadmin_add_admin', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'timestamp', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'captcha_type', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'version', '4.3.05')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'cookie_httponly', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'admin_check_pass_time', '1800')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'cookie_secure', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'is_flood_blocker', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'max_requests_60', '40')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'max_requests_300', '150')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'is_login_blocker', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'login_number_tracking', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'login_time_tracking', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'login_time_ban', '30')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'nv_display_errors_list', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'display_errors_list', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'nv_auto_resize', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'dump_interval', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'cdn_url', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'two_step_verification', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'recaptcha_sitekey', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'recaptcha_secretkey', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'recaptcha_type', 'image')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_gfx_width', '150')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_gfx_height', '40')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_max_width', '1500')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_max_height', '1500')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_live_cookie_time', '31104000')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_live_session_time', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_anti_iframe', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_anti_agent', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_allowed_html_tags', 'embed, object, param, a, b, blockquote, br, caption, col, colgroup, div, em, h1, h2, h3, h4, h5, h6, hr, i, img, li, p, span, strong, s, sub, sup, table, tbody, td, th, tr, u, ul, ol, iframe, figure, figcaption, video, audio, source, track, code, pre')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'define', 'nv_debug', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_domain', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_logo', 'uploads/logo_200_86.png')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_banner', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_favicon', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_description', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_keywords', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'theme_type', 'r,d')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_theme', 'dashboard')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'preview_theme', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'mobile_theme', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'site_home_module', 'home')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'switch_mobi_des', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'upload_logo', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'upload_logo_pos', 'bottomRight')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'autologosize1', '50')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'autologosize2', '40')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'autologosize3', '30')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'autologomod', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'name_show', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'cronjobs_next_time', '1557020577')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'global', 'disable_site_content', 'Vì lý do kỹ thuật website tạm ngưng hoạt động. Thành thật xin lỗi các bạn vì sự bất tiện này!')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'seotools', 'prcservice', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'auto_postcomm', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'allowed_comm', '-1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'view_comm', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'setcomm', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'activecomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'emailcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'adminscomm', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'sortcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'captcha', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'perpagecomm', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'timeoutcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'allowattachcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'page', 'alloweditorcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'statistics_timezone', 'Asia/Bangkok')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'site', 'site_email', 'contact@tdfoss.vn')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'error_set_logs', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'error_send_email', 'admin@nukeviet.vn')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'site_lang', 'vi')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'my_domains', 'site-lynx.vn')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'site_timezone', 'byCountry')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'proxy_blocker', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'str_referer_blocker', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'lang_geo', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_server', 'localhost')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_port', '21')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_user_name', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_user_pass', 'DNTYt9EgF_nEo81I1mz7zw,,')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_path', '/')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('sys', 'global', 'ftp_check_login', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'money', 'workgroup', '10,16')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'themes', 'simple', 'a:1:{s:12:\"theme_layout\";i:1;}')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'notification', 'onesignal_appid', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workreport', 'work_groups', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workreport', 'admin_groups', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'auto_postcomm', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'allowed_comm', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'view_comm', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'setcomm', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'activecomm', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'emailcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'adminscomm', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'sortcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'captcha', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'perpagecomm', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'timeoutcomm', '360')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'allowattachcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'alloweditorcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'groups_manage', '1,3')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'customer', 'groups_admin', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'customer', 'groups_manage', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'groups_manage', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'groups_admin', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'default_status', '0,3')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workforce', 'groups_admin', '1,2')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'groups_use', 'groups_use', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workforce', 'groups_use', '1,2')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workreport', 'allow_time', '1440')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workreport', 'allow_days', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'projects', 'default_status', '1,2,3')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workforce', 'workdays', '24')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workforce', 'insurrance', '10.5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workforce', 'overtime', '150')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'notification', 'slack_tocken', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'workreport', 'type_content', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'money', 'groupmanager', '10,16')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'auto_postcomm', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'allowed_comm', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'view_comm', '6')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'setcomm', '4')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'activecomm', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'emailcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'adminscomm', '')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'sortcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'captcha', '1')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'perpagecomm', '5')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'timeoutcomm', '360')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'allowattachcomm', '0')";
$sql_create_table[] = "REPLACE INTO `" . $db_config['prefix'] . "_config` (`lang`, `module`, `config_name`, `config_value`) VALUES ('vi', 'invoice', 'alloweditorcomm', '0')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_cronjobs`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_cronjobs` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `inter_val` int(11) unsigned NOT NULL DEFAULT '0',
  `inter_val_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0: Lặp lại sau thời điểm bắt đầu thực tế, 1:lặp lại sau thời điểm bắt đầu trong CSDL',
  `run_file` varchar(255) NOT NULL,
  `run_func` varchar(255) NOT NULL,
  `params` varchar(255) DEFAULT NULL,
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `act` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_time` int(11) unsigned NOT NULL DEFAULT '0',
  `last_result` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vi_cron_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `is_sys` (`is_sys`)
) ENGINE=MyISAM  AUTO_INCREMENT=14  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (1, 1514880771, 5, 0, 'online_expired_del.php', 'cron_online_expired_del', '', 0, 1, 1, 1557020277, 1, 'Xóa các dòng ghi trạng thái online đã cũ trong CSDL')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (2, 1514880771, 1440, 0, 'dump_autobackup.php', 'cron_dump_autobackup', '', 0, 1, 1, 1556975995, 1, 'Tự động lưu CSDL')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (3, 1514880771, 60, 0, 'temp_download_destroy.php', 'cron_auto_del_temp_download', '', 0, 1, 1, 1557018552, 1, 'Xóa các file tạm trong thư mục tmp')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (4, 1514880771, 30, 0, 'ip_logs_destroy.php', 'cron_del_ip_logs', '', 0, 1, 1, 1557018552, 1, 'Xóa IP log files, Xóa các file nhật ký truy cập')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (5, 1514880771, 1440, 0, 'error_log_destroy.php', 'cron_auto_del_error_log', '', 0, 1, 1, 1556975995, 1, 'Xóa các file error_log quá hạn')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (6, 1514880771, 360, 0, 'error_log_sendmail.php', 'cron_auto_sendmail_error_log', '', 0, 1, 0, 0, 0, 'Gửi email các thông báo lỗi cho admin')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (7, 1514880771, 60, 0, 'ref_expired_del.php', 'cron_ref_expired_del', '', 0, 1, 1, 1557018552, 1, 'Xóa các referer quá hạn')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (8, 1514880771, 60, 0, 'check_version.php', 'cron_auto_check_version', '', 0, 1, 1, 1557018552, 1, 'Kiểm tra phiên bản NukeViet')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (9, 1514880771, 1440, 0, 'notification_autodel.php', 'cron_notification_autodel', '', 0, 1, 1, 1556975995, 1, 'Xóa thông báo cũ')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_cronjobs` (`id`, `start_time`, `inter_val`, `inter_val_type`, `run_file`, `run_func`, `params`, `del`, `is_sys`, `act`, `last_time`, `last_result`, `vi_cron_name`) VALUES (13, 1547522880, 1, 0, 'workforce_birthday_reminder.php', 'cron_workforce_birthday_reminder', '', 0, 0, 0, 1550140559, 1, 'Nhắc nhở sinh nhật nhân viên')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_extension_files`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_extension_files` (
  `idfile` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL DEFAULT 'other',
  `title` varchar(55) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `lastmodified` int(11) unsigned NOT NULL DEFAULT '0',
  `duplicate` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idfile`)
) ENGINE=MyISAM  AUTO_INCREMENT=159  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (1, 'module', 'home', 'modules/home/funcs/.htaccess', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (2, 'module', 'home', 'modules/home/funcs/index.html', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (3, 'module', 'home', 'modules/home/funcs/main.php', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (4, 'module', 'home', 'modules/home/functions.php', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (5, 'module', 'home', 'modules/home/index.html', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (6, 'module', 'home', 'modules/home/version.php', 1517879613, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (7, 'module', 'workreport', 'modules/workreport/theme.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (8, 'module', 'workreport', 'modules/workreport/admin.menu.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (9, 'module', 'workreport', 'modules/workreport/funcs/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (10, 'module', 'workreport', 'modules/workreport/funcs/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (11, 'module', 'workreport', 'modules/workreport/funcs/main.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (12, 'module', 'workreport', 'modules/workreport/admin.functions.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (13, 'module', 'workreport', 'modules/workreport/functions.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (14, 'module', 'workreport', 'modules/workreport/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (15, 'module', 'workreport', 'modules/workreport/admin/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (16, 'module', 'workreport', 'modules/workreport/admin/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (17, 'module', 'workreport', 'modules/workreport/admin/config.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (18, 'module', 'workreport', 'modules/workreport/admin/main.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (19, 'module', 'workreport', 'modules/workreport/version.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (20, 'module', 'workreport', 'modules/workreport/siteinfo.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (21, 'module', 'workreport', 'modules/workreport/action_mysql.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (22, 'module', 'workreport', 'modules/workreport/language/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (23, 'module', 'workreport', 'modules/workreport/language/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (24, 'module', 'workreport', 'modules/workreport/language/admin_vi.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (25, 'module', 'workreport', 'modules/workreport/language/vi.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (26, 'module', 'workreport', 'modules/workreport/language/admin_en.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (27, 'module', 'workreport', 'modules/workreport/language/en.php', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (28, 'module', 'workreport', 'modules/workreport/blocks/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (29, 'module', 'workreport', 'modules/workreport/blocks/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (30, 'module', 'workreport', 'themes/default/modules/workreport/main.tpl', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (31, 'module', 'workreport', 'themes/default/modules/workreport/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (32, 'module', 'workreport', 'themes/default/modules/workreport/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (33, 'module', 'workreport', 'themes/default/css/workreport.css', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (34, 'module', 'workreport', 'themes/default/js/workreport.js', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (35, 'module', 'workreport', 'themes/default/images/workreport/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (36, 'module', 'workreport', 'themes/admin_default/css/workreport.css', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (37, 'module', 'workreport', 'themes/admin_default/js/workreport.js', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (38, 'module', 'workreport', 'themes/admin_default/images/workreport/index.html', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (39, 'module', 'workreport', 'themes/admin_default/modules/workreport/main.tpl', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (40, 'module', 'workreport', 'themes/admin_default/modules/workreport/config.tpl', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (41, 'module', 'workreport', 'themes/admin_default/modules/workreport/.htaccess', 1521274440, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_extension_files` (`idfile`, `type`, `title`, `path`, `lastmodified`, `duplicate`) VALUES (42, 'module', 'workreport', 'themes/admin_default/modules/workreport/index.html', 1521274440, 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_ips`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_ips` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(32) DEFAULT NULL,
  `mask` tinyint(4) NOT NULL DEFAULT '0',
  `area` tinyint(3) NOT NULL,
  `begintime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `notice` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` USING BTREE (`ip`,`type`)
) ENGINE=MyISAM  AUTO_INCREMENT=2  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_ips` (`id`, `type`, `ip`, `mask`, `area`, `begintime`, `endtime`, `notice`) VALUES (1, 1, '127.0.0.1', 0, 1, 1551413478, 0, '')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_language`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_language` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `idfile` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `langtype` varchar(50) NOT NULL DEFAULT 'lang_module',
  `lang_key` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filelang` USING BTREE (`idfile`,`lang_key`,`langtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_language_file`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_language_file` (
  `idfile` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `admin_file` varchar(200) NOT NULL DEFAULT '0',
  `langtype` varchar(50) NOT NULL DEFAULT 'lang_module',
  PRIMARY KEY (`idfile`),
  UNIQUE KEY `module` (`module`,`admin_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_plugin`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_plugin` (
  `pid` tinyint(4) NOT NULL AUTO_INCREMENT,
  `plugin_file` varchar(50) NOT NULL,
  `plugin_area` tinyint(4) NOT NULL,
  `weight` tinyint(4) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `plugin_file` (`plugin_file`)
) ENGINE=MyISAM  AUTO_INCREMENT=13  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_plugin` (`pid`, `plugin_file`, `plugin_area`, `weight`) VALUES (1, 'qrcode.php', 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_plugin` (`pid`, `plugin_file`, `plugin_area`, `weight`) VALUES (2, 'cdn_js_css_image.php', 3, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_plugin` (`pid`, `plugin_file`, `plugin_area`, `weight`) VALUES (12, 'crm_check.php', 2, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_plugin` (`pid`, `plugin_file`, `plugin_area`, `weight`) VALUES (10, 'crm_check_login.php', 3, 2)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_setup_extensions`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_setup_extensions` (
  `id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT 'other',
  `title` varchar(55) NOT NULL,
  `is_sys` tinyint(1) NOT NULL DEFAULT '0',
  `is_virtual` tinyint(1) NOT NULL DEFAULT '0',
  `basename` varchar(50) NOT NULL DEFAULT '',
  `table_prefix` varchar(55) NOT NULL DEFAULT '',
  `version` varchar(50) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `author` text NOT NULL,
  `note` varchar(255) DEFAULT '',
  UNIQUE KEY `title` (`type`,`title`),
  KEY `id` (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'theme', 'simple', 0, 0, 'simple', 'simple', '4.0.0 1515233523', 1515233523, 'hongoctrien', 'Theme for NukeViet 4')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (19, 'module', 'banners', 1, 0, 'banners', 'banners', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (284, 'module', 'seek', 1, 0, 'seek', 'seek', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (24, 'module', 'users', 1, 1, 'users', 'users', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (29, 'module', 'menu', 0, 0, 'menu', 'menu', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (283, 'module', 'feeds', 1, 0, 'feeds', 'feeds', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (282, 'module', 'page', 1, 1, 'page', 'page', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (281, 'module', 'comment', 1, 0, 'comment', 'comment', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (327, 'module', 'two-step-verification', 1, 0, 'two-step-verification', 'two_step_verification', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (307, 'theme', 'default', 0, 0, 'default', 'default', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (311, 'theme', 'mobile_default', 0, 0, 'mobile_default', 'mobile_default', '4.3.05 1552640400', 1514880771, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'projects', 0, 0, 'projects', 'projects', '1.0.00 1515748446', 1515750959, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'services', 0, 0, 'services', 'services', '1.0.00 1516075899', 1516096778, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'notification', 0, 1, 'notification', 'notification', '4.0.11 1430878940', 1517809309, 'VINADES (contact@vinades.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (137, 'module', 'home', 0, 0, 'home', 'home', '3.4.01 1517879613', 1517879613, 'hoaquynhtim99 (phantandung92@gmail.com)', 'Module dùng làm trang chủ cho những website sử dụng block để làm homepage.')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'email', 0, 0, 'email', 'email', '1.0.01 1517972690', 1518147698, 'Le Hong Quang (quanglh268@tdfoss.com)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'invoice', 0, 0, 'invoice', 'invoice', '1.0.00 1519616917', 1519719766, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'products', 0, 0, 'products', 'products', '1.0.00 1519710750', 1519719766, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'workreport', 0, 1, 'workreport', 'workreport', '1.0.00 1521274440', 1521274440, 'mynukeviet (contact@mynukeviet.com)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'customer', 1, 0, 'customer', 'customer', '1.0.00 1525523219', 1525527261, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'workforce', 1, 0, 'workforce', 'workforce', '1.0.00 1525563940', 1525568595, 'TDFOSS.,LTD (contact@tdfoss.vn)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'api', 0, 0, 'api', 'api', '1.0.00 1523071996', 1526207356, 'mynukeviet (contact@mynukeviet.com)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'theme', 'dashboard', 0, 0, 'dashboard', 'dashboard', '4.3.05 1555329366', 1555329366, 'TDFOSS.,LTD', 'CÔNG TY TNHH PHÁT TRIỂN VÀ DỊCH VỤ NGUỒN MỞ THUẬN ĐỨC. (THUAN DUC OPEN SOURCE DEVELOPMENT AND SERVICES COMPANY LIMITED - TDFOSS.,LTD).')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'contact', 0, 1, 'contact', 'contact', '4.3.04 1542337192', 1555580665, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'freecontent', 0, 0, 'freecontent', 'freecontent', '4.3.04 1542337192', 1555580665, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'news', 0, 1, 'news', 'news', '4.3.04 1542337192', 1555580665, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'statistics', 0, 0, 'statistics', 'statistics', '4.3.04 1542337192', 1555580665, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'voting', 0, 0, 'voting', 'voting', '4.3.04 1542337192', 1555580665, 'VINADES <contact@vinades.vn>', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'money', 0, 1, 'money', 'money', '1.0.00 1510838877', 1555580846, 'mynukeviet (contact@mynukeviet.com)', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_extensions` (`id`, `type`, `title`, `is_sys`, `is_virtual`, `basename`, `table_prefix`, `version`, `addtime`, `author`, `note`) VALUES (0, 'module', 'calendar', 1, 0, 'calendar', 'calendar', '1.0.00 1556793708', 1556793858, 'mynukeviet (contact@mynukeviet.com)', '')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_setup_language`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_setup_language` (
  `lang` char(2) NOT NULL,
  `setup` tinyint(1) NOT NULL DEFAULT '0',
  `weight` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_setup_language` (`lang`, `setup`, `weight`) VALUES ('vi', 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users` (`userid`, `group_id`, `username`, `md5username`, `password`, `email`, `first_name`, `last_name`, `gender`, `photo`, `birthday`, `sig`, `regdate`, `question`, `answer`, `passlostkey`, `view_mail`, `remember`, `in_groups`, `active`, `active2step`, `secretkey`, `checknum`, `last_login`, `last_ip`, `last_agent`, `last_openid`, `idsite`, `safemode`, `safekey`, `email_verification_time`) VALUES (2, 4, 'admin02', '6e60a28384bc05fa5b33cc579d040c56', '{SSHA512}AV7m+5XNlJ3yFdaX7ZEjjf1+whlKfoxdBc1ZXH5/IpKJPprM4xS/6y5tlIyOTWJwBaIgSaHdsIc5NkyrBptIYGRmM2E=', 'phonghai88@gmail.com', 'Đặng', 'Phong', '1', '', 0, NULL, 1556156007, '', '', '', 0, 1, '1,2', 1, 0, '', '', 0, '', '', '', 0, 0, '', 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users` (`userid`, `group_id`, `username`, `md5username`, `password`, `email`, `first_name`, `last_name`, `gender`, `photo`, `birthday`, `sig`, `regdate`, `question`, `answer`, `passlostkey`, `view_mail`, `remember`, `in_groups`, `active`, `active2step`, `secretkey`, `checknum`, `last_login`, `last_ip`, `last_agent`, `last_openid`, `idsite`, `safemode`, `safekey`, `email_verification_time`) VALUES (3, 4, 'admin03', '7dc2466ad3ff5911f6a5e47e043e0abc', '{SSHA512}KOVM0oaq0dUG9Lg7prnZXhQ0wFQLod26Kv0n71SlzMwCjsa6ovXqznbfyjHQsrA+BA0iTr4Xmv3hTvIVsu5b8DRhNzA=', 'leloc09@gmail.com', 'Lê', 'Lộc', '1', '', 0, NULL, 1556156131, '', '', '', 0, 1, '1,2', 1, 0, '', '', 0, '', '', '', 0, 0, '', 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_backupcodes`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_backupcodes` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `is_used` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time_used` int(11) unsigned NOT NULL DEFAULT '0',
  `time_creat` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `userid` (`userid`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_config`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_config` (
  `config` varchar(100) NOT NULL,
  `content` text,
  `edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('access_admin', 'a:6:{s:12:\"access_addus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:14:\"access_waiting\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:13:\"access_editus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:12:\"access_delus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:13:\"access_passus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:13:\"access_groups\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}}', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('password_simple', '000000|1234|2000|12345|111111|123123|123456|654321|696969|1234567|1234569|11223344|12345678|12345679|23456789|66666666|66668888|68686868|87654321|88888888|99999999|123456789|999999999|1234567890|aaaaaa|abc123|abc123@|abc@123|admin123|admin123@|admin@123|adobe1|adobe123|azerty|baseball|dragon|football|harley|hoilamgi|iloveyou|jennifer|jordan|khongbiet|khongco|khongcopass|letmein|macromedia|master|michael|monkey|mustang|nuke123|nuke123@|nuke@123|password|photoshop|pussy|qwerty|shadow|superman', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('deny_email', 'yoursite.com|mysite.com|localhost|xxx', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('deny_name', 'anonimo|anonymous|god|linux|nobody|operator|root', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('avatar_width', '80', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('avatar_height', '80', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('active_group_newusers', '0', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('active_user_logs', '1', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('min_old_user', '16', 1526601221)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('register_active_time', '86400', 1514880771)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('siteterms_vi', '<p> Để trở thành thành viên, bạn phải cam kết đồng ý với các điều khoản dưới đây. Chúng tôi có thể thay đổi lại những điều khoản này vào bất cứ lúc nào và chúng tôi sẽ cố gắng thông báo đến bạn kịp thời.<br /> <br /> Bạn cam kết không gửi bất cứ bài viết có nội dung lừa đảo, thô tục, thiếu văn hoá; vu khống, khiêu khích, đe doạ người khác; liên quan đến các vấn đề tình dục hay bất cứ nội dung nào vi phạm luật pháp của quốc gia mà bạn đang sống, luật pháp của quốc gia nơi đặt máy chủ của website này hay luật pháp quốc tế. Nếu vẫn cố tình vi phạm, ngay lập tức bạn sẽ bị cấm tham gia vào website. Địa chỉ IP của tất cả các bài viết đều được ghi nhận lại để bảo vệ các điều khoản cam kết này trong trường hợp bạn không tuân thủ.<br /> <br /> Bạn đồng ý rằng website có quyền gỡ bỏ, sửa, di chuyển hoặc khoá bất kỳ bài viết nào trong website vào bất cứ lúc nào tuỳ theo nhu cầu công việc.<br /> <br /> Đăng ký làm thành viên của chúng tôi, bạn cũng phải đồng ý rằng, bất kỳ thông tin cá nhân nào mà bạn cung cấp đều được lưu trữ trong cơ sở dữ liệu của hệ thống. Mặc dù những thông tin này sẽ không được cung cấp cho bất kỳ người thứ ba nào khác mà không được sự đồng ý của bạn, chúng tôi không chịu trách nhiệm về việc những thông tin cá nhân này của bạn bị lộ ra bên ngoài từ những kẻ phá hoại có ý đồ xấu tấn công vào cơ sở dữ liệu của hệ thống.</p>', 1274757129)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_config` (`config`, `content`, `edit_time`) VALUES ('active_editinfo_censor', '0', 1555328614)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_edit`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_edit` (
  `userid` mediumint(8) unsigned NOT NULL,
  `lastedit` int(11) unsigned NOT NULL DEFAULT '0',
  `info_basic` text NOT NULL,
  `info_custom` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_field`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_field` (
  `fid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `field` varchar(25) NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `field_type` enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
  `field_choices` text NOT NULL,
  `sql_choices` text NOT NULL,
  `match_type` enum('none','alphanumeric','email','url','regex','callback') NOT NULL DEFAULT 'none',
  `match_regex` varchar(250) NOT NULL DEFAULT '',
  `func_callback` varchar(75) NOT NULL DEFAULT '',
  `min_length` int(11) NOT NULL DEFAULT '0',
  `max_length` bigint(20) unsigned NOT NULL DEFAULT '0',
  `required` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_register` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_editable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_profile` tinyint(4) NOT NULL DEFAULT '1',
  `class` varchar(50) NOT NULL,
  `language` text NOT NULL,
  `default_value` varchar(255) NOT NULL DEFAULT '',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `field` (`field`)
) ENGINE=MyISAM  AUTO_INCREMENT=10  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (1, 'first_name', 1, 'textbox', '', '', 'none', '', '', 0, 100, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:4:\"Tên\";i:1;s:0:\"\";}}', '', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (2, 'last_name', 2, 'textbox', '', '', 'none', '', '', 0, 100, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:20:\"Họ và tên đệm\";i:1;s:0:\"\";}}', '', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (3, 'gender', 3, 'select', 'a:3:{s:1:\"N\";s:3:\"N/A\";s:1:\"M\";s:3:\"Nam\";s:1:\"F\";s:4:\"Nữ\";}', '', 'none', '', '', 0, 255, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:12:\"Giới tính\";i:1;s:0:\"\";}}', '2', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (4, 'birthday', 4, 'date', 'a:1:{s:12:\"current_date\";i:0;}', '', 'none', '', '', 0, 0, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:22:\"Ngày tháng năm sinh\";i:1;s:0:\"\";}}', '0', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (5, 'sig', 5, 'textarea', '', '', 'none', '', '', 0, 1000, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:9:\"Chữ ký\";i:1;s:0:\"\";}}', '', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (6, 'question', 6, 'textbox', '', '', 'none', '', '', 3, 255, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:22:\"Câu hỏi bảo mật\";i:1;s:0:\"\";}}', '', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (7, 'answer', 7, 'textbox', '', '', 'none', '', '', 3, 255, 0, 0, 1, 1, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:22:\"Trả lời câu hỏi\";i:1;s:0:\"\";}}', '', 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (8, 'slack_id', 9, 'textbox', '', '', 'none', '', '', 0, 255, 0, 0, 1, 0, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:8:\"Slack ID\";i:1;s:0:\"\";}}', '', 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_field` (`fid`, `field`, `weight`, `field_type`, `field_choices`, `sql_choices`, `match_type`, `match_regex`, `func_callback`, `min_length`, `max_length`, `required`, `show_register`, `user_editable`, `show_profile`, `class`, `language`, `default_value`, `system`) VALUES (9, 'notify_type', 8, 'checkbox', 'a:2:{s:4:\"push\";s:18:\"Thông báo đẩy\";s:5:\"slack\";s:5:\"Slack\";}', '', 'none', '', '', 0, 255, 0, 0, 1, 0, 'input', 'a:1:{s:2:\"vi\";a:2:{i:0;s:24:\"Kênh nhận thông báo\";i:1;s:0:\"\";}}', '1', 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_groups`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_groups` (
  `group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(240) NOT NULL,
  `email` varchar(100) DEFAULT '',
  `description` text,
  `content` text,
  `group_type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0:Sys, 1:approval, 2:public',
  `group_color` varchar(10) NOT NULL,
  `group_avatar` varchar(255) NOT NULL,
  `require_2step_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `require_2step_site` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL,
  `exp_time` int(11) NOT NULL,
  `weight` int(11) unsigned NOT NULL DEFAULT '0',
  `act` tinyint(1) unsigned NOT NULL,
  `idsite` int(11) unsigned NOT NULL DEFAULT '0',
  `numbers` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `siteus` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `config` varchar(250) DEFAULT '',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `ktitle` (`title`,`idsite`),
  KEY `exp_time` (`exp_time`)
) ENGINE=MyISAM  AUTO_INCREMENT=17  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (1, 'Super admin', '', 'Super Admin', '', 0, '', '', 0, 0, 0, 1514880771, 0, 1, 1, 0, 4, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (2, 'General admin', '', 'General Admin', '', 0, '', '', 0, 0, 0, 1514880771, 0, 2, 1, 0, 3, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (3, 'Module admin', '', 'Module Admin', '', 0, '', '', 0, 0, 0, 1514880771, 0, 3, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (4, 'Users', '', 'Users', '', 0, '', '', 0, 0, 0, 1514880771, 0, 4, 1, 0, 12, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (7, 'New Users', '', 'New Users', '', 0, '', '', 0, 0, 0, 1514880771, 0, 5, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (5, 'Guest', '', 'Guest', '', 0, '', '', 0, 0, 0, 1514880771, 0, 6, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (6, 'All', '', 'All', '', 0, '', '', 0, 0, 0, 1514880771, 0, 7, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (10, 'Ban điều hành', '', 'Ban điều hành', '', 2, '', '', 0, 0, 1, 1514880771, 0, 9, 1, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (11, 'Phòng kinh doanh', '', 'Phòng kinh doanh', '', 2, '', '', 0, 0, 0, 1514880771, 0, 10, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (13, 'Phòng kỹ thuật', '', 'Phòng kỹ thuật', '', 0, '', '', 0, 0, 0, 1515849430, 0, 12, 1, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (12, 'Phòng Marketing', '', 'Phòng marketing', '', 1, '', '', 0, 0, 0, 1514880771, 0, 11, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (14, 'TDFOSS.,LTD', '', 'Nhân viên TDFOSS.,LTD', '', 0, '', '', 0, 0, 0, 1517911129, 0, 8, 1, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (15, 'Cộng tác viên', '', 'Cộng tác viên', '', 0, '', '', 0, 0, 0, 1518143270, 0, 14, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups` (`group_id`, `title`, `email`, `description`, `content`, `group_type`, `group_color`, `group_avatar`, `require_2step_admin`, `require_2step_site`, `is_default`, `add_time`, `exp_time`, `weight`, `act`, `idsite`, `numbers`, `siteus`, `config`) VALUES (16, 'Văn thư', '', 'Văn thư', '', 0, '', '', 0, 0, 0, 1518145711, 0, 13, 1, 0, 0, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_groups_users`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_groups_users` (
  `group_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `approved` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`group_id`,`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (1, 1, 1, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (10, 1, 1, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (14, 1, 0, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (13, 1, 1, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (1, 2, 0, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (2, 2, 0, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (1, 3, 0, 1, '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_groups_users` (`group_id`, `userid`, `is_leader`, `approved`, `data`) VALUES (2, 3, 0, 1, '0')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_info`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_info` (
  `userid` mediumint(8) unsigned NOT NULL,
  `slack_id` varchar(255) NOT NULL DEFAULT '',
  `notify_type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_info` (`userid`, `slack_id`, `notify_type`) VALUES (1, '', 'push')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_openid`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_openid` (
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `opid` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`opid`),
  KEY `userid` (`userid`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_question`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_question` (
  `qid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(240) NOT NULL DEFAULT '',
  `lang` char(2) NOT NULL DEFAULT '',
  `weight` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0',
  `edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`),
  UNIQUE KEY `title` (`title`,`lang`)
) ENGINE=MyISAM  AUTO_INCREMENT=8  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (1, 'Bạn thích môn thể thao nào nhất', 'vi', 1, 1274840238, 1274840238)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (2, 'Món ăn mà bạn yêu thích', 'vi', 2, 1274840250, 1274840250)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (3, 'Thần tượng điện ảnh của bạn', 'vi', 3, 1274840257, 1274840257)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (4, 'Bạn thích nhạc sỹ nào nhất', 'vi', 4, 1274840264, 1274840264)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (5, 'Quê ngoại của bạn ở đâu', 'vi', 5, 1274840270, 1274840270)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (6, 'Tên cuốn sách &quot;gối đầu giường&quot;', 'vi', 6, 1274840278, 1274840278)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_users_question` (`qid`, `title`, `lang`, `weight`, `add_time`, `edit_time`) VALUES (7, 'Ngày lễ mà bạn luôn mong đợi', 'vi', 7, 1274840285, 1274840285)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_users_reg`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_users_reg` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `md5username` char(32) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `gender` char(1) NOT NULL DEFAULT '',
  `birthday` int(11) NOT NULL,
  `sig` text,
  `regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL DEFAULT '',
  `checknum` varchar(50) NOT NULL DEFAULT '',
  `users_info` text,
  `openid_info` text,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `login` (`username`),
  UNIQUE KEY `md5username` (`md5username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  AUTO_INCREMENT=3  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_blocks_groups`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_blocks_groups` (
  `bid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(55) NOT NULL,
  `module` varchar(55) NOT NULL,
  `file_name` varchar(55) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `template` varchar(55) DEFAULT NULL,
  `position` varchar(55) DEFAULT NULL,
  `exp_time` int(11) DEFAULT '0',
  `active` varchar(10) DEFAULT '1',
  `act` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `groups_view` varchar(255) DEFAULT '',
  `all_func` tinyint(4) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `config` text,
  PRIMARY KEY (`bid`),
  KEY `theme` (`theme`),
  KEY `module` (`module`),
  KEY `position` (`position`),
  KEY `exp_time` (`exp_time`)
) ENGINE=MyISAM  AUTO_INCREMENT=55  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (2, 'default', 'banners', 'global.banners.php', 'Quảng cáo giữa trang', '', 'no_title', '[TOP]', 0, '1', 1, '6', 0, 2, 'a:1:{s:12:\"idplanbanner\";i:1;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (4, 'default', 'theme', 'global.module_menu.php', 'Module Menu', '', 'no_title', '[LEFT]', 0, '1', 1, '6', 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (5, 'default', 'banners', 'global.banners.php', 'Quảng cáo cột trái', '', 'no_title', '[LEFT]', 0, '1', 1, '6', 1, 3, 'a:1:{s:12:\"idplanbanner\";i:2;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (8, 'default', 'banners', 'global.banners.php', 'Quảng cáo cột phải', '', 'no_title', '[RIGHT]', 0, '1', 1, '6', 1, 2, 'a:1:{s:12:\"idplanbanner\";i:3;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (11, 'default', 'theme', 'global.copyright.php', 'Copyright', '', 'no_title', '[FOOTER_SITE]', 0, '1', 1, '6', 1, 1, 'a:5:{s:12:\"copyright_by\";s:0:\"\";s:13:\"copyright_url\";s:0:\"\";s:9:\"design_by\";s:12:\"VINADES.,JSC\";s:10:\"design_url\";s:18:\"http://vinades.vn/\";s:13:\"siteterms_url\";s:39:\"/index.php?language=vi&amp;nv=siteterms\";}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (13, 'default', 'theme', 'global.QR_code.php', 'QR code', '', 'no_title', '[QR_CODE]', 0, '1', 1, '6', 1, 1, 'a:3:{s:5:\"level\";s:1:\"M\";s:15:\"pixel_per_point\";i:4;s:11:\"outer_frame\";i:1;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (15, 'default', 'users', 'global.user_button.php', 'Đăng nhập thành viên', '', 'no_title', '[PERSONALAREA]', 0, '1', 1, '6', 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (16, 'default', 'theme', 'global.company_info.php', 'Công ty chủ quản', '', 'simple', '[COMPANY_INFO]', 0, '1', 1, '6', 1, 1, 'a:17:{s:12:\"company_name\";s:58:\"Công ty cổ phần phát triển nguồn mở Việt Nam\";s:15:\"company_address\";s:72:\"Phòng 1706 - Tòa nhà CT2 Nàng Hương, 583 Nguyễn Trãi, Hà Nội\";s:16:\"company_sortname\";s:12:\"VINADES.,JSC\";s:15:\"company_regcode\";s:0:\"\";s:16:\"company_regplace\";s:0:\"\";s:21:\"company_licensenumber\";s:0:\"\";s:22:\"company_responsibility\";s:0:\"\";s:15:\"company_showmap\";i:1;s:20:\"company_mapcenterlat\";d:20.984516000000013;s:20:\"company_mapcenterlng\";d:105.795475;s:14:\"company_maplat\";d:20.984516;s:14:\"company_maplng\";d:105.79547500000001;s:15:\"company_mapzoom\";i:17;s:13:\"company_phone\";s:58:\"+84-24-85872007[+842485872007]|+84-904762534[+84904762534]\";s:11:\"company_fax\";s:15:\"+84-24-35500914\";s:13:\"company_email\";s:18:\"contact@vinades.vn\";s:15:\"company_website\";s:17:\"http://vinades.vn\";}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (17, 'default', 'menu', 'global.bootstrap.php', 'Menu Site', '', 'no_title', '[MENU_SITE]', 0, '1', 1, '6', 1, 1, 'a:2:{s:6:\"menuid\";i:1;s:12:\"title_length\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (19, 'default', 'theme', 'global.social.php', 'Social icon', '', 'no_title', '[SOCIAL_ICONS]', 0, '1', 1, '6', 1, 1, 'a:4:{s:8:\"facebook\";s:32:\"http://www.facebook.com/nukeviet\";s:11:\"google_plus\";s:32:\"https://www.google.com/+nukeviet\";s:7:\"youtube\";s:37:\"https://www.youtube.com/user/nukeviet\";s:7:\"twitter\";s:28:\"https://twitter.com/nukeviet\";}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (20, 'default', 'theme', 'global.menu_footer.php', 'Các chuyên mục chính', '', 'simple', '[MENU_FOOTER]', 0, '1', 1, '6', 1, 1, 'a:1:{s:14:\"module_in_menu\";a:8:{i:0;s:5:\"about\";i:1;s:4:\"news\";i:2;s:5:\"users\";i:3;s:7:\"contact\";i:4;s:6:\"voting\";i:5;s:7:\"banners\";i:6;s:4:\"seek\";i:7;s:5:\"feeds\";}}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (35, 'simple', 'theme', 'global.bootstrap.php', 'global top', '', 'no_title', '[TOP]', 0, '1', 1, '6', 1, 1, 'a:2:{s:6:\"menuid\";i:1;s:12:\"title_length\";i:24;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (37, 'simple', 'notification', 'global.block_notification_onesignal.php', 'global block notification push', '', 'no_title', '[TOP]', 0, '1', 1, '', 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (39, 'simple', 'theme', 'global.logs_event.php', 'Dự án', '/index.php?language=vi&nv=projects', 'default_no_padding', '[BOTTOM]', 0, '1', 1, '14', 0, 1, 'a:3:{s:6:\"numrow\";s:2:\"20\";s:6:\"height\";i:300;s:6:\"system\";i:0;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (43, 'simple', 'notification', 'global.block_notification_popup.php', 'global block notification popup', '', 'no_title', '[TOP]', 0, '1', 1, '', 1, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (44, 'dashboard', 'theme', 'global.company_info.php', 'Công ty chủ quản', '', 'simple', '[COMPANY_INFO]', 0, '1', 1, '6', 1, 1, 'a:17:{s:12:\"company_name\";s:58:\"Công ty cổ phần phát triển nguồn mở Việt Nam\";s:15:\"company_address\";s:72:\"Phòng 1706 - Tòa nhà CT2 Nàng Hương, 583 Nguyễn Trãi, Hà Nội\";s:16:\"company_sortname\";s:12:\"VINADES.,JSC\";s:15:\"company_regcode\";s:0:\"\";s:16:\"company_regplace\";s:0:\"\";s:21:\"company_licensenumber\";s:0:\"\";s:22:\"company_responsibility\";s:0:\"\";s:15:\"company_showmap\";i:1;s:20:\"company_mapcenterlat\";d:20.984516000000013;s:20:\"company_mapcenterlng\";d:105.795475;s:14:\"company_maplat\";d:20.984515999999999;s:14:\"company_maplng\";d:105.79547500000001;s:15:\"company_mapzoom\";i:17;s:13:\"company_phone\";s:58:\"+84-24-85872007[+842485872007]|+84-904762534[+84904762534]\";s:11:\"company_fax\";s:15:\"+84-24-35500914\";s:13:\"company_email\";s:18:\"contact@vinades.vn\";s:15:\"company_website\";s:17:\"http://vinades.vn\";}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (45, 'dashboard', 'theme', 'global.user_theme_button.php', 'global user theme button', '', 'no_title', '[CONTACT_DEFAULT]', 0, '1', 1, '6', 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (46, 'dashboard', 'projects', 'global.manage_projects.php', 'Dự án', '', 'simple-blue', '[HOME_LEFT]', 0, '1', 1, '6', 0, 1, 'a:4:{s:6:\"numrow\";i:5;s:10:\"characters\";i:0;s:4:\"type\";a:3:{i:0;i:0;i:1;i:1;i:2;i:2;}s:6:\"updown\";s:8:\"edittime\";}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (47, 'dashboard', 'theme', 'global.module_menu.php', 'Module Menu', '', 'no_title', '[LEFT]', 0, '1', 1, '6', 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (48, 'dashboard', 'theme', 'global.menu_footer.php', 'Các chuyên mục chính', '', 'simple', '[MENU_FOOTER]', 0, '1', 1, '6', 1, 1, 'a:1:{s:14:\"module_in_menu\";a:8:{i:0;s:5:\"about\";i:1;s:4:\"news\";i:2;s:5:\"users\";i:3;s:7:\"contact\";i:4;s:6:\"voting\";i:5;s:7:\"banners\";i:6;s:4:\"seek\";i:7;s:5:\"feeds\";}}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (49, 'dashboard', 'theme', 'global.category.php', 'Danh mục', '', 'no_title', '[MENU_SITE]', 0, '1', 1, '6', 1, 1, 'a:3:{s:6:\"menuid\";i:1;s:12:\"title_length\";i:0;s:8:\"template\";i:1;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (50, 'dashboard', 'theme', 'global.category.php', 'global category', '', 'no_title', '[MENU_SITE]', 0, '1', 1, '6', 1, 2, 'a:3:{s:6:\"menuid\";i:1;s:12:\"title_length\";i:0;s:8:\"template\";i:2;}')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (51, 'dashboard', 'notification', 'global.block_notification_popup.php', 'global block notification popup', '', 'no_title', '[NOTIFICATION]', 0, '1', 1, '6', 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (52, 'dashboard', 'users', 'global.user_button.php', 'Đăng nhập thành viên', '', 'no_title', '[PERSONALAREA]', 0, '1', 1, '6', 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (53, 'dashboard', 'notification', 'global.block_notification_onesignal.php', 'global block notification onesignal', '', 'no_title', '[PERSONALAREA]', 0, '1', 1, '6', 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_groups` (`bid`, `theme`, `module`, `file_name`, `title`, `link`, `template`, `position`, `exp_time`, `active`, `act`, `groups_view`, `all_func`, `weight`, `config`) VALUES (54, 'dashboard', 'theme', 'global.QR_code.php', 'QR code', '', 'no_title', '[QR_CODE]', 0, '1', 1, '6', 1, 1, 'a:3:{s:5:\"level\";s:1:\"M\";s:15:\"pixel_per_point\";i:4;s:11:\"outer_frame\";i:1;}')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_blocks_weight`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_blocks_weight` (
  `bid` mediumint(8) NOT NULL DEFAULT '0',
  `func_id` mediumint(8) NOT NULL DEFAULT '0',
  `weight` mediumint(8) NOT NULL DEFAULT '0',
  UNIQUE KEY `bid` (`bid`,`func_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (4, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 4, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 5, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 6, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 7, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 8, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 9, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 10, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 11, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 12, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 31, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 32, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 33, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 34, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 35, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 36, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 37, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 19, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 20, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 21, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 22, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 23, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 24, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 25, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 26, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 27, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 28, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 1, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 38, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 39, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 40, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 41, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 47, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 48, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 49, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 50, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 51, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 61, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 64, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 4, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 5, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 6, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 7, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 8, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 9, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 10, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 11, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 12, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 52, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 63, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 55, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 56, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 31, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 32, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 33, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 34, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 35, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 36, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 37, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 58, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 59, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 60, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 19, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 20, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 21, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 22, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 23, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 24, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 25, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 26, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 27, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 28, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 29, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 62, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 86, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (2, 4, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 74, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 75, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 71, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 66, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 65, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 72, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 67, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 76, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 77, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 69, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 70, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 79, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 78, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 80, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 47, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 48, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 49, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 50, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 51, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 61, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 79, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 78, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 80, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 4, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 5, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 6, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 7, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 8, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 9, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 10, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 11, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 12, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 74, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 75, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 71, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 66, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 65, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 72, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 67, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 76, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 77, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 69, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 70, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 55, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 56, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 31, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 32, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 33, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 34, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 35, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 36, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 37, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 62, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 83, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 83, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 84, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 84, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 85, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 87, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 85, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 88, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 89, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 91, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 90, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 92, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 93, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 95, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 94, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 96, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 97, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 104, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 103, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 102, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 105, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 158, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 157, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 157, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 158, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 19, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 20, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 21, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 22, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 23, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 24, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 25, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 26, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 27, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 28, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 29, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 58, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 59, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 60, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 99, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 100, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 98, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 108, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 107, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 106, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 109, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 110, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (39, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 111, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 114, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 113, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 112, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 111, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 114, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 113, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 112, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 117, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 116, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 115, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 160, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 159, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 159, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 160, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 19, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 20, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 21, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 22, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 23, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 24, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 25, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 26, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 27, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 28, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 29, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 64, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 58, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 59, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 60, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 99, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 100, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 98, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 108, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 107, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 106, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 109, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 110, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 111, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 114, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 113, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 112, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 117, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 116, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 115, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 121, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 122, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 122, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 125, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 124, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 123, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 125, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 124, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 123, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 126, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 126, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 127, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 127, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 128, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 129, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 129, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 132, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 131, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 130, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 132, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 131, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 130, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 135, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 134, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 133, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 135, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 134, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 133, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 136, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 136, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 137, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 137, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 138, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 138, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 139, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 140, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 147, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 149, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 142, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 148, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 143, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 144, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 150, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 158, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 157, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 64, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 160, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 159, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 151, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 151, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 152, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 152, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 156, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 155, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 154, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 156, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 155, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 154, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 156, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 155, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 154, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 162, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 161, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 162, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 161, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 162, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 161, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 163, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 163, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 164, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 164, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 165, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 165, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 166, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 166, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (46, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (47, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 138, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 38, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 39, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 40, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 41, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 163, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 164, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 132, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 131, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 130, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 117, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 116, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 115, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 126, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 64, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 110, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 125, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 124, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 123, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 151, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 109, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 52, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 122, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 129, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 100, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 98, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 99, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 63, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 108, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 107, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 106, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 58, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 59, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 60, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 19, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 20, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 21, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 22, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 23, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 24, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 25, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 26, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 27, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 28, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 29, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 165, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 166, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 135, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 134, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 133, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 137, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 136, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 127, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 152, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 138, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 38, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 39, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 40, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 41, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 163, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 164, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 132, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 131, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 130, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 117, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 116, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 115, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 126, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 64, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 110, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 125, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 124, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 123, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 151, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 109, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 52, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 122, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 129, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 100, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 98, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 99, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 63, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 108, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 107, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 106, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 58, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 59, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 60, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 19, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 20, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 21, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 22, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 23, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 24, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 25, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 26, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 27, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 28, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 29, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 165, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 166, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 135, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 134, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 133, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 137, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 136, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 127, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 152, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 138, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 38, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 39, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 40, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 41, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 163, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 164, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 132, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 131, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 130, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 117, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 116, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 115, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 126, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 64, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 110, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 125, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 124, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 123, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 151, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 109, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 52, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 122, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 129, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 100, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 98, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 99, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 63, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 108, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 107, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 106, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 58, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 59, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 60, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 19, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 20, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 21, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 22, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 23, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 24, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 25, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 26, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 27, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 28, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 29, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 165, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 166, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 135, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 134, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 133, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 137, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 136, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 127, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 152, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 168, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 167, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 168, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 167, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 168, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 167, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 168, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 167, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 168, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 167, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 169, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 170, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 169, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 170, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 169, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 170, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 169, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 170, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 169, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 170, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 172, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 172, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 172, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 172, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 172, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 173, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 173, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 173, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 173, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 173, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 174, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 175, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 174, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 175, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 174, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 175, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 174, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 175, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 174, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 175, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 177, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 177, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 177, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 177, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 177, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 182, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 192, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 191, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 180, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 179, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 187, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 178, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 190, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 185, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 182, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 192, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 191, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 180, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 179, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 187, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 178, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 190, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 185, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 182, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 192, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 191, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 180, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 179, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 187, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 178, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 190, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 185, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 182, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 192, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 191, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 180, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 179, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 187, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 178, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 190, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 185, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 182, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 192, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 191, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 180, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 179, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 187, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 178, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 190, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 185, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 193, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 194, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 193, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 194, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 193, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 194, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 193, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 194, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 193, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 194, 3)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (44, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (45, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (48, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (49, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (50, 196, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (51, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (52, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (53, 196, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (54, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (16, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (11, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (5, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (20, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (17, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (15, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (13, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (8, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (19, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (35, 196, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (37, 196, 2)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks_weight` (`bid`, `func_id`, `weight`) VALUES (43, 196, 3)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL COMMENT 'Tên',
  `last_name` varchar(100) NOT NULL COMMENT 'Họ và tên đệm',
  `main_phone` varchar(20) NOT NULL COMMENT 'Số điện thoại',
  `other_phone` varchar(255) NOT NULL COMMENT 'Số điện thoại khác',
  `main_email` varchar(100) NOT NULL COMMENT 'Email',
  `other_email` varchar(255) NOT NULL COMMENT 'Email khác',
  `birthday` int(11) unsigned NOT NULL DEFAULT '0',
  `facebook` varchar(255) NOT NULL,
  `skype` varchar(50) NOT NULL,
  `zalo` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Giới tính',
  `address` varchar(255) NOT NULL COMMENT 'Địa chỉ',
  `unit` varchar(255) NOT NULL COMMENT 'Đơn vị công tác',
  `care_staff` mediumint(8) unsigned NOT NULL COMMENT 'Nhân viên chăm sóc KH',
  `image` varchar(255) NOT NULL,
  `addtime` int(11) unsigned NOT NULL COMMENT 'Thời gian thêm',
  `edittime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian sửa',
  `userid_link` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Tài khoản liên kết',
  `userid` mediumint(8) unsigned NOT NULL COMMENT 'Người thêm',
  `note` text NOT NULL COMMENT 'Ghi chú',
  `is_contacts` tinyint(1) NOT NULL COMMENT 'Loại khách hàng',
  `type_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `tag_id` varchar(100) NOT NULL,
  `share_acc` varchar(100) NOT NULL COMMENT 'share với tài khoản',
  `share_groups` smallint(4) unsigned NOT NULL COMMENT 'share với group',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=19  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_share_acc`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_share_acc` (
  `userid` smallint(4) NOT NULL,
  `customerid` mediumint(8) unsigned NOT NULL,
  `permisson` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Quyền',
  UNIQUE KEY `tid` (`userid`,`customerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_tags`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_tags` (
  `tid` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Tiêu đề',
  `note` text NOT NULL COMMENT 'Ghi chú',
  `weight` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  AUTO_INCREMENT=5  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_tags_customer`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_tags_customer` (
  `tid` smallint(4) NOT NULL,
  `customerid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `tid` (`tid`,`customerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_types`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_types` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Loại khách hàng',
  `note` text NOT NULL COMMENT 'Ghi chú',
  `weight` smallint(4) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=2  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_units`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_units` (
  `tid` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Tiêu đề',
  `note` text NOT NULL COMMENT 'Ghi chú',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  AUTO_INCREMENT=5  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_customer_units_customer`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_customer_units_customer` (
  `tid` smallint(4) NOT NULL,
  `customerid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `tid` (`tid`,`customerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_email`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `useradd` mediumint(8) NOT NULL,
  `cc_id` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `files` varchar(255) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=24  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_email_sendto`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_email_sendto` (
  `email_id` int(11) unsigned NOT NULL,
  `customer_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `email_id` (`email_id`,`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_email_template`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_email_template` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `weight` smallint(4) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_invoice`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_invoice` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `customerid` mediumint(8) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `duetime` int(11) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `cycle` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `workforceid` smallint(4) unsigned NOT NULL,
  `presenterid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Người giới thiệu',
  `performerid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Người thực hiện',
  `terms` text NOT NULL,
  `description` text NOT NULL,
  `grand_total` double unsigned NOT NULL DEFAULT '0',
  `discount_percent` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `discount_value` double unsigned NOT NULL DEFAULT '0',
  `sended` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Số lượt gửi thông tin hóa đơn',
  `addtime` int(11) unsigned NOT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `useradd` mediumint(8) unsigned NOT NULL,
  `reminder` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `auto_create` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=12  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_invoice_detail`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_invoice_detail` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `idinvoice` mediumint(8) unsigned NOT NULL,
  `idcustomer` mediumint(8) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `itemid` mediumint(8) NOT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `quantity` int(11) unsigned NOT NULL COMMENT 'Số lượng',
  `price` double unsigned NOT NULL,
  `vat` smallint(4) unsigned NOT NULL DEFAULT '0',
  `total` double unsigned NOT NULL,
  `note` text NOT NULL,
  `weight` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idinvoice` (`idinvoice`,`idcustomer`,`module`,`itemid`)
) ENGINE=MyISAM  AUTO_INCREMENT=11  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_invoice_econtent`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_invoice_econtent` (
  `action` varchar(100) NOT NULL,
  `econtent` text NOT NULL,
  PRIMARY KEY (`action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_invoice_econtent` (`action`, `econtent`) VALUES ('newinvoice', '<div style=\"line-height: 27px\">Kính gửi <strong>&#91;FULLNAME&#93;!</strong><br  />
Cảm ơn quý khách đã tin tưởng sử dụng dịch vụ của <strong>TDFOSS.,LTD</strong> trong thời gian qua.<br  />
<br  />
Hôm nay, chúng tôi gửi email này để thông báo về việc khởi tạo hóa đơn&nbsp;mới cho các dịch vụ của chúng tôi mà quý khách đang (hoặc bắt đầu) sử dụng. Quý khách vui lòng thanh toán trong vòng 08 ngày kể từ ngày nhận được thông báo (theo thông tin chi tiết bên duới) để không làm dán đoạn dịch vụ. (Chúng tôi gửi lời xin lỗi đến quý khách nếu nhận được email này trong khi đã thanh toán).<br  />
<br  />
<strong>THÔNG TIN HÓA ĐƠN</strong>
<ul>
	<li><strong>Mã:</strong> #&#91;CODE&#93;</li>
	<li><strong>Ngày tạo:</strong> &#91;CREATETIME&#93;</li>
	<li><strong>Ngày hết hạn:</strong> &#91;DUETIME&#93;</li>
	<li><strong>Trạng thái thanh toán:</strong> &#91;STATUS&#93;</li>
</ul>
<strong>CHI TIẾT HÓA ĐƠN</strong><br  />
&#91;TABLE&#93;
<h3><strong>LỊCH SỬ GIAO DỊCH</strong><br  />
<br  />
&#91;TABLE_TRANSACTION&#93;<br  />
<br  />
<strong>HƯỚNG DẪN THANH TOÁN</strong></h3>

<ul>
	<li>Vui lòng xem tại&nbsp;<a href=\"https://tdfoss.vn/huong-dan-thanh-toan.html\">https://tdfoss.vn/huong-dan-thanh-toan.html</a></li>
	<li>Nội dung thanh toán (nếu có) ghi rõ Thanh toan hoa don #&#91;CODE&#93;</li>
</ul>
Mọi yêu cầu, báo lỗi về sản phẩm, dịch vụ vui lòng gửi về email <a href=\"mailto:support@tdfoss.vn\">support@tdfoss.vn</a> để được hỗ trợ.<br  />
Xin chân thành cảm ơn!</div>')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_invoice_econtent` (`action`, `econtent`) VALUES ('newconfirm', 'Kính gửi <strong>&#91;FULLNAME&#93;!</strong><br  />
<br  />
Chúng tôi xin xác nhận <strong>đã nhận được thanh toán</strong> của bạn cho hóa đơn có mã số <strong>#&#91;CODE&#93; - &#91;TITLE&#93;</strong> tại <strong>TDFOSS.,LTD</strong><br  />
<br  />
<strong>THÔNG TIN HÓA ĐƠN</strong>
<ul>
	<li><strong>Ngày tạo:</strong> &#91;CREATETIME&#93;</li>
	<li><strong>Ngày hết hạn thanh toán:</strong> &#91;DUETIME&#93;</li>
	<li><strong>Trạng thái thanh toán:</strong> &#91;STATUS&#93;</li>
</ul>
<strong>CHI TIẾT HÓA ĐƠN</strong><br  />
&#91;TABLE&#93;<br  />
<br  />
Một lần nữa xin cảm ơn!<br  />
&nbsp;')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_invoice_econtent` (`action`, `econtent`) VALUES ('contentpdf', '<table>
	<tbody>
		<tr>
			<td width=\"110\"><img alt=\"logo\" height=\"90\" src=\"/uploads/tdfoss-logo-small_256_256.png\" width=\"90\" /></td>
			<td><strong>CÔNG TY TNHH PHÁT TRIỂN VÀ DỊCH VỤ NGUỒN MỞ THUẬN ĐỨC</strong><br  />
			161 Tôn Thất Thuyết, Phường 5, TP Đông Hà, Tỉnh Quảng Trị<br  />
			<strong>Điện thoại:</strong> 02336 270 610 - 0905 908 430<br  />
			<strong>Email:</strong> contact@tdfoss.vn&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>Website:</strong> www.tdfoss.vn</td>
		</tr>
	</tbody>
</table>

<hr  />
<table>
	<tbody>
		<tr>
			<td width=\"50%\"><strong>THÔNG TIN HÓA ĐƠN</strong></td>
			<td width=\"50%\"><strong>THÔNG TIN KHÁCH HÀNG</strong></td>
		</tr>
		<tr>
			<td><strong>Mã hóa đơn: #&#91;CODE&#93;</strong><br  />
			<strong>Ngày tạo:</strong> &#91;CREATETIME&#93;<br  />
			<strong>Ngày hết hạn:</strong> &#91;DUETIME&#93;<br  />
			<strong>Trạng thái:</strong> &#91;STATUS&#93;</td>
			<td><strong>Họ tên:&nbsp;</strong>&#91;FULLNAME&#93;&nbsp;<br  />
			<strong>Điện thoại:</strong> &#91;CUSTOMER_PHONE&#93;<br  />
			<strong>Địa chỉ:</strong> &#91;CUSTOMER_ADDRESS&#93;<br  />
			&nbsp;</td>
		</tr>
	</tbody>
</table>

<h3><strong>CHI TIẾT HÓA ĐƠN</strong></h3>
&#91;TABLE&#93;

<h3><strong>LỊCH SỬ GIAO DỊCH</strong></h3>
&#91;TABLE_TRANSACTION&#93;

<h3><strong>HƯỚNG DẪN THANH TOÁN</strong></h3>

<ul>
	<li>Vui lòng xem tại&nbsp;<a href=\"https://tdfoss.vn/huong-dan-thanh-toan.html\">https://tdfoss.vn/huong-dan-thanh-toan.html</a></li>
	<li>Nội dung thanh toán (nếu có) ghi rõ <strong>Thanh toan hoa don #&#91;CODE&#93;</strong></li>
</ul>')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_invoice_transaction`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_invoice_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceid` mediumint(8) unsigned NOT NULL,
  `transaction_time` int(11) unsigned NOT NULL,
  `transaction_status` int(11) NOT NULL,
  `payment` varchar(100) NOT NULL DEFAULT '',
  `payment_amount` double NOT NULL DEFAULT '0',
  `payment_data` text NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=5  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_menu`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  AUTO_INCREMENT=3  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu` (`id`, `title`) VALUES (1, 'Menu chính')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_menu_rows`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_menu_rows` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `parentid` mediumint(5) unsigned NOT NULL,
  `mid` smallint(5) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `icon` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `note` varchar(255) DEFAULT '',
  `weight` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `lev` int(11) NOT NULL DEFAULT '0',
  `subitem` text,
  `groups_view` varchar(255) DEFAULT '',
  `module_name` varchar(255) DEFAULT '',
  `op` varchar(255) DEFAULT '',
  `target` tinyint(4) DEFAULT '0',
  `css` varchar(255) DEFAULT '',
  `active_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`,`mid`)
) ENGINE=MyISAM  AUTO_INCREMENT=71  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (29, 0, 1, 'Dự án', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=projects', '', '', '', 3, 13, 0, '34', '14', '0', '', 1, 'fa fa-briefcase', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (26, 46, 1, 'Nhân sự', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=workforce', '', '', '', 2, 3, 1, '', '14', 'crm', 'workforce', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (25, 0, 1, 'Khách hàng', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=customer', '', '', '', 2, 8, 0, '33,42,43,67', '10,11,12', '0', '', 1, 'fa fa-user-circle', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (33, 25, 1, 'Thêm khách hàng', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=customer&op=content', '', '', '', 2, 10, 1, '', '6', 'crm', 'manage_customer_form', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (31, 0, 1, 'Báo cáo công việc', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=workreport', '', '', '', 6, 19, 0, '', '14', 'workreport', '', 1, 'fa fa-line-chart', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (46, 0, 1, 'Văn phòng', '#', '', '', '', 1, 1, 0, '26,51,47,52,68,69', '14', '0', '', 1, 'fa fa-briefcase', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (34, 29, 1, 'Thêm dự án', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=projects&op=content', '', '', '', 1, 14, 1, '', '6', 'projects', 'main', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (44, 0, 1, 'Hóa đơn', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=invoice', '', '', '', 4, 15, 0, '45', '4', 'invoice', '', 1, 'fa fa-file-text-o', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (51, 46, 1, 'Dịch vụ', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=services', '', '', '', 6, 7, 1, '', '6', 'services', '', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (40, 0, 1, 'Quản lý Email', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=email', '', '', '', 5, 17, 0, '41', '14', 'email', '', 1, 'fa fa-envelope-o', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (41, 40, 1, 'Gửi Email mới', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=email&op=content', '', '', '', 1, 18, 1, '', '6', 'email', 'content', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (42, 25, 1, 'Thêm liên hệ', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=customer&op=content&is_contact=1', '', '', '', 4, 12, 1, '', '6', 'crm', 'manage_customer_form', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (47, 46, 1, 'Sản phẩm', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=products', '', '', '', 5, 6, 1, '', '10,11', 'products', '', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (43, 25, 1, 'Danh sách liên hệ', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=customer&is_contact=1', '', '', '', 3, 11, 1, '', '6', 'crm', 'manage_customer', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (45, 44, 1, 'Tạo hóa đơn', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=invoice&op=content', '', '', '', 1, 16, 1, '', '6', 'invoice', 'content', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (52, 46, 1, 'Phòng ban', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=workforce&op=part', '', '', '', 1, 2, 1, '', '6', 'workforce', 'salary', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (67, 25, 1, 'Danh sách khách hàng', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=customer', '', '', '', 1, 9, 1, '', '6', 'customer', '', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (68, 46, 1, 'Quản lý thu chi', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=money', '', '', '', 3, 4, 1, '', '10,16', 'money', '', 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_menu_rows` (`id`, `parentid`, `mid`, `title`, `link`, `icon`, `image`, `note`, `weight`, `sort`, `lev`, `subitem`, `groups_view`, `module_name`, `op`, `target`, `css`, `active_type`, `status`) VALUES (69, 46, 1, 'Tài liệu nội bộ', '" . NV_BASE_SITEURL . "index.php?language=vi&nv=wiki', '', '', '', 4, 5, 1, '', '14', 'wiki', '', 1, '', 0, 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_modfuncs`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_modfuncs` (
  `func_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `func_name` varchar(55) NOT NULL,
  `alias` varchar(55) NOT NULL DEFAULT '',
  `func_custom_name` varchar(255) NOT NULL,
  `func_site_title` varchar(255) NOT NULL DEFAULT '',
  `in_module` varchar(50) NOT NULL,
  `show_func` tinyint(4) NOT NULL DEFAULT '0',
  `in_submenu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subweight` smallint(2) unsigned NOT NULL DEFAULT '1',
  `setting` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`func_id`),
  UNIQUE KEY `func_name` (`func_name`,`in_module`),
  UNIQUE KEY `alias` (`alias`,`in_module`)
) ENGINE=MyISAM  AUTO_INCREMENT=197  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (100, 'main', 'main', 'Main', '', 'projects', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (99, 'detail', 'detail', 'Detail', '', 'projects', 1, 0, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (98, 'content', 'content', 'Content', '', 'projects', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (19, 'main', 'main', 'Main', '', 'users', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (20, 'login', 'login', 'Đăng nhập', '', 'users', 1, 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (21, 'register', 'register', 'Đăng ký', '', 'users', 1, 1, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (22, 'lostpass', 'lostpass', 'Khôi phục mật khẩu', '', 'users', 1, 1, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (23, 'active', 'active', 'Kích hoạt tài khoản', '', 'users', 1, 0, 5, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (24, 'lostactivelink', 'lostactivelink', 'Lostactivelink', '', 'users', 1, 0, 6, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (25, 'editinfo', 'editinfo', 'Thiết lập tài khoản', '', 'users', 1, 1, 7, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (26, 'memberlist', 'memberlist', 'Danh sách thành viên', '', 'users', 1, 1, 8, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (27, 'avatar', 'avatar', 'Avatar', '', 'users', 1, 0, 9, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (28, 'logout', 'logout', 'Thoát', '', 'users', 1, 1, 10, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (29, 'groups', 'groups', 'Quản lý nhóm', '', 'users', 1, 0, 11, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (30, 'oauth', 'oauth', 'Oauth', '', 'users', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (38, 'main', 'main', 'Main', '', 'banners', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (39, 'addads', 'addads', 'Addads', '', 'banners', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (40, 'clientinfo', 'clientinfo', 'Clientinfo', '', 'banners', 1, 0, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (41, 'stats', 'stats', 'Stats', '', 'banners', 1, 0, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (42, 'cledit', 'cledit', 'Cledit', '', 'banners', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (43, 'click', 'click', 'Click', '', 'banners', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (44, 'clinfo', 'clinfo', 'Clinfo', '', 'banners', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (45, 'logininfo', 'logininfo', 'Logininfo', '', 'banners', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (46, 'viewmap', 'viewmap', 'Viewmap', '', 'banners', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (47, 'main', 'main', 'main', '', 'comment', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (48, 'post', 'post', 'post', '', 'comment', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (49, 'like', 'like', 'Like', '', 'comment', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (50, 'delete', 'delete', 'Delete', '', 'comment', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (51, 'down', 'down', 'Down', '', 'comment', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (52, 'main', 'main', 'Main', '', 'page', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (53, 'sitemap', 'sitemap', 'Sitemap', '', 'page', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (54, 'rss', 'rss', 'Rss', '', 'page', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (58, 'main', 'main', 'Main', '', 'two-step-verification', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (59, 'confirm', 'confirm', 'Confirm', '', 'two-step-verification', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (60, 'setup', 'setup', 'Setup', '', 'two-step-verification', 1, 0, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (63, 'main', 'main', 'Main', '', 'seek', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (64, 'main', 'main', 'Main', '', 'feeds', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (106, 'content', 'content', 'Content', '', 'services', 1, 0, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (107, 'detail', 'detail', 'Detail', '', 'services', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (108, 'main', 'main', 'Main', '', 'services', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (109, 'main', 'main', 'Main', '', 'notification', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (110, 'main', 'main', 'Main', '', 'home', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (115, 'content', 'content', 'Content', '', 'email', 1, 1, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (116, 'detail', 'detail', 'Detail', '', 'email', 1, 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (117, 'main', 'main', 'Main', '', 'email', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (118, 'rss', 'rss', 'Rss', '', 'email', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (119, 'search', 'search', 'Search', '', 'email', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (120, 'sitemap', 'sitemap', 'Sitemap', '', 'email', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (121, 'detail', 'detail', 'Detail', '', 'products', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (122, 'main', 'main', 'Main', '', 'products', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (123, 'content', 'content', 'Content', '', 'invoice', 1, 0, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (124, 'detail', 'detail', 'Detail', '', 'invoice', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (125, 'main', 'main', 'Main', '', 'invoice', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (126, 'download', 'download', 'Download', '', 'email', 1, 0, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (127, 'main', 'main', 'Main', '', 'workreport', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (129, 'content', 'content', 'Content', '', 'products', 1, 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (130, 'content', 'content', 'Content', '', 'customer', 1, 0, 5, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (131, 'detail', 'detail', 'Detail', '', 'customer', 1, 0, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (132, 'main', 'main', 'Main', '', 'customer', 1, 1, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (133, 'content', 'content', 'Content', '', 'workforce', 1, 0, 5, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (134, 'detail', 'detail', 'Detail', '', 'workforce', 1, 0, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (135, 'main', 'main', 'Main', '', 'workforce', 1, 1, 3, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (136, 'salary-content', 'salary-content', 'Salary-content', '', 'workforce', 1, 0, 7, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (137, 'salary', 'salary', 'Salary', '', 'workforce', 1, 1, 6, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (138, 'main', 'main', 'Main', '', 'api', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (153, 'types', 'types', 'Types', '', 'projects', 0, 0, 0, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (151, 'invoice', 'invoice', 'Invoice', '', 'invoice', 1, 0, 4, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (152, 'admin', 'admin', 'Admin', '', 'workreport', 1, 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (163, 'export', 'export', 'Export', '', 'customer', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (164, 'import', 'import', 'Import', '', 'customer', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (165, 'history-salary', 'history-salary', 'History-salary', '', 'workforce', 1, 0, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (166, 'part', 'part', 'Part', '', 'workforce', 1, 0, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (167, 'content', 'content', 'Content', '', 'money', 1, 1, 2, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (168, 'main', 'main', 'Main', '', 'money', 1, 1, 1, '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `alias`, `func_custom_name`, `func_site_title`, `in_module`, `show_func`, `in_submenu`, `subweight`, `setting`) VALUES (173, 'main', 'main', 'Main', '', 'calendar', 1, 1, 1, '')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_modthemes`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_modthemes` (
  `func_id` mediumint(8) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  UNIQUE KEY `func_id` (`func_id`,`layout`,`theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (0, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (0, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (0, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (19, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (19, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (19, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (20, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (20, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (20, 'main-login', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (21, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (21, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (21, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (22, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (22, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (22, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (23, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (23, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (23, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (24, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (24, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (24, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (25, 'left-main', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (25, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (25, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (26, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (26, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (26, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (27, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (27, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (27, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (28, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (28, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (28, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (29, 'left-main', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (29, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (29, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (38, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (38, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (38, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (39, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (39, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (39, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (40, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (40, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (40, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (41, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (41, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (41, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (47, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (47, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (48, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (48, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (49, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (49, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (50, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (50, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (51, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (52, 'left-main', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (52, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (52, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (58, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (58, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (58, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (59, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (59, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (59, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (60, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (60, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (60, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (63, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (63, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (63, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (64, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (64, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (64, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (98, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (98, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (98, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (99, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (99, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (100, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (100, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (100, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (106, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (106, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (106, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (107, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (107, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (107, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (108, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (108, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (108, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (109, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (109, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (109, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (110, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (110, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (110, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (115, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (115, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (115, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (116, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (116, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (116, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (117, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (117, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (117, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (118, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (119, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (120, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (121, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (121, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (122, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (122, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (122, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (123, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (123, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (123, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (124, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (124, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (124, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (125, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (125, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (125, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (126, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (126, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (127, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (127, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (127, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (129, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (129, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (130, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (130, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (130, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (131, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (131, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (131, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (132, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (132, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (132, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (133, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (133, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (133, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (134, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (134, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (134, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (135, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (135, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (135, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (136, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (136, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (137, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (137, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (138, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (138, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (138, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (151, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (151, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (151, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (152, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (152, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (153, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (163, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (163, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (164, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (164, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (165, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (165, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (166, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (166, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (167, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (167, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (167, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (168, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (168, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (168, 'main-collapse', 'dashboard')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (173, 'left-main-right', 'default')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (173, 'main', 'simple')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modthemes` (`func_id`, `layout`, `theme`) VALUES (173, 'main-collapse', 'dashboard')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_modules`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_modules` (
  `title` varchar(50) NOT NULL,
  `module_file` varchar(50) NOT NULL DEFAULT '',
  `module_data` varchar(50) NOT NULL DEFAULT '',
  `module_upload` varchar(50) NOT NULL DEFAULT '',
  `module_theme` varchar(50) NOT NULL DEFAULT '',
  `custom_title` varchar(255) NOT NULL,
  `site_title` varchar(255) NOT NULL DEFAULT '',
  `admin_title` varchar(255) NOT NULL DEFAULT '',
  `set_time` int(11) unsigned NOT NULL DEFAULT '0',
  `main_file` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `admin_file` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `theme` varchar(100) DEFAULT '',
  `mobile` varchar(100) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `keywords` text,
  `groups_view` varchar(255) NOT NULL,
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `act` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `admins` varchar(255) DEFAULT '',
  `rss` tinyint(4) NOT NULL DEFAULT '1',
  `sitemap` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('users', 'users', 'users', 'users', 'users', 'Thành viên', '', 'Tài khoản', 1514880771, 1, 1, '', '', '', '', '6', 3, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('projects', 'projects', 'projects', 'projects', 'projects', 'Quản lý dự án', '', '', 1515750961, 1, 1, '', '', '', '', '6', 11, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('banners', 'banners', 'banners', 'banners', 'banners', 'Quảng cáo', '', '', 1514880771, 1, 1, '', '', '', '', '6', 4, 0, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('seek', 'seek', 'seek', 'seek', 'seek', 'Tìm kiếm', '', '', 1514880771, 1, 0, '', '', '', '', '6', 5, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('menu', 'menu', 'menu', 'menu', 'menu', 'Menu Site', '', '', 1514880771, 0, 1, '', '', '', '', '6', 6, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('feeds', 'feeds', 'feeds', 'feeds', 'feeds', 'RSS-feeds', '', 'RSS-feeds', 1514880771, 1, 1, '', '', '', '', '6', 7, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('page', 'page', 'page', 'page', 'page', 'Page', '', '', 1514880771, 1, 1, '', '', '', '', '6', 8, 0, '', 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('comment', 'comment', 'comment', 'comment', 'comment', 'Bình luận', '', 'Quản lý bình luận', 1514880771, 0, 1, '', '', '', '', '6', 9, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('two-step-verification', 'two-step-verification', 'two_step_verification', 'two_step_verification', 'two-step-verification', 'Xác thực hai bước', '', '', 1514880771, 1, 0, '', '', '', '', '6', 10, 1, '', 0, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('services', 'services', 'services', 'services', 'services', 'Quản lý dịch vụ', '', '', 1516096780, 1, 1, '', '', '', '', '10,11', 12, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('notification', 'notification', 'notification', 'notification', 'notification', 'Thông báo', '', '', 1517809311, 1, 1, '', '', '', '', '6', 13, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('home', 'home', 'home', 'home', 'home', 'Home', '', '', 1517879767, 1, 0, '', '', '', '', '6', 14, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('email', 'email', 'email', 'email', 'email', 'Email', '', '', 1518147700, 1, 0, '', '', '', '', '6', 15, 1, '', 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('products', 'products', 'products', 'products', 'products', 'Sản phẩm', '', '', 1519719768, 1, 1, '', '', '', '', '6', 16, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('invoice', 'invoice', 'invoice', 'invoice', 'invoice', 'Hóa đơn', '', '', 1519719779, 1, 1, '', '', '', '', '4', 17, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('workreport', 'workreport', 'workreport', 'workreport', 'workreport', 'Báo cáo công việc', '', '', 1521274444, 1, 1, '', '', '', '', '6', 18, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('customer', 'customer', 'customer', 'customer', 'customer', 'Khách hàng', '', '', 1525527263, 1, 1, '', '', '', '', '6', 2, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('workforce', 'workforce', 'workforce', 'workforce', 'workforce', 'Nhân sự', '', '', 1525568597, 1, 1, '', '', '', '', '6', 19, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('api', 'api', 'api', 'api', 'api', 'Api', '', '', 1526207358, 1, 0, '', '', '', '', '6', 20, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('money', 'money', 'money', 'money', 'money', 'Quản lý thu chi', '', '', 1555580848, 1, 1, '', '', '', '', '10,16', 21, 1, '', 0, 0)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `module_upload`, `module_theme`, `custom_title`, `site_title`, `admin_title`, `set_time`, `main_file`, `admin_file`, `theme`, `mobile`, `description`, `keywords`, `groups_view`, `weight`, `act`, `admins`, `rss`, `sitemap`) VALUES ('calendar', 'calendar', 'calendar', 'calendar', 'calendar', 'Lịch', '', '', 1556794273, 1, 0, '', '', '', '', '6', 1, 1, '', 0, 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_money_money`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_money_money` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL,
  `date` int(11) unsigned NOT NULL,
  `money` double NOT NULL,
  `note` text NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_notification_register`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_notification_register` (
  `userid` mediumint(8) unsigned NOT NULL,
  `endpoint` varchar(100) NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_notification_register` (`userid`, `endpoint`) VALUES (1, ' err e eg')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_page`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `image` varchar(255) DEFAULT '',
  `imagealt` varchar(255) DEFAULT '',
  `imageposition` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `bodytext` mediumtext NOT NULL,
  `keywords` text,
  `socialbutton` tinyint(4) NOT NULL DEFAULT '0',
  `activecomm` varchar(255) DEFAULT '',
  `layout_func` varchar(100) DEFAULT '',
  `weight` smallint(4) NOT NULL DEFAULT '0',
  `admin_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `edit_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hitstotal` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hot_post` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_page_config`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_page_config` (
  `config_name` varchar(30) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('viewtype', '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('facebookapi', '')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('per_page', '20')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('news_first', '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('related_articles', '5')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('copy_page', '0')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_page_config` (`config_name`, `config_value`) VALUES ('alias_lower', '1')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_products`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_products` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `catid` smallint(4) unsigned NOT NULL,
  `price` double unsigned NOT NULL,
  `vat` double unsigned NOT NULL DEFAULT '0',
  `price_unit` tinyint(1) NOT NULL,
  `url` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `note` text NOT NULL,
  `weight` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=3  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_products` (`id`, `title`, `catid`, `price`, `vat`, `price_unit`, `url`, `active`, `note`, `weight`) VALUES (2, 'san pham 1', 1, '0', '0', 0, '', 1, '', 0)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_products_cat`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_products_cat` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `weight` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=2  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_products_cat` (`id`, `title`, `note`, `weight`) VALUES (1, 'drg rg', '', 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_products_price_unit`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_products_price_unit` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `weight` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `customerid` mediumint(8) unsigned NOT NULL COMMENT 'ID khách hàng',
  `workforceid` varchar(255) NOT NULL COMMENT 'Nhân viên phụ trách',
  `title` varchar(255) NOT NULL,
  `begintime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `realtime` int(11) unsigned NOT NULL DEFAULT '0',
  `price` double unsigned NOT NULL DEFAULT '0',
  `vat` double unsigned NOT NULL DEFAULT '0',
  `url_code` text NOT NULL,
  `content` text NOT NULL,
  `files` text NOT NULL,
  `useradd` smallint(4) unsigned NOT NULL COMMENT 'Nhân viên tạo',
  `addtime` int(11) unsigned NOT NULL,
  `edittime` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type_id` smallint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=13  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_econtent`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_econtent` (
  `action` varchar(100) NOT NULL,
  `econtent` text NOT NULL,
  PRIMARY KEY (`action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_projects_econtent` (`action`, `econtent`) VALUES ('new_project', 'Xin chào <strong>&#91;CUSTOMER_LAST_NAME&#93; &#91;CUSTOMER_FISRT_NAME&#93;</strong>. Dự án&nbsp;<strong>&#91;TITLE&#93;</strong> đã được khởi tạo tại <strong>&#91;SITE_NAME&#93;</strong>. Dưới đây là thông tin chi tiết về dự án.
<ul>
	<li><strong>Tên dự án:</strong>&nbsp;&#91;TITLE&#93;</li>
	<li><strong>Thời gian bắt đầu: </strong>&#91;BEGIN_TIME&#93;</li>
	<li><strong>Thời gian hoàn thành (dự kiến):</strong>&nbsp;&#91;END_TIME&#93;</li>
	<li><strong>Trạng thái:&nbsp;</strong>&#91;STATUS&#93;</li>
</ul>
&#91;CONTENT&#93;<br  />
<br  />
Mọi thông tin, hoạt động đến dự án sẽ được thông báo qua thư này.<br  />
Chúc quý khách hàng một ngày làm làm việc hiệu quả!')";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_projects_econtent` (`action`, `econtent`) VALUES ('print', '<div style=\"line-height: 27px\">
<div style=\"text-align: center;\"><span style=\"font-size:18px;\"><strong>THÔNG TIN DỰ ÁN</strong></span></div>

<div style=\"text-align: center;\"><strong>&#91;TITLE&#93;</strong></div>
<br  />
Danh mục dự án:&nbsp;<strong>&#91;CAT&#93;</strong><br  />
Họ tên khách hàng:&nbsp;<strong>&#91;CUSTOMER_FULLNAME&#93;</strong><br  />
Thời gian bắt đầu:&nbsp;<strong>&#91;BEGIN_TIME&#93;</strong><br  />
Thời gian hoàn thành dự kiến:&nbsp;<strong>&#91;END_TIME&#93;</strong><br  />
Thời gian hoàn thành thực tế:&nbsp;<strong>&#91;REAL_TIME&#93;</strong><br  />
Chi phí:&nbsp;<strong>&#91;PRICE&#93;</strong><br  />
Thuế:&nbsp;<strong>&#91;VAT&#93;%</strong><br  />
<strong>&#91;STATUS&#93;</strong>: Trạng thái<br  />
<br  />
&#91;CONTENT&#93;</div>')";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_field`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_field` (
  `fid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `field` varchar(25) NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `field_type` enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
  `field_choices` text NOT NULL,
  `sql_choices` text NOT NULL,
  `match_type` enum('none','alphanumeric','email','url','regex','callback') NOT NULL DEFAULT 'none',
  `match_regex` varchar(250) NOT NULL DEFAULT '',
  `func_callback` varchar(75) NOT NULL DEFAULT '',
  `min_length` int(11) NOT NULL DEFAULT '0',
  `max_length` bigint(20) unsigned NOT NULL DEFAULT '0',
  `required` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `show_profile` tinyint(4) NOT NULL DEFAULT '1',
  `class` varchar(50) NOT NULL DEFAULT '',
  `language` text NOT NULL,
  `default_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `field` (`field`)
) ENGINE=MyISAM  AUTO_INCREMENT=4  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_info`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_info` (
  `rows_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`rows_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_performer`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_performer` (
  `projectid` int(11) unsigned NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY `projectid` (`projectid`,`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_task`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_task` (
  `taskid` int(11) unsigned NOT NULL,
  `projectid` mediumint(8) unsigned NOT NULL,
  `weight` smallint(4) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `taskid` (`taskid`,`projectid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_projects_types`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_projects_types` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Loại dự án',
  `note` text NOT NULL COMMENT 'Ghi chú',
  `weight` smallint(4) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=2  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_referer_stats`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_referer_stats` (
  `host` varchar(250) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `month01` int(11) NOT NULL DEFAULT '0',
  `month02` int(11) NOT NULL DEFAULT '0',
  `month03` int(11) NOT NULL DEFAULT '0',
  `month04` int(11) NOT NULL DEFAULT '0',
  `month05` int(11) NOT NULL DEFAULT '0',
  `month06` int(11) NOT NULL DEFAULT '0',
  `month07` int(11) NOT NULL DEFAULT '0',
  `month08` int(11) NOT NULL DEFAULT '0',
  `month09` int(11) NOT NULL DEFAULT '0',
  `month10` int(11) NOT NULL DEFAULT '0',
  `month11` int(11) NOT NULL DEFAULT '0',
  `month12` int(11) NOT NULL DEFAULT '0',
  `last_update` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `host` (`host`),
  KEY `total` (`total`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('mail.google.com', 15, 4, 10, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1525499947)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('google.com', 30, 5, 1, 3, 1, 9, 7, 4, 0, 0, 0, 0, 0, 1531382144)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('l.facebook.com', 4, 2, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 1529210195)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('web.skype.com', 8, 0, 7, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1520820352)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('onesignal.com', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1517815908)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('61.14.235.168', 9, 0, 3, 4, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1531387578)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('yopmail.com', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1526020309)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('danhsach.cuudinh.vn', 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1527913036)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('quantri.vidoco.vn', 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1529122248)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('m.facebook.com', 2, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 1529210180)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_referer_stats` (`host`, `total`, `month01`, `month02`, `month03`, `month04`, `month05`, `month06`, `month07`, `month08`, `month09`, `month10`, `month11`, `month12`, `last_update`) VALUES ('sandbox.vnpayment.vn', 8, 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 1530440711)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_searchkeys`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_searchkeys` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `skey` varchar(250) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `search_engine` varchar(50) NOT NULL,
  KEY `id` (`id`),
  KEY `skey` (`skey`),
  KEY `search_engine` (`search_engine`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_services`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_services` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` double unsigned NOT NULL,
  `price_unit` tinyint(1) NOT NULL,
  `vat` double unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `note` text NOT NULL,
  `weight` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=5  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_services` (`id`, `title`, `price`, `price_unit`, `vat`, `active`, `note`, `weight`) VALUES (4, 'test', '0', 0, '0', 1, '', 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_services_customer`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_services_customer` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `customerid` mediumint(8) NOT NULL,
  `serviceid` smallint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `price` double unsigned NOT NULL DEFAULT '0',
  `month` smallint(4) unsigned NOT NULL COMMENT 'Số tháng thanh toán',
  `begintime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `addtime` int(11) unsigned NOT NULL,
  `useradd` mediumint(8) unsigned NOT NULL,
  `edittime` int(11) unsigned NOT NULL DEFAULT '0',
  `useredit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_services_price_unit`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_services_price_unit` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `weight` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_workforce`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_workforce` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `birthday` int(11) unsigned NOT NULL DEFAULT '0',
  `main_phone` varchar(20) NOT NULL,
  `other_phone` varchar(255) NOT NULL,
  `main_email` varchar(100) NOT NULL,
  `other_email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `knowledge` text NOT NULL COMMENT 'Thông tin học vấn',
  `image` varchar(255) NOT NULL,
  `jointime` int(11) unsigned NOT NULL DEFAULT '0',
  `position` varchar(100) NOT NULL,
  `part` varchar(100) NOT NULL COMMENT 'Thuộc bộ phận',
  `addtime` int(11) unsigned NOT NULL,
  `edittime` int(11) unsigned NOT NULL DEFAULT '0',
  `useradd` mediumint(8) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=4  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce` (`id`, `userid`, `first_name`, `last_name`, `gender`, `birthday`, `main_phone`, `other_phone`, `main_email`, `other_email`, `address`, `knowledge`, `image`, `jointime`, `position`, `part`, `addtime`, `edittime`, `useradd`, `status`) VALUES (1, 1, 'admin', '', 1, 0, '', '', 'admin@mail.com', '', '', '', '', 1555474269, '', '1', 1555474269, 0, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce` (`id`, `userid`, `first_name`, `last_name`, `gender`, `birthday`, `main_phone`, `other_phone`, `main_email`, `other_email`, `address`, `knowledge`, `image`, `jointime`, `position`, `part`, `addtime`, `edittime`, `useradd`, `status`) VALUES (2, 2, 'Đặng', 'Phong', 1, 862676639, '0906176994', '', 'phonghai88@gmail.com', 'phonghai88@gmail.com', '119 Trần Đăng Ninh', '', '', 0, '', '1', 1556156007, 1556862978, 1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce` (`id`, `userid`, `first_name`, `last_name`, `gender`, `birthday`, `main_phone`, `other_phone`, `main_email`, `other_email`, `address`, `knowledge`, `image`, `jointime`, `position`, `part`, `addtime`, `edittime`, `useradd`, `status`) VALUES (3, 3, 'Lê', 'Lộc', 1, 705083039, '0982365456', '', 'leloc09@gmail.com', 'leloc09@gmail.com', 'Châu Hưng - Bình Đại', '', '', 0, '', '1', 1556156131, 1556863549, 1, 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_workforce_part`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_workforce_part` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL COMMENT 'Tên gọi bộ phận',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `office` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `website` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `note` tinytext NOT NULL COMMENT 'Ghi chú',
  `lev` smallint(4) unsigned NOT NULL DEFAULT '0',
  `numsub` smallint(4) unsigned NOT NULL DEFAULT '0',
  `subid` varchar(255) DEFAULT '',
  `sort` smallint(4) unsigned NOT NULL DEFAULT '0',
  `weight` smallint(4) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=4  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce_part` (`id`, `parentid`, `title`, `alias`, `office`, `address`, `phone`, `fax`, `website`, `email`, `note`, `lev`, `numsub`, `subid`, `sort`, `weight`, `status`) VALUES (1, 0, 'Administrator', 'Administrator', '', '', '', '', '', '', '', 0, 0, '', 1, 1, 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_workforce_part_detail`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_workforce_part_detail` (
  `userid` mediumint(8) unsigned NOT NULL,
  `part` smallint(4) NOT NULL COMMENT 'Thuộc bộ phận',
  UNIQUE KEY `userid` (`userid`,`part`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce_part_detail` (`userid`, `part`) VALUES (1, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce_part_detail` (`userid`, `part`) VALUES (2, 1)";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_workforce_part_detail` (`userid`, `part`) VALUES (3, 1)";

$sql_create_table[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_vi_workreport`";
$sql_create_table[] = "CREATE TABLE `" . $db_config['prefix'] . "_vi_workreport` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL,
  `fortime` int(11) unsigned NOT NULL,
  `time` float NOT NULL,
  `content` text NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=3  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_unicode_ci";
