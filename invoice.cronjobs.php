<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 02 Dec 2015 08:26:04 GMT
 */
define('NV_SYSTEM', true);

// Xac dinh thu muc goc cua site
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __file__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/includes/mainfile.php';
require NV_ROOTDIR . '/includes/core/user_functions.php';
require_once NV_ROOTDIR . '/modules/customer/site.functions.php';
require_once NV_ROOTDIR . '/modules/invoice/language/' . NV_LANG_DATA . '.php';
require_once NV_ROOTDIR . '/modules/invoice/site.functions.php';

$array_reminder_days = array(
    8,
    2
);
$max = max($array_reminder_days);

// Duyệt tất cả các ngôn ngữ
$language_query = $db->query('SELECT lang FROM ' . $db_config['prefix'] . '_setup_language WHERE setup = 1');
while (list ($lang) = $language_query->fetch(3)) {
    $mquery = $db->query("SELECT title, module_data, module_file, module_upload FROM " . $db_config['prefix'] . "_" . $lang . "_modules WHERE module_file = 'invoice'");
    while (list ($module_name, $module_data, $module_file, $module_upload) = $mquery->fetch(3)) {
        // nhắc nhở thanh toán
        foreach ($array_reminder_days as $day) {
            $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE reminder=1 AND duetime!=0 AND cycle!=0 AND auto_create=1 AND DATEDIFF(DATE_FORMAT(FROM_UNIXTIME(duetime),"%Y-%m-%d"), now())=' . $day);
            while ($row = $result->fetch()) {
                // nếu lần đầu tiên thực hiện
                if ($max == $day) {
                    // tự động tạo hóa đơn (copy từ hóa đơn cũ)
                    $new_id = nv_copy_invoice($row['id']);

                    // thông tin hóa đơn vừa tạo
                    $info = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $new_id)->fetch();
                    if ($info) {
                        // đổi ngày bắt đầu hóa đơn mới chính bằng ngày hết hạn hóa đơn cũ
                        $info['createtime'] = $row['duetime'];
                        $info['duetime'] = nv_caculate_duetime($row['duetime'], $row['cycle']);
                        $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET createtime = :createtime, duetime = :duetime WHERE id=' . $new_id);
                        $stmt->bindParam(':createtime', $info['createtime'], PDO::PARAM_INT);
                        $stmt->bindParam(':duetime', $info['duetime'], PDO::PARAM_INT);
                        if ($stmt->execute()) {

                            /* if (!empty($info['workforceid'])) {
                                require_once NV_ROOTDIR . '/modules/notification/site.functions.php';
                                $array_userid = array(
                                    $info['workforceid']
                                );
                                $content = sprintf($lang_module['auto_create_notify'], '#' . $info['code'], $info['title']);
                                $url = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=detail&id=' . $new_id;
                                nv_send_notification($array_userid, $content, 'auto_create', $module_name, $url);
                            } */

                            nv_insert_logs(NV_LANG_DATA, $module_name, 'Tự động tạo hóa đơn: #' . $info['code']);

                            // không nhắc nhở hóa đơn cũ nữa
                            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET reminder=0 WHERE id=' . $row['id']);
                            nv_sendmail_econtent($new_id);
                        }
                    }
                } else {
                    if (nv_sendmail_econtent($row['id'])) {
                        nv_insert_logs(NV_LANG_DATA, $module_name, 'Gửi email thông báo đến khách hàng thanh toán hóa đơn: #' . $info['code']);
                    }
                }
            }
        }
        $nv_Cache->delMod($module_name);
    }
}
