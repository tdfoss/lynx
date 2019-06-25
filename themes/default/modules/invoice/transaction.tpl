<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<!-- BEGIN: score_customer_note -->
<div class="alert alert-info text-center">{LANG.score_customer_note}</div>
<!-- END: score_customer_note -->
<form id="frm-transaction">
    <input type="hidden" name="id" value="{DATA.id}" /> <input type="hidden" name="invoiceid" value="{DATA.invoiceid}" /> <input type="hidden" name="customerid" value="{INVOICE.customerid}" /> <input type="hidden" name="transaction_update" value="1" />
    <div class="form-group text-center">
        <label class="show">{LANG.transaction_type}</label>
        <!-- BEGIN: type -->
        <label><input type="radio" name="transaction_type" value="{TYPE.index}" {TYPE.selected} />{TYPE.value}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- END: type -->
    </div>
    <div class="form-group">
        <label>{LANG.transaction_amount}</label> <span class="text-danger" id="score_note"></span> <input type="text" class="form-control required" id="amount" name="amount" value="{DATA.amount}">
    </div>
    <div class="form-group">
        <label>{LANG.transaction_time}</label>
        <div class="input-group">
            <input class="form-control datepicker" type="text" name="transaction_time" value="{DATA.transaction_time}" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /> <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <em class="fa fa-calendar fa-fix"> </em>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label>{LANG.note}</label>
        <textarea class="form-control" name="note">{DATA.note}</textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-default">{LANG.transaction_add}</button>
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script>
    $(document).ready(function() {
        $('#frm-transaction').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type : 'POST',
                url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(),
                data : $(this).serialize(),
                success : function(json) {
                    if (json.error) {
                        alert(json.msg);
                        $('#' + json.input).focus();
                        return !1;
                    }
                    window.parent.nv_transaction_list(json.invoiceid);
                    $('#sitemodal').modal('toggle');
                }
            });
        });
        
        $(".datepicker").datepicker({
            dateFormat : "dd/mm/yy",
            changeMonth : true,
            changeYear : true,
            showOtherMonths : true,
            showOn : "focus",
            yearRange : "-90:+5",
        });
        
        $('#amount').change(function() {
            if ($('input[name="transaction_type"]:checked').val() == 2) {
                $.ajax({
                    type : 'POST',
                    url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(),
                    data : 'get_score_info=1&customerid={INVOICE.customerid}&amount=' + $(this).val(),
                    success : function(json) {
                        if (json.error) {
                            alert(json.msg);
                            $('#' + json.input).focus();
                        } else {
                            $('#score_note').html(json.msg);
                        }
                    }
                });
            }
        });
    });
</script>
<!-- END: main -->
<!-- BEGIN: transaction_list -->
<!-- BEGIN: empty -->
<div class="panel-body">
    <div class="text-center">{LANG.transaction_empty}</div>
</div>
<!-- END: empty -->
<!-- BEGIN: data -->
<table class="table table-striped table-bordered table-hover table-middle" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border-collapse: collapse; border-spacing: 0; background-color: transparent; width: 100%; max-width: 100%; margin-bottom: 18px; border-width: 1px; border-style: solid; border-color: #ddd;">
    <thead style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: left;">
        <tr style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <th style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: left; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; vertical-align: bottom; border-bottom-style: solid; border-bottom-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd; border-bottom-width: 2px;" width="200">{LANG.transaction_time}</th>
            <th style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: left; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; vertical-align: bottom; border-bottom-style: solid; border-bottom-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd; border-bottom-width: 2px;" width="200">{LANG.transaction_status}</th>
            <th style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: left; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; vertical-align: bottom; border-bottom-style: solid; border-bottom-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd; border-bottom-width: 2px;" width="200">{LANG.transaction_amount}</th>
            <th style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: left; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; vertical-align: bottom; border-bottom-style: solid; border-bottom-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd; border-bottom-width: 2px;">{LANG.note}</th>
        </tr>
    </thead>
    <tbody style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
        <!-- BEGIN: loop -->
        <tr style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <td style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;">{DATA.transaction_time}</td>
            <td style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;">{DATA.transaction_status}</td>
            <td style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;">{DATA.payment_amount}</td>
            <td style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;">{DATA.note}</td>
        </tr>
        <!-- END: loop -->
    </tbody>
    <tfoot style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
        <tr style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <td colspan="2" align="right" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: right; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;"><strong style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-weight: bold;"><strong>{LANG.total}</strong></td>
            <td colspan="2" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;"><strong>{TOTAL}</strong></td>
        </tr>
        <tr style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <td colspan="2" align="right" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; text-align: right; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;"><strong style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-weight: bold;"><strong>{LANG.rest}</strong></td>
            <td colspan="2" style="-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; padding-top: 8px; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; line-height: 1.42857143; vertical-align: top; border-top-width: 1px; border-top-style: solid; border-top-color: #ddd; border-width: 1px; border-style: solid; border-color: #ddd;"><strong>{REST}</strong></td>
        </tr>
    </tfoot>
</table>
<!-- END: data -->
<!-- END: transaction_list -->
