/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1 - 31 - 2010 5 : 12
 */

$(function() {
    $('#notification-box').slimScroll({
        height : '300px'
    });
    
    $('#readall').click(function(e) {
        e.stopPropagation();
        var module = $(this).data('module');
        var readallok = $(this).data('readallok');
        $.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + module + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'readall=1', function(res) {
            $('.notification-list .item').each(function() {
                $(this).removeClass('view');
            });
            $('#notification-number').html('0');
            alert(readallok);
        });
    });
});

function nv_viewitem($_this) {
    var url = $_this.data('item-url');
    if ($_this.data('view') == 0) {
        var id = $_this.data('item-id');
        var module = $_this.data('item-module');
        $_this.removeClass('view');
        $.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + module + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'change_view=1&item_id=' + id, function(res) {
            window.location.href = url;
        });
    } else {
        window.location.href = url;
    }
    return false;
}