<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 12 Jan 2018 09:14:06 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_PROJECT', true);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

if (!defined('NV_IS_USER')) {
    $url_back = NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt($client_info['selfurl']);
    nv_redirect_location($url_back);
}

function nv_sendinfo_projects($id)
{
    global $db, $module_data, $global_config, $lang_module, $redirect, $workforce_list, $array_working_type_id;

    $message = $db->query('SELECT econtent FROM ' . NV_PREFIXLANG . '_' . $module_data . '_econtent WHERE action="new_project"')->fetchColumn();
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();

    if (!empty($message)) {
        $customer_info = nv_crm_customer_info($row['customerid']);
        $array_replace = array(
            'SITE_NAME' => $global_config['site_name'],
            'CAT' => !empty($row['type_id']) ? $array_working_type_id[$row['type_id']]['title'] : '',
            'CUSTOMER_FISRT_NAME' => $customer_info['first_name'],
            'CUSTOMER_LAST_NAME' => $customer_info['last_name'],
            'CUSTOMER_FULLNAME' => $customer_info['fullname'],
            'USER_WORK' => $workforce_list[$row['workforceid']]['fullname'],
            'TITLE' => $row['title'],
            'BEGIN_TIME' => !empty($row['begintime']) ? nv_date('d/m/Y', $row['begintime']) : '-',
            'END_TIME' => !empty($row['endtime']) ? nv_date('d/m/Y', $row['endtime']) : '-',
            'REAL_TIME' => !empty($row['realtime']) ? nv_date('d/m/Y', $row['realtime']) : '-',
            'PRICE' => !empty($row['price']) ? nv_number_format($row['price']) : '-',
            'VAT' => $row['vat'],
            'CONTENT' => $row['content'],
            'STATUS' => $lang_module['status_select_' . $row['status']],
            'URL_DETAIL' => NV_MY_DOMAIN . $redirect
        );
        $message = nv_unhtmlspecialchars($message);
        foreach ($array_replace as $index => $value) {
            $message = str_replace('[' . $index . ']', $value, $message);
        }
        $subject = sprintf($lang_module['new_project_title'], $global_config['site_name'], $row['title']);

        require_once NV_ROOTDIR . '/modules/email/site.functions.php';
        $sendto_id = array(
            $row['customerid']
        );

        $return = nv_email_send($subject, $message, 0, $sendto_id);
    }
    return $return['status'];
}

if (isset($site_mods['task'])) {
    define('NV_TASK', true);
    $array_task_status = array(
        0 => $lang_module['task_status_0'],
        1 => $lang_module['task_status_1'],
        2 => $lang_module['task_status_2']
    );
}

$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_types WHERE active=1 ORDER BY weight';
$array_working_type_id = $nv_Cache->db($_sql, 'id', $module_name);

function nv_number_format($number)
{
    return number_format($number);
}

/**
 * nv_theme_project_task_lisk()
 *
 * @param mixed $projectid
 * @return
 */
function nv_theme_project_task_lisk($projectid)
{
    global $db, $module_data, $module_file, $lang_module, $module_config, $module_info, $array_task_status, $workforce_list;

    $array_data = $db->query('SELECT t2.*, t1.taskid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_task t1 INNER JOIN ' . NV_PREFIXLANG . '_task t2 ON t1.taskid=t2.id WHERE t1.projectid=' . $projectid . ' ORDER BY begintime')->fetchAll();

    $xtpl = new XTemplate('detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    if (!empty($array_data)) {
        $i = 1;
        foreach ($array_data as $task) {
            $task['number'] = $i++;
            $task['status'] = $array_task_status[$task['status']];
            $task['begintime'] = !empty($task['begintime']) ? nv_date('d/m/Y', $task['begintime']) : '-';
            $task['endtime'] = !empty($task['endtime']) ? nv_date('d/m/Y', $task['endtime']) : '-';

            $task['performer_str'] = array();
            $performer = !empty($task['performer']) ? explode(',', $task['performer']) : array();
            foreach ($performer as $userid) {
                $task['performer_str'][] = isset($workforce_list[$userid]) ? $workforce_list[$userid]['fullname'] : '-';
            }
            $task['performer_str'] = !empty($task['performer_str']) ? implode(', ', $task['performer_str']) : '';
            $task['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=task&amp;' . NV_OP_VARIABLE . '=detail&id=' . $task['id'];

            $xtpl->assign('TASK', $task);
            $xtpl->parse('task_list.loop');
        }
    }

    $xtpl->parse('task_list');
    return $xtpl->text('task_list');
}

function normalizeFiles(&$files)
{
    $_files = [];
    $_files_count = count($files['name']);
    $_files_keys = array_keys($files);

    for ($i = 0; $i < $_files_count; $i++)
        foreach ($_files_keys as $key)
            $_files[$i][$key] = $files[$key][$i];

    return $_files;
}

function nv_projects_delete($id)
{
    global $db, $module_name, $module_data, $module_upload, $lang_module, $user_info;

    $rows = $db->query('SELECT title, files FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id)->fetch();
    if ($rows) {
        $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $id);
        if ($count) {

            // xóa custom field
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_info WHERE rows_id=' . $id);

            // xóa file đính kèm
            if (!empty($rows['files'])) {
                $rows['files'] = explode(',', $rows['files']);
                foreach ($rows['files'] as $path) {
                    if (file_exists(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path)) {
                        nv_deletefile(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $path);
                    }
                }
            }

            $content = sprintf($lang_module['logs_project_delete_note'], $rows['title']);
            nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['logs_project_delete'], $content, $user_info['userid']);
        }
    }
}

