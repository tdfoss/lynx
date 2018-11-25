<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.com)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Thu, 08 Mar 2018 01:26:35 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

function nv_read_data_customer_excel($file_name)
{
    require_once NV_ROOTDIR . '/includes/class/PHPExcel.php';
    $objPHPExcel = PHPExcel_IOFactory::load($file_name);

    $objWorksheet = $objPHPExcel->getActiveSheet();

    $highestRow = $objWorksheet->getHighestRow();

    $user_field = array();
    $user_field['stt'] = array(
        'col' => 0,
        'title' => 'stt'
    );
    $user_field['type_id'] = array(
        'col' => 1,
        'title' => 'type_id'
    );
    $user_field['first_name'] = array(
        'col' => 2,
        'title' => 'first_name'
    );
    $user_field['last_name'] = array(
        'col' => 3,
        'title' => 'last_name'
    );
    $user_field['main_phone'] = array(
        'col' => 4,
        'title' => 'main_phone'
    );
    $user_field['other_phone'] = array(
        'col' => 5,
        'title' => 'other_phone'
    );
    $user_field['main_email'] = array(
        'col' => 6,
        'title' => 'main_email'
    );
    $user_field['other_email'] = array(
        'col' => 7,
        'title' => 'other_email'
    );
    $user_field['birthday'] = array(
        'col' => 8,
        'title' => 'birthday'
    );
    $user_field['gender'] = array(
        'col' => 9,
        'title' => 'gender'
    );
    $user_field['address'] = array(
        'col' => 10,
        'title' => 'address'
    );
    $user_field['unit'] = array(
        'col' => 11,
        'title' => 'unit'
    );
    $user_field['facebook'] = array(
        'col' => 12,
        'title' => 'facebook'
    );
    $user_field['skype'] = array(
        'col' => 13,
        'title' => 'skype'
    );
    $user_field['zalo'] = array(
        'col' => 14,
        'title' => 'zalo'
    );
    $user_field['workforce'] = array(
        'col' => 15,
        'title' => 'workforce'
    );
    $user_field['note'] = array(
        'col' => 16,
        'title' => 'note'
    );

    $array_data_read = array();
    // read data
    for ($row = 4; $row <= $highestRow; ++$row) {
        foreach ($user_field as $field => $column) {
            $col = $column['col'];
            $cellValue = $objWorksheet->getCellByColumnAndRow($col, $row);
            //$cellValue = trim( $cellValue );
            if (!empty(trim($cellValue))) {
                $InvDate = $cellValue->getValue();
                if (PHPExcel_Shared_Date::isDateTime($cellValue)) {
                    $tmp = (array) PHPExcel_Shared_Date::ExcelToPHPObject($InvDate);
                    $tmp = explode(' ', $tmp['date']);
                    $array_data_read[$row][$field] = $tmp[0]; // date('d/m/Y', PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                } else {
                    $array_data_read[$row][$field] = $cellValue->getCalculatedValue();
                }
            }
        }
    }
    return $array_data_read;
}

function nv_save_data_customer($data_read, $_arr_fb)
{
    global $db, $module_data, $db_config, $array_professional_level, $array_contract, $user_info;

    $error_num = 0;
    $data_inserted = array();
    foreach ($data_read as $row) {
        $_contract = 0;

        if (isset($row['main_email'])) {

            if (!is_numeric(array_search($row['main_email'], $_arr_fb))) {
                $_contract = 1;
            }
        }

        if ($_contract > 0) {
            if (isset($row['birthday']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $row['birthday'], $m)) {
                $birthday = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
            } else {
                $birthday = 0;
            }

            $gender = ($row['gender'] == 'Nam') ? 1 : 0;
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (type_id, first_name, last_name, main_phone, other_phone, main_email, other_email, birthday, facebook, skype, zalo, note, address, gender, unit, care_staff, addtime, userid) VALUES (:type_id, :first_name, :last_name, :main_phone, :other_phone, :main_email, :other_email, :birthday, :facebook, :skype, :zalo, :note, :address, :gender, :unit, :care_staff, :addtime, :userid)';
            $data_insert = array();
            $data_insert['type_id'] = $row['type_id'];
            $data_insert['first_name'] = $row['first_name'];
            $data_insert['last_name'] = $row['last_name'];
            $data_insert['main_phone'] = $row['main_phone'];
            $data_insert['other_phone'] = !empty($row['other_phone']) ? $row['other_phone'] : '';
            $data_insert['main_email'] = $row['main_email'];
            $data_insert['other_email'] = !empty($row['other_email']) ? $row['other_email'] : '';
            $data_insert['birthday'] = $birthday;
            $data_insert['gender'] = $gender;
            $data_insert['address'] = !empty($row['address']) ? $row['address'] : '';
            $data_insert['unit'] = !empty($row['unit']) ? $row['unit'] : '';
            $data_insert['facebook'] = !empty($row['facebook']) ? $row['facebook'] : '';
            $data_insert['skype'] = !empty($row['skype']) ? $row['skype'] : '';
            $data_insert['zalo'] = !empty($row['zalo']) ? $row['zalo'] : '';
            $data_insert['care_staff'] = $row['workforce'][0];
            $data_insert['note'] = !empty($row['note']) ? $row['note'] : '';
            $data_insert['addtime'] = NV_CURRENTTIME;
            $data_insert['userid'] = $user_info['userid'];

            $new_id = $db->insert_id($_sql, 'id', $data_insert);

            if ($new_id > 0) {
                $data_inserted[] = $row;
            }
        }
    }
    return $data_inserted;
}