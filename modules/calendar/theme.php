<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2019 mynukeviet. All rights reserved
 * @Createdate Thu, 02 May 2019 10:41:47 GMT
 */
if (!defined('NV_IS_MOD_CALENDAR')) die('Stop!!!');

/**
 * nv_theme_calendar_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_calendar_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;
    
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    
    $xtpl->parse('main');
    return $xtpl->text('main');
}