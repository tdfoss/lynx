<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2016 Nuke.vn. All rights reserved
 * @Blog  http://dangdinhtu.com
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 13 Jul 2016 10:58:00 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nukevn_adsense_google' ) )
{
	function nukevn_adsense_google_config( $module, $data_block, $lang_block )
	{
 
		$html = '<tr>';
		$html .= '	<td>data ad client</td>';
		$html .= '	<td><input type="text" name="config_data_ad_client" class="form-control" value="' . $data_block['data_ad_client'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Name</td>';
		$html .= '	<td><input type="text" name="config_name" class="form-control" value="' . $data_block['name'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Width</td>';
		$html .= '	<td><input type="text" name="config_width" class="form-control" value="' . $data_block['width'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>Height</td>';
		$html .= '	<td><input type="text" name="config_height" class="form-control" value="' . $data_block['height'] . '"/></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '	<td>data ad slot</td>';
		$html .= '	<td><input type="text" name="config_data_ad_slot" class="form-control" value="' . $data_block['data_ad_slot'] . '"/></td>';
		$html .= '</tr>';
		return $html;
	}

	function nukevn_adsense_google_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config']['data_ad_client'] = $nv_Request->get_title( 'config_data_ad_client', 'post', ''  );
		$return['config']['name'] = $nv_Request->get_title( 'config_name', 'post', ''  );
		$return['config']['width'] = $nv_Request->get_int( 'config_width', 'post', 0 );
		$return['config']['height'] = $nv_Request->get_int( 'config_height', 'post', 0 );
		$return['config']['data_ad_slot'] = $nv_Request->get_title( 'config_data_ad_slot', 'post', '' );
		return $return;
	}

	function nukevn_adsense_google( $block_config )
	{
		global $global_config, $site_mods;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.ads_google.tpl' ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.ads_google.tpl' ) )
		{
			$block_theme = $global_config['site_theme'];
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'global.ads_google.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks' );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'BLOCK_THEME', $block_theme );
		$xtpl->assign( 'DATA', $block_config );

		if(empty($block_config['width']) and empty($block_config['height'])){
			$xtpl->parse( 'main.auto' );
		}else{
			$xtpl->parse( 'main.size' );
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	$content = nukevn_adsense_google( $block_config );
}
