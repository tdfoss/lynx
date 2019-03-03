/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Mon, 26 Feb 2018 03:48:37 GMT
 */

$(document).ready(function() {
    $.fn.addNumber = function() {
        $(this).each(function(index) {
            $(this).html(index + 1);
        });
        return !1;
    };
    
    $('#btn-transaction-add').click(function() {
        $.ajax({
            type : 'POST',
            url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(),
            data : 'transaction_content=1&invoiceid=' + $(this).data('invoiceid'),
            success : function(html) {
                modalShow($('#btn-transaction-add').data('lang-add'), html);
            }
        });
    });
    
    $(".dropdown-hover").hover(function() {
        $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    }, function() {
        $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    });
});

function nv_item_change($this) {
    $.ajax({
        type : 'POST',
        url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&nocache=' + new Date().getTime(),
        data : 'get_item_info=1&module=' + $this.closest('.item').data('module') + '&itemid=' + $this.val() + '&quantity=' + $this.closest('.item').find('.quantity').val(),
        success : function(json) {
            $this.closest('.item').find('.unit_price').val(json.unit_price);
            $this.closest('.item').find('.price').val(json.price);
            $this.closest('.item').find('.vat').val(json.vat);
            $this.closest('.item').find('.total').text(json.total);
            $this.closest('.item').find('.vat_price').val(json.vat_price);
            nv_item_change_input();
        }
    });
}

function nv_item_delete($this) {
    $this.closest('tr').remove(); $('.number').addNumber();
    nv_item_change_input();
}

function nv_item_change_input(){
    $.ajax({
        type : 'POST',
        url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&change_item=1&nocache=' + new Date().getTime(),
        data : $('#frm-submit').serialize(),
        success : function(json) {
            $('#grand_total').text(json.grand_total);
            $('#grand_total_string').text(json.grand_total_string);
            $('#item_total').text(json.item_total);
            $('#vat_total').text(json.vat_total);
            var i = 0;
            $.each(json.detail, function(index, value){
                $('#item-detail .item').eq(i).find('.vat_price').val(value.vat_price);
                $('#item-detail .item').eq(i).find('.total').text(value.total);
                $('#item-detail .item').eq(i).find('.price').val(value.price);
                i++;
            })
        }
    });
}

function nv_list_action(action, url_action, del_confirm_no_post) {
    var listall = [];
    
    $('input.post:checked').each(function() {
        listall.push($(this).val());
    });
    
    if (listall.length < 1) {
        alert(del_confirm_no_post);
        return false;
    }
    
    if (action == 'delete_list_id') {
        var confirm_str = nv_is_del_confirm[0];
        var mod = 'delete_list';
        var error = nv_is_del_confirm[2];
    } else if (action == 'confirm_payment') {
        var confirm_str = confirm_confirm_payment;
        var mod = 'confirm_payment';
        var error = list_error;
    }
    
    if (confirm(confirm_str)) {
        $.ajax({
            type : 'POST',
            url : url_action,
            data : mod + '=1&listall=' + listall,
            success : function(data) {
                var r_split = data.split('_');
                if (r_split[0] == 'OK') {
                    window.location.href = window.location.href;
                } else {
                    alert(error);
                }
            }
        });
    }
    
    return false;
}

function nv_table_row_click(e, t, n) {
    var r = e.target.tagName.toLowerCase(), i = e.target.parentNode.tagName.toLowerCase(), a = e.target.parentNode.parentNode.parentNode;
    return void ("button" != r && "a" != r && "button" != i && "a" != i && "td" != i && (n ? window.open(t) : window.location.href = t))
}

function nv_invoice_sendmail(id) {
    if (confirm(invoice_sendmail_confirm)) {
        $.ajax({
            type : 'POST',
            url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(),
            data : 'sendmail=1&id=' + id,
            success : function(data) {
                var r_split = data.split('_');
                if (r_split[0] == 'OK') {
                    location.reload();
                } else {
                    alert(r_split[1]);
                }
            }
        });
    }
}

function nv_invoice_sendmail_confirm(id) {
    if (confirm(invoice_sendmail_confirm_payment)) {
        $.ajax({
            type : 'POST',
            url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&confirm_payment_id=1&id=' + id,
            success : function(data) {
                var r_split = data.split('_');
                if (r_split[0] == 'OK') {
                    location.reload();
                } else {
                    alert(r_split[1]);
                }
            }
        });
    }
}

function nv_invoice_copy(id) {
    if (confirm(invoice_copy_invoice)) {
        $.ajax({
            type : 'POST',
            url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&copy_id&id=' + id,
            success : function(data) {
                var r_split = data.split('_');
                if (r_split[0] == 'OK') {
                    window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&id=' + r_split[1];
                } else {
                    alert(r_split[1]);
                }
            }
        });
    }
}

function nv_transaction_list(invoiceid) {
    $.ajax({
        type : 'POST',
        url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(),
        data : 'transaction_list=1&invoiceid=' + invoiceid,
        success : function(html) {
            $('#transaction-body').html(html);
        }
    });
}