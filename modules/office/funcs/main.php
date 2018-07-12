<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2017 mynukeviet. All rights reserved
 * @Createdate Thu, 16 Nov 2017 13:27:56 GMT
 */

if (!defined('NV_IS_MOD_OFFICE')) die('Stop!!!');

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['workreport']);

$array_data = array();

$contents = nv_theme_office_main($array_data);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
