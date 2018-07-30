<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 27 Feb 2018 05:52:30 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_PRODUCTS', true);

function nv_delete_products($id)
{
    global $db, $module_data;

    $weight = 0;
    $sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id =' . $id;
    $result = $db->query($sql);
    list ($weight) = $result->fetch(3);

    $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '  WHERE id = ' . $id);
    if ($weight > 0) {
        $sql = 'SELECT id, weight FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE weight >' . $weight;
        $result = $db->query($sql);
        while (list ($id, $weight) = $result->fetch(3)) {
            $weight--;
            $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $weight . ' WHERE id=' . intval($id));
        }
    }
}