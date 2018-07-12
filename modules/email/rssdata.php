<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Le Hong Quang (quanglh268@tdfoss.com)
 * @Copyright (C) 2018 Le Hong Quang. All rights reserved
 * @Createdate Wed, 07 Feb 2018 03:04:50 GMT
 */

if ( ! defined( 'NV_IS_MOD_RSS' ) ) die( 'Stop!!!' );

$rssarray = array();

/*$result2 = $db->query( 'SELECT catid, parentid, title, alias, numsubcat, subcatid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat ORDER BY weight' );
while ( list( $catid, $parentid, $title, $alias, $numsubcat, $subcatid ) = $result2->fetch( 3 ) )
{
    $rssarray[$catid] = array(
        'catid' => $catid, 'parentid' => $parentid, 'title' => $title, 'alias' => $alias, 'numsubcat' => $numsubcat, 'subcatid' => $subcatid, 'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_title . '&amp;' . NV_OP_VARIABLE . '=rss/' . $alias
    );
}*/
