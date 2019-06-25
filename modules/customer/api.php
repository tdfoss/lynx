<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_IS_MOD_API')) die('Stop!!!');

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App();

require_once NV_ROOTDIR . '/modules/customer/language/' . NV_LANG_DATA . '.php';

// add customer
$app->post('/api/customer/add/', function (Request $request, Response $response, array $args) {
    global $db, $lang_module;

    $row = array();
    $row['first_name'] = $request->getParam('first_name');
    $row['last_name'] = $request->getParam('last_name');
    $row['main_phone'] = $request->getParam('main_phone');
    $row['other_phone'] = $request->getParam('other_phone');
    $row['other_phone'] = !empty($row['other_phone']) ? implode('|', $row['other_phone']) : '';
    $row['main_email'] = $request->getParam('main_email');
    $row['other_email'] = $request->getParam('other_email');
    $row['other_email'] = !empty($row['other_email']) ? implode('|', $row['other_email']) : '';
    $row['facebook'] = $request->getParam('facebook');
    $row['skype'] = $request->getParam('skype');
    $row['zalo'] = $request->getParam('zalo');
    $row['website'] = $request->getParam('website');
    $row['gender'] = $request->getParam('gender');
    $row['address'] = $request->getParam('address');
    $row['care_staff'] = $request->getParam('care_staff');
    $row['image'] = $request->getParam('image');
    $row['note'] = $request->getParam('note');
    $row['is_contacts'] = $request->getParam('is_contacts');
    $row['type_id'] = $request->getParam('type_id');
    $row['birthday'] = $request->getParam('birthday');

    foreach ($row as $index => $value) {
        if ($value == NULL) {
            $row[$index] = '';
        }
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $row['birthday'], $m)) {
        $row['birthday'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['birthday'] = 0;
    }

    if (is_file(NV_DOCUMENT_ROOT . $row['image'])) {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/customer/'));
    } else {
        $row['image'] = '';
    }

    if (!empty($row['website'])) {
        foreach ($row['website'] as $index => $url) {
            if (!nv_is_url($url)) {
                unset($row['website'][$index]);
            }
        }
    }

    if (empty($row['first_name'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_fullname']
        ));
    } elseif (empty($row['id']) && !empty($row['main_email']) && $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE main_email=' . $db->quote($row['main_email']))
        ->fetchColumn() > 0) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => sprintf($lang_module['error_exits_email'], $row['main_email'])
            ));
    } elseif (empty($row['id']) && !empty($row['main_phone']) && $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE main_phone=' . $db->quote($row['main_phone']))
        ->fetchColumn() > 0) {
            nv_jsonOutput(array(
                'error' => 1,
                'msg' => sprintf($lang_module['error_exits_email'], $row['main_email'])
            ));
    }

    try {
        $website = !empty($row['website']) ? implode(',', $row['website']) : '';
        $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_customer (note, first_name, last_name, main_phone, other_phone, main_email, other_email, birthday, facebook, skype, zalo, website, gender, address, care_staff, image, addtime, userid, is_contacts, type_id) VALUES (:note, :first_name, :last_name, :main_phone, :other_phone, :main_email, :other_email, :birthday, :facebook, :skype, :zalo, :website, :gender, :address, :care_staff, :image, ' . NV_CURRENTTIME . ', 1, :is_contacts, :type_id)';
        $data_insert = array();
        $data_insert['first_name'] = $row['first_name'];
        $data_insert['last_name'] = $row['last_name'];
        $data_insert['main_phone'] = $row['main_phone'];
        $data_insert['other_phone'] = $row['other_phone'];
        $data_insert['main_email'] = $row['main_email'];
        $data_insert['other_email'] = $row['other_email'];
        $data_insert['birthday'] = $row['birthday'];
        $data_insert['facebook'] = $row['facebook'];
        $data_insert['skype'] = $row['skype'];
        $data_insert['zalo'] = $row['zalo'];
        $data_insert['website'] = $website;
        $data_insert['gender'] = $row['gender'];
        $data_insert['address'] = $row['address'];
        $data_insert['care_staff'] = $row['care_staff'];
        $data_insert['image'] = $row['image'];
        $data_insert['note'] = $row['note'];
        $data_insert['is_contacts'] = $row['is_contacts'];
        $data_insert['type_id'] = $row['type_id'];
        $new_id = $db->insert_id($_sql, 'id', $data_insert);
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $e->getMessage()
        ));
    }
    nv_jsonOutput(array(
        'error' => 0,
        'new_id' => $new_id
    ));
});

