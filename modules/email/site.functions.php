<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

function nv_email_send($title, $content, $sendfrom_id, $sendto_id, $cc_id = array(), $files = array(), $is_cc = 0, $sendfrom_email = array(), $is_template = true)
{
    global $db, $workforce_list, $global_config, $module_upload;

    try {
        $new_id = 0;
        $_cc_id = !empty($cc_id) ? implode(',', $cc_id) : '';
        $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_email (title, useradd, cc_id, content, files, addtime) VALUES (:title, ' . $sendfrom_id . ', :cc_id, :content, :files, ' . NV_CURRENTTIME . ')';
        $data_insert = array(
            'title' => $title,
            'cc_id' => $_cc_id,
            'content' => $content,
            'files' => !empty($files) ? $files : ''
        );
        $new_id = $db->insert_id($sql, 'id', $data_insert);

        if ($new_id > 0) {

            $sth = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_email_sendto (email_id, customer_id) VALUES(:email_id, :customer_id)');
            foreach ($sendto_id as $sendtoid) {
                $sth->bindParam(':email_id', $new_id, PDO::PARAM_INT);
                $sth->bindParam(':customer_id', $sendtoid, PDO::PARAM_INT);
                $sth->execute();
            }

            $array_email = array();
            $relust = $db->query('SELECT main_email FROM ' . NV_PREFIXLANG . '_customer WHERE id in(' . implode(',', $sendto_id) . ')');
            while (list ($main_email) = $relust->fetch(3)) {
                $array_email[] = $main_email;
            }
            $array_email = array_unique($array_email);

            $array_cc_mail = array();
            if (!empty($cc_id)) {
                foreach ($cc_id as $cc_id) {
                    $array_cc_mail[] = $workforce_list[$cc_id]['email'];
                }
            }
            $array_cc_mail = array_unique($array_cc_mail);

            if (!empty($array_email)) {
                $mail = new NukeViet\Core\Sendmail($global_config, NV_LANG_INTERFACE);
                $mail->Subject($title);

                if (!empty($sendfrom_id)) {
                    $sendfrom_info = $workforce_list[$sendfrom_id];
                    $mail->setFrom($sendfrom_info['email'], $sendfrom_info['fullname']);
                    $mail->addReplyTo($sendfrom_info['email'], $sendfrom_info['fullname']);
                } elseif (!empty($sendfrom_email)) {
                    $mail->setFrom($sendfrom_email['email'], $sendfrom_email['title']);
                    $mail->addReplyTo($sendfrom_email['email'], $sendfrom_email['title']);
                }

                // Chuyển đường dẫn ảnh thành tuyệt đối
                $array_images = array();
                if (preg_match_all("/\<img[^\>]*src=\"([^\"]*)\"[^\>]*\>/is", $content, $match)) {
                    foreach ($match[0] as $key => $_m) {
                        $image_url = $image_url_tmp = $match[1][$key];
                        if (!in_array($image_url, $array_images)) {
                            $content = str_replace($image_url_tmp, NV_MY_DOMAIN . $image_url, $content);
                            $array_images[] = $image_url_tmp;
                        }
                    }
                }

                if ($is_template && function_exists("nv_mailHTML")) {
                    $content = nv_mailHTML($title, $content);
                    $mail->AddEmbeddedImage(NV_ROOTDIR . '/' . $global_config['site_logo'], 'sitelogo', basename(NV_ROOTDIR . '/' . $global_config['site_logo']));
                }
                $mail->Content($content);

                foreach ($array_email as $_email) {
                    $_email = nv_unhtmlspecialchars($_email);
                    $mail->addAddress($_email);
                }

                if (!empty($array_cc_mail)) {
                    foreach ($array_cc_mail as $_email) {
                        $_email = nv_unhtmlspecialchars($_email);
                        $mail->AddCC($_email);
                    }
                }

                if (!empty($files)) {
                    if (!is_array($files)) {
                        $files = array_map('trim', explode(',', $files));
                    }

                    foreach ($files as $file) {
                        $file = NV_ROOTDIR . '/' . $file;
                        $mail->addAttachment($file);
                    }
                }

                if ($is_cc && $sendfrom_id > 0) {
                    $sendfrom_info = $workforce_list[$sendfrom_id];
                    if (!in_array($sendfrom_info['email'], $array_email) && !in_array($sendfrom_info['email'], $array_cc_mail)) {
                        $mail->addCC($sendfrom_info['email'], $sendfrom_info['fullname']);
                    }
                }

                if ($mail->Send()) {
                    return array(
                        'status' => 1,
                        'new_id' => $new_id
                    );
                }
                return array(
                    'status' => 0,
                    'new_id' => $new_id
                );
            }
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }
}