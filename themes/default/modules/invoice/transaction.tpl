<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<form id="frm-transaction" style="width: 350px">
    <input type="hidden" name="id" value="{DATA.id}" /> <input type="hidden" name="invoiceid" value="{DATA.invoiceid}" /> <input type="hidden" name="transaction_update" value="1" />
    <div class="form-group">
        <label>{LANG.transaction_amount}</label> <input type="text" class="form-control required" id="amount" name="amount" value="{DATA.amount}">
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
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="200">{LANG.transaction_time}</th>
            <th width="200">{LANG.transaction_status}</th>
            <th width="200">{LANG.transaction_amount}</th>
            <th>{LANG.note}</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: loop -->
        <tr>
            <td>{DATA.transaction_time}</td>
            <td>{DATA.transaction_status}</td>
            <td>{DATA.payment_amount}</td>
            <td>{DATA.note}</td>
        </tr>
        <!-- END: loop -->
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align="right"><strong>{LANG.total}</strong></td>
            <td colspan="2"><strong>{TOTAL}</strong></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><strong>{LANG.rest}</strong></td>
            <td colspan="2"><strong>{REST}</strong></td>
        </tr>
    </tfoot>
</table>
<!-- END: data -->
<!-- END: transaction_list -->