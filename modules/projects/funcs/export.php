<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 14 Nov 2014 10:13:40 GMT
 */
if (!defined('NV_IS_MOD_CUSTOMER')) die('Stop!!!');

// if (!nv_allow_admin()) {
//     die( $lang_global['error_404_title'] );
// }

if (!file_exists(NV_ROOTDIR . '/includes/class/PHPExcel.php')) {
    die(strip_tags($lang_module['required_phpexcel']));
}
require_once NV_ROOTDIR . '/includes/class/PHPExcel.php';
$excel_ext = "xlsx";
$writerType = 'Excel2007';

$data_field = array();
$step = $nv_Request->get_int('step', 'get,post', 1);
$nextid = $nv_Request->get_int('nextid', 'get,post', 1);
$set_export = $nv_Request->get_int('set_export', 'get,post', 0);
$act = $nv_Request->get_title('act', 'get,post', '');
$limit = $nv_Request->get_int('limit', 'get,post', 0);

if ($act == 'customer') {
    if ($set_export == 1) {

        //data workforce
        $data_workforce = array();
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_workforce';
        $result = $db->query($sql);
        while ($row = $result->fetch()) {
            $data_workforce[$row['id']] = $row['id'] . '-' . $row['last_name'] . ' ' . $row['first_name'];
        }
        //data customer type
        $data_customer_type = array();
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_types WHERE active=1 ORDER BY weight';
        $result = $db->query($sql);
        while ($row = $result->fetch()) {
            $data_customer_type[$row['id']] = $row['id'] . '-' . $row['title'];
        }

        //tao du lieu mau neu limit > 0
        if ($limit > 0) {
            $result_field = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' LIMIT 1');
        } else {
            $result_field = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data);
        }
        while ($row_field = $result_field->fetch()) {
            $user_field_info[] = $row_field;
        }
        if (!empty($user_field_info)) {
            $nv_Request->set_Session($module_data . '_data_user', serialize($user_field_info));
            save_customer_file_excel($user_field_info, $data_workforce, $data_customer_type, $excel_ext, $writerType);
            $data_user = $nv_Request->get_string($module_data . '_data_user', 'session', '');
            $data_user = unserialize($data_user);
            if (!empty($data_user)) {
                $result = "NEXT";
                die($result);
            } else {
                die('COMPLETE');
            }
        }
    } elseif ($step == 2) {
        $file_src = NV_ROOTDIR . "/" . NV_TEMP_DIR . "/" . change_alias($lang_module['customer_dskh']) . '.xlsx';
        $nv_Request->unset_request($module_data . '_data_user', 'session');
        $download = new NukeViet\Files\Download($file_src, NV_ROOTDIR . "/" . NV_TEMP_DIR);
        $download->download_file();
        exit();
    }
}

/*
 * Function save class to excel
 */