function nv_projects_makeLinks($value, $protocols = array('http', 'mail'), array $attributes = array())
{
    // Link attributes
    $attr = '';
    foreach ($attributes as $key => $val) {
        $attr = ' ' . $key . '="' . htmlentities($val) . '"';
    }

    $links = array();

    // Extract existing links and tags
    $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
        return '<' . array_push($links, $match[1]) . '>';
    }, $value);

    // Extract text links for each protocol
    foreach ((array) $protocols as $protocol) {
        switch ($protocol) {
            case 'http':
            case 'https':
                $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    if ($match[1]) $protocol = $match[1];
                    $link = $match[2] ?: $match[3];
                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>';
                }, $value);
                break;
            case 'mail':
                $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value);
                break;
            case 'twitter':
                $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1] . "\">{$match[0]}</a>") . '>';
                }, $value);
                break;
            default:
                $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value);
                break;
        }
    }

    // Insert all link
    return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
        return $links[$match[1] - 1];
    }, $value);
}

/**
 * nv_exams_report_download()
 *
 * @param mixed $title
 * @param mixed $array_data
 * @param mixed $type
 * @return
 *
 */
function nv_exams_report_download($title, $array_data, $type = 'xlsx')
{
    global $module_name, $array_config, $array_field_config, $admin_info, $lang_module;

    if (empty($array_data)) {
        die('Nothing download!');
    }

    $array = array(
        'objType' => '',
        'objExt' => ''
    );
    switch ($type) {
        case 'xlsx':
            $array['objType'] = 'Excel2007';
            $array['objExt'] = 'xlsx';
            break;
        case 'ods':
            $array['objType'] = 'OpenDocument';
            $array['objExt'] = 'ods';
            break;
        default:
            $array['objType'] = 'CSV';
            $array['objExt'] = 'csv';
    }

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);

    // Set properties
    $objPHPExcel->getProperties()
        ->setCreator($admin_info['username'])
        ->setLastModifiedBy($admin_info['username'])
        ->setTitle($title)
        ->setSubject($title)
        ->setDescription($title)
        ->setCategory($module_name);

    $columnIndex = 0; // Cot bat dau ghi du lieu
    $rowIndex = 3; // Dong bat dau ghi du lieu

    // cột số thứ tự
    $objPHPExcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($columnIndex) . $rowIndex, $lang_module['number']);

    // thông tin thành viên
    $objPHPExcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($columnIndex + 1) . $rowIndex, $lang_module['title']);

    $i = $columnIndex + 2;
    foreach ($array_data[0] as $index => $data) {
        if ($index == 'custom_field' && !empty($data)) {
            foreach ($data as $field) {
                $objPHPExcel->getActiveSheet()->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i) . $rowIndex, $field['title']);
                $i++;
            }
        }
    }

    $objPHPExcel->getActiveSheet()
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['customerid'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['workforceid'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['price'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['vat'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['content'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['url_code'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['typeid'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['begintime'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['endtime'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['realtime'])
        ->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i++) . $rowIndex, $lang_module['status']);

    // Hiển thị thông tin câu trả lời
    $i = $rowIndex + 1;
    $number = 1;
    foreach ($array_data as $data) {
        // số thứ tự
        $col = PHPExcel_Cell::stringFromColumnIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $number);

        // thông tin thành viên
        $col = PHPExcel_Cell::stringFromColumnIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['title']);

        // thông tin tùy biến
        $j = $columnIndex + 2;
        if (!empty($data['custom_field'])) {
            foreach ($data['custom_field'] as $field) {
                $col = PHPExcel_Cell::stringFromColumnIndex($j++);
                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $field['value']);
            }
        }

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['customer']['fullname']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['performer_str']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['price']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['vat']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['content']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['url_code']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['type_id']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['begintime']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['endtime']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['realtime']);

        $col = PHPExcel_Cell::stringFromColumnIndex($j++);
        $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data['status']);

        $i++;
        $number++;
    }

    $highestRow = $i - 1;
    $highestColumn = PHPExcel_Cell::stringFromColumnIndex($j - 1);

    // Rename sheet
    $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

    // Set page orientation and size
    $objPHPExcel->getActiveSheet()
        ->getPageSetup()
        ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
    $objPHPExcel->getActiveSheet()
        ->getPageSetup()
        ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    // Excel title
    $objPHPExcel->getActiveSheet()->mergeCells('A2:' . $highestColumn . '2');
    $objPHPExcel->getActiveSheet()->setCellValue('A2', $title);
    $objPHPExcel->getActiveSheet()
        ->getStyle('A2')
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()
        ->getStyle('A2')
        ->getAlignment()
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    // Set color
    $styleArray = array(
        'borders' => array(
            'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array(
                    'argb' => 'FF000000'
                )
            )
        )
    );

    $objPHPExcel->getActiveSheet()
        ->getStyle('A3' . ':' . $highestColumn . $highestRow)
        ->applyFromArray($styleArray);

    // Set font size
    $objPHPExcel->getActiveSheet()
        ->getStyle("A1:" . $highestColumn . $highestRow)
        ->getFont()
        ->setSize(13);

    // Set auto column width
    foreach (range('A', $highestColumn) as $columnID) {
        $objPHPExcel->getActiveSheet()
            ->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $array['objType']);
    $file_src = NV_ROOTDIR . NV_BASE_SITEURL . NV_TEMP_DIR . '/' . change_alias($title) . '.' . $array['objExt'];
    $objWriter->save($file_src);

    $download = new NukeViet\Files\Download($file_src, NV_ROOTDIR . NV_BASE_SITEURL . NV_TEMP_DIR);
    $download->download_file();
    die();
}