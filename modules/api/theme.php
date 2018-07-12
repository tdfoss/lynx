<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2018 mynukeviet. All rights reserved
 * @Createdate Sat, 07 Apr 2018 03:33:16 GMT
 */

if ( ! defined( 'NV_IS_MOD_API' ) ) die( 'Stop!!!' );

/**
 * nv_theme_api_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_api_main ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}