// update customer
$app->post('/api/customer/update/{id}/', function (Request $request, Response $response, array $args) {
    global $db, $lang_module;
    $id = $request->getAttribute('id');
    $row = array();
    $row['first_name'] = $request->getParam('first_name');
    $row['last_name'] = $request->getParam('last_name');
    $row['main_phone'] = $request->getParam('main_phone');
    $row['other_phone'] = $request->getParam('other_phone');
    $row['other_phone'] = !empty($row['other_phone']) ? implode('|', $row['other_phone']) : '';
    $row['main_email'] = $request->getParam('main_email');
    $row['other_email'] = $request->getParam('other_email');
    $row['other_email'] = !empty($row['other_email']) ? implode('|', $row['other_email']) : '';
    $row['facebook'] = $request->getParam('facebook');
    $row['skype'] = $request->getParam('skype');
    $row['zalo'] = $request->getParam('zalo');
    $row['website'] = $request->getParam('website');
    $row['gender'] = $request->getParam('gender');
    $row['address'] = $request->getParam('address');
    $row['care_staff'] = $request->getParam('care_staff');
    $row['image'] = $request->getParam('image');
    $row['note'] = $request->getParam('note');
    $row['is_contacts'] = $request->getParam('is_contacts');
    $row['type_id'] = $request->getParam('type_id');
    $row['birthday'] = $request->getParam('birthday');

    foreach ($row as $index => $value) {
        if ($value == NULL) {
            $row[$index] = '';
        }
    }

    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $row['birthday'], $m)) {
        $row['birthday'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['birthday'] = 0;
    }

    if (is_file(NV_DOCUMENT_ROOT . $row['image'])) {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/customer/'));
    } else {
        $row['image'] = '';
    }

    if (!empty($row['website'])) {
        foreach ($row['website'] as $index => $url) {
            if (!nv_is_url($url)) {
                unset($row['website'][$index]);
            }
        }
    }

    if (empty($row['first_name'])) {
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $lang_module['error_required_fullname']
        ));
    }

    try {
        $website = !empty($row['website']) ? implode(',', $row['website']) : '';
        $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_customer SET first_name = :first_name, last_name = :last_name, main_phone = :main_phone, other_phone = :other_phone, main_email = :main_email, other_email = :other_email, birthday = :birthday, facebook = :facebook, skype = :skype, zalo = :zalo, website = :website, gender = :gender, address = :address, care_staff = :care_staff, image = :image, edittime=' . NV_CURRENTTIME . ', note = :note, type_id = :type_id WHERE id=' . $id);
        $stmt->bindParam(':first_name', $row['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $row['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':main_phone', $row['main_phone'], PDO::PARAM_STR);
        $stmt->bindParam(':other_phone', $row['other_phone'], PDO::PARAM_STR);
        $stmt->bindParam(':main_email', $row['main_email'], PDO::PARAM_STR);
        $stmt->bindParam(':other_email', $row['other_email'], PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $row['birthday'], PDO::PARAM_INT);
        $stmt->bindParam(':facebook', $row['facebook'], PDO::PARAM_STR);
        $stmt->bindParam(':skype', $row['skype'], PDO::PARAM_STR);
        $stmt->bindParam(':zalo', $row['zalo'], PDO::PARAM_STR);
        $stmt->bindParam(':website', $website, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $row['gender'], PDO::PARAM_INT);
        $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
        $stmt->bindParam(':care_staff', $row['care_staff'], PDO::PARAM_INT);
        $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
        $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
        $stmt->bindParam(':type_id', $row['type_id'], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
        nv_jsonOutput(array(
            'error' => 1,
            'msg' => $e->getMessage()
        ));
    }
    nv_jsonOutput(array(
        'error' => 0
    ));
});

// delete customer
$app->post('/api/customer/delete/{id}/', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');

    require_once NV_ROOTDIR . '/modules/customer/site.functions.php';

    if (nv_customer_delete($id)) {
        nv_jsonOutput(array(
            'error' => 0
        ));
    }
    nv_jsonOutput(array(
        'error' => 1,
        'msg' => $lang_module['error_unknow']
    ));
});

// get all customer
$app->get('/api/customers/', function (Request $request, Response $response, array $args) {
    global $db;
    $customers = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_customer')
        ->fetchAll();
    nv_jsonOutput($customers);
});

// get single customer
$app->get('/api/customer/{id}/', function (Request $request, Response $response, array $args) {
    global $db;
    $id = $request->getAttribute('id');
    $customer = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_customer WHERE id=' . $id)
        ->fetch();
    nv_jsonOutput($customer);
});