function save_customer_file_excel($data_array, $data_customer, $data_customer_type, $excel_ext, $writerType)
{
    global $module_file, $module_data, $nv_Request, $lang_module, $module_name;
    $array_gender = array(
        1 => $lang_module['male'],
        0 => $lang_module['female']
    );

    $page_title = $lang_module['export_customer'];

    // Create new PHPExcel object
    $objPHPExcel = PHPExcel_IOFactory::load(NV_ROOTDIR . '/modules/' . $module_file . '/template/khach-hang.' . $excel_ext);

    //chuyen sang sheet 2 de ghi selecbox
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(1);
    $objWorksheet = $objPHPExcel->getActiveSheet();

    // Setting a spreadsheet’s metadata
    $objPHPExcel->getProperties()->setCreator("NukeViet CMS");
    $objPHPExcel->getProperties()->setLastModifiedBy("NukeViet CMS");
    $objPHPExcel->getProperties()->setTitle($page_title);
    $objPHPExcel->getProperties()->setSubject($page_title);
    $objPHPExcel->getProperties()->setDescription($page_title);
    $objPHPExcel->getProperties()->setKeywords($page_title);
    $objPHPExcel->getProperties()->setCategory($module_name);

    // Ghi dữ liệu bắt đầu từ dòng thứ $stt=1
    $stt = 1;
    $column = 'A';
    foreach ($data_customer_type as $data) {
        $CellValue = nv_unhtmlspecialchars($data);
        $objWorksheet->setCellValue($column . $stt, $CellValue);
        $stt++;
    }
    $stt--;
    $allow_type_cus = 'select!$' . $column . '$1:$' . $column . '$' . $stt;
    // Ghi dữ liệu bắt đầu từ dòng thứ $stt=1
    $stt = 1;
    $column = 'J';
    foreach ($array_gender as $data) {
        $CellValue = nv_unhtmlspecialchars($data);
        $objWorksheet->setCellValue($column . $stt, $CellValue);
        $stt++;
    }
    $stt--;
    $allow_gender = 'select!$' . $column . '$1:$' . $column . '$' . $stt;
    // Ghi dữ liệu bắt đầu từ dòng thứ $stt=1
    $stt = 1;
    $column = 'P';
    foreach ($data_customer as $data) {
        $CellValue = nv_unhtmlspecialchars($data);
        $objWorksheet->setCellValue($column . $stt, $CellValue);
        $stt++;
    }
    $stt--;
    $allow_workforce = 'select!$' . $column . '$1:$' . $column . '$' . $stt;

    $field = array(
        'stt',
        'type_id',
        'first_name',
        'last_name',
        'main_phone',
        'other_phone',
        'main_email',
        'other_email',
        'birthday',
        'gender',
        'address',
        'unit',
        'facebook',
        'skype',
        'zalo',
        'workforce',
        'note'
    );

    //chuyen sang sheet 1 de ghi data
    $objPHPExcel->setActiveSheetIndex(0);
    $objWorksheet = $objPHPExcel->getActiveSheet();

    $BStyle = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );

    // Set page orientation and size
    $objWorksheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $objWorksheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $objWorksheet->getPageSetup()->setHorizontalCentered(true);
    $objWorksheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
    // Ghi dữ liệu bắt đầu từ dòng thứ $i=4
    $i = 4;
    $stt = 1;
    foreach ($data_array as $key => $data) {
        $j = 0;
        $data['stt'] = $stt++;
        $data['birthday'] = !empty($data['birthday']) ? nv_date('d/m/Y', $data['birthday']) : '';

        foreach ($field as $collumn_data) {

            $col = PHPExcel_Cell::stringFromColumnIndex($j);
            if ($collumn_data == 'type_id' or $collumn_data == 'gender' or $collumn_data == 'workforce') {
                $objValidation2 = $objPHPExcel->getActiveSheet()
                    ->getCell($col . $i)
                    ->getDataValidation();
                $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation2->setAllowBlank(false);
                $objValidation2->setShowInputMessage(true);
                $objValidation2->setShowDropDown(true);
                $objValidation2->setPromptTitle($lang_module['pick_from_list']);
                $objValidation2->setPrompt($lang_module['pick_from_list_note']);
                $objValidation2->setErrorTitle('Input error');
                $objValidation2->setError('Value is not in list');

                if ($collumn_data == 'type_id') {
                    $objValidation2->setFormula1($allow_type_cus);
                    $data_set = $data_customer_type[$data[$collumn_data]];
                } elseif ($collumn_data == 'gender') {
                    $objValidation2->setFormula1($allow_gender);
                    $data_set = $array_gender[$data[$collumn_data]];
                } elseif ($collumn_data == 'workforce') {
                    $objValidation2->setFormula1($allow_workforce);
                    $data_set = $data_customer[$data['care_staff']];
                }

                $CellValue = nv_unhtmlspecialchars($data_set);
                $objWorksheet->setCellValue($col . $i, $CellValue);
            } else {
                $CellValue = nv_unhtmlspecialchars($data[$collumn_data]);
                $objWorksheet->setCellValue($col . $i, $CellValue);
            }

            $j++;
        }

        $objPHPExcel->getActiveSheet()
            ->getStyle('A' . $i . ':' . 'U' . $i)
            ->applyFromArray($BStyle);
        $i++;
        unset($data_array[$key]); //remove item when inset to excel
    }
    //ghi lai dư lieu data sau import
    $nv_Request->set_Session($module_data . '_data_user', serialize($data_array));

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $writerType);

    $objWriter->save(NV_ROOTDIR . "/" . NV_TEMP_DIR . "/" . change_alias($lang_module['customer_dskh']) . '.xlsx');
}
