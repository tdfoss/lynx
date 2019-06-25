<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="panel panel-default">
        <div class="panel-body">
            <input type="hidden" name="id" value="{ROW.id}" /> <input type="hidden" name="type" value="{ROW.type}" /> <input type="hidden" name="redirect" value="{ROW.redirect}" />
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.money_date}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control datepicker" value="{ROW.date}" type="text" name="date" /> <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <em class="fa fa-calendar fa-fix">&nbsp;</em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.money_value}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control required money format_price" type="text" name="money" value="{ROW.money}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <textarea class="form-control" style="height: 100px;" cols="75" rows="5" name="note">{ROW.note}</textarea>
                </div>
            </div>
            <div class="form-group text-center">
                <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/office_autoNumeric.min.js"></script>
<script src="//unpkg.com/autonumeric"></script>
<script type="text/javascript">
    //<![CDATA[
        new AutoNumeric('.format_price');
    $(".datepicker").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : !0,
        changeYear : !0,
        showOtherMonths : !0,
        showOn : "focus",
        yearRange : "-90:+0"
    });
        
    var Options = {
        digitGroupSeparator : ',',
        decimalCharacter: '.',
        minimumValue: '0',
        maximumValue : '99999999999',
    };
    new AutoNumeric.multiple('.money', { Options });
    //]]>
</script>
<!-- END: main -->