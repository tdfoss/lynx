<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 03:33:46 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'ajax_action', 'post' ) )
{
    $tid = $nv_Request->get_int( 'tid', 'post', 0 );
    $new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
    $content = 'NO_' . $tid;
    if( $new_vid > 0 )
    {
        $sql = 'SELECT tid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags WHERE tid!=' . $tid . ' ORDER BY weight ASC';
        $result = $db->query( $sql );
        $weight = 0;
        while( $row = $result->fetch() )
        {
            ++$weight;
            if( $weight == $new_vid ) ++$weight;
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_tags SET weight=' . $weight . ' WHERE tid=' . $row['tid'];
            $db->query( $sql );
        }
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_tags SET weight=' . $new_vid . ' WHERE tid=' . $tid;
        $db->query( $sql );
        $content = 'OK_' . $tid;
    }
    $nv_Cache->delMod( $module_name );
    include NV_ROOTDIR . '/includes/header.php';
    echo $content;
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}
if ( $nv_Request->isset_request( 'delete_tid', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ))
{
    $tid = $nv_Request->get_int( 'delete_tid', 'get' );
    $delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
    if( $tid > 0 and $delete_checkss == md5( $tid . NV_CACHE_PREFIX . $client_info['session_id'] ) )
    {
        $weight=0;
        $sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_ags WHERE tid =' . $db->quote( $tid );
        $result = $db->query( $sql );
        list( $weight) = $result->fetch( 3 );

        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags  WHERE tid = ' . $db->quote( $tid ) );
        if( $weight > 0)
        {
            $sql = 'SELECT tid, weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags WHERE weight >' . $weight;
            $result = $db->query( $sql );
            while(list( $tid, $weight) = $result->fetch( 3 ))
            {
                $weight--;
                $db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_tags SET weight=' . $weight . ' WHERE tid=' . intval( $tid ));
            }
        }
        $nv_Cache->delMod( $module_name );
        Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
        die();
    }
}

$row = array();
$error = array();
$row['tid'] = $nv_Request->get_int( 'tid', 'post,get', 0 );
if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
    $row['title'] = $nv_Request->get_title( 'title', 'post', '' );
    $row['note'] = $nv_Request->get_string( 'note', 'post', '' );

    if( empty( $row['title'] ) )
    {
        $error[] = $lang_module['error_required_title'];
    }

    if( empty( $error ) )
    {
        try
        {
            if( empty( $row['tid'] ) )
            {
                $stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_tags (title, note, weight) VALUES (:title, :note, :weight)' );

                $weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags' )->fetchColumn();
                $weight = intval( $weight ) + 1;
                $stmt->bindParam( ':weight', $weight, PDO::PARAM_INT );


            }
            else
            {
                $stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_tags SET title = :title, note = :note WHERE tid=' . $row['tid'] );
            }
            $stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
            $stmt->bindParam( ':note', $row['note'], PDO::PARAM_STR, strlen($row['note']) );

            $exc = $stmt->execute();
            if( $exc )
            {
                $nv_Cache->delMod( $module_name );
                Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
                die();
            }
        }
        catch( PDOException $e )
        {
            trigger_error( $e->getMessage() );
            die( $e->getMessage() ); //Remove this line after checks finished
        }
    }
}
elseif( $row['tid'] > 0 )
{
    $row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_tags WHERE tid=' . $row['tid'] )->fetch();
    if( empty( $row ) )
    {
        Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
        die();
    }
}
else
{
    $row['tid'] = 0;
    $row['title'] = '';
    $row['note'] = '';
}

$q = $nv_Request->get_title( 'q', 'post,get' );

// Fetch Limit
$show_view = false;
if ( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int( 'page', 'post,get', 1 );
    $db->sqlreset()
    ->select( 'COUNT(*)' )
    ->from( '' . NV_PREFIXLANG . '_' . $module_data . '_tags' );

    if( ! empty( $q ) )
    {
        $db->where( 'title LIKE :q_title OR note LIKE :q_note' );
    }
    $sth = $db->prepare( $db->sql() );

    if( ! empty( $q ) )
    {
        $sth->bindValue( ':q_title', '%' . $q . '%' );
        $sth->bindValue( ':q_note', '%' . $q . '%' );
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select( '*' )
    ->order( 'weight ASC' )
    ->limit( $per_page )
    ->offset( ( $page - 1 ) * $per_page );
    $sth = $db->prepare( $db->sql() );

    if( ! empty( $q ) )
    {
        $sth->bindValue( ':q_title', '%' . $q . '%' );
        $sth->bindValue( ':q_note', '%' . $q . '%' );
    }
    $sth->execute();
}


$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );

$xtpl->assign( 'Q', $q );

if( $show_view )
{
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if( ! empty( $q ) )
    {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
    if( !empty( $generate_page ) )
    {
        $xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
        $xtpl->parse( 'main.view.generate_page' );
    }
    $number = $page > 1 ? ($per_page * ( $page - 1 ) ) + 1 : 1;
    while( $view = $sth->fetch() )
    {
        for( $i = 1; $i <= $num_items; ++$i )
        {
            $xtpl->assign( 'WEIGHT', array(
                'key' => $i,
                'title' => $i,
                'selected' => ( $i == $view['weight'] ) ? ' selected="selected"' : '') );
            $xtpl->parse( 'main.view.loop.weight_loop' );
        }
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;tid=' . $view['tid'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_tid=' . $view['tid'] . '&amp;delete_checkss=' . md5( $view['tid'] . NV_CACHE_PREFIX . $client_info['session_id'] );
        $xtpl->assign( 'VIEW', $view );
        $xtpl->parse( 'main.view.loop' );
    }
    $xtpl->parse( 'main.view' );
}


if( ! empty( $error ) )
{
    $xtpl->assign( 'ERROR', implode( '<br />', $error ) );
    $xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['tags'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';