<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 14 Nov 2014 10:13:40 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

$filename = 'customer.csv';

if ($nv_Request->isset_request('option', 'post')) {
    $data = array(
        'page' => $nv_Request->get_int('page', 'post', 1),
        'per_page' => $nv_Request->get_int('per_page', 'post', 20),
        'selected_id' => $nv_Request->get_string('selected_id', 'post', ''),
        'where' => $nv_Request->get_string('where_string', 'post', ''),
        'join' => $nv_Request->get_string('join_string', 'post', ''),
        'checkssum' => $nv_Request->get_string('where_md5', 'post', ''),
        'ordername' => $nv_Request->get_string('ordername', 'post', ''),
        'ordertype' => $nv_Request->get_string('ordertype', 'post', '')
    );

    $array_type = array(
        1 => $lang_module['export_type_1'],
        2 => $lang_module['export_type_2'],
        3 => $lang_module['export_type_3']
    );

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    foreach ($data as $index => $value) {
        $xtpl->assign('DATA', array(
            'index' => $index,
            'value' => $value
        ));
        $xtpl->parse('option.data');
    }

    foreach ($array_type as $index => $value) {
        $xtpl->assign('TYPE', array(
            'index' => $index,
            'value' => $value,
            'checked' => $index == 3 ? 'checked="checked"' : ''
        ));
        $xtpl->parse('option.type');
    }

    $xtpl->parse('option');
    $contents = $xtpl->text('option');

    nv_htmlOutput($contents);
}

if ($nv_Request->isset_request('submit', 'post')) {
    $type = $nv_Request->get_int('type', 'post', 3);
    $data = $nv_Request->get_array('data', 'post');
    $data['where'] = base64_decode($data['where']);
    $data['join'] = base64_decode($data['join']);

    if (md5($data['where'] . $global_config['sitekey']) != $data['checkssum']) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_unknow']
        ));
    }

    $array_heading = array(
        'type_id' => $lang_module['customer_types'],
        'is_contacts' => $lang_module['is_types'],
        'last_name' => $lang_module['last_name'],
        'first_name' => $lang_module['first_name'],
        'main_phone' => $lang_module['main_phone'],
        'other_phone' => $lang_module['other_phone'],
        'main_email' => $lang_module['main_email'],
        'other_email' => $lang_module['other_email'],
        'birthday' => $lang_module['birthday'],
        'facebook' => $lang_module['facebook'],
        'skype' => $lang_module['skype'],
        'zalo' => $lang_module['zalo'],
        'gender' => $lang_module['gender'],
        'address' => $lang_module['address']
    );

    if ($type == 1) {
        $data['where'] .= ' AND id IN (' . ((!empty($data['selected_id'])) ? $data['selected_id'] : 0) . ')';
    }

    $db->select(implode(',', array_keys($array_heading)))
        ->from(NV_PREFIXLANG . '_' . $module_data . ' t1')
        ->join($data['join'])
        ->where('1=1' . $data['where'])
        ->order($data['ordername'] . ' ' . $data['ordertype']);

    if ($type == 2) {
        $db->limit($data['per_page'])->offset(($data['page'] - 1) * $data['per_page']);
    }

    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while ($row = $sth->fetch()) {
        $row['birthday'] = !empty($row['birthday']) ? nv_date('d/m/Y', $row['birthday']) : '';
        $row['gender'] = $array_gender[$row['gender']];
        $row['type_id'] = !empty($row['type_id']) ? $array_customer_type_id[$row['type_id']]['title'] : '';
        $row['is_contacts'] = !empty($row['is_contacts']) ? $lang_module['is_contacts'] : $lang_module['is_customer'];
        $array_data[] = $row;
    }

    nv_customer_export_csv($array_data, $filename, $array_heading);
}

if ($nv_Request->isset_request('download', 'get')) {
    $file_src = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $filename;
    $download = new NukeViet\Files\Download($file_src, NV_ROOTDIR . '/' . NV_TEMP_DIR, $filename);
    $download->download_file();
    exit();
}