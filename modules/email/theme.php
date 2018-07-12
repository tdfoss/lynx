<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Le Hong Quang (quanglh268@tdfoss.com)
 * @Copyright (C) 2018 Le Hong Quang. All rights reserved
 * @Createdate Wed, 07 Feb 2018 03:04:50 GMT
 */

if ( ! defined( 'NV_IS_MOD_EMAIL' ) ) die( 'Stop!!!' );

/**
 * nv_theme_email_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_email_main ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_email_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_email_detail ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_email_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_email_search ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}