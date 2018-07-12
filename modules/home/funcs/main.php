<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 3-6-2010 0:14
 */

if( ! defined( 'NV_IS_MOD_HOME' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

if( ! $home )
{
	header( "Location:" . nv_url_rewrite( NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA, true ) );
}

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( "" );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>