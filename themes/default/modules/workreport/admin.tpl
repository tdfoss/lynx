<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<div class="well">
    <form action="{ACTION}" method="get">
        <!-- BEGIN: no_rewrite -->
        <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
        <!-- END: no_rewrite -->
        <div class="row">
            <div class="col-xs-24 col-md-6">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control datepicker" value="{TIME}" type="text" name="time" readonly="readonly" placeholder="{LANG.filter_to}" /> <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <em class="fa fa-calendar fa-fix">&nbsp;</em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
                </div>
            </div>
        </div>
    </form>
</div>
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="200">{LANG.performer}</th>
                    <th width="150">{LANG.addtime}</th>
                    <th width="200">{LANG.time}</th>
                    <th>{LANG.content}</th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: user -->
                <tr>
                    <td>{USER.fullname}</td>
                    <td>{USER.addtime}</td>
                    <td>{USER.time}</td>
                    <td>{USER.content}</td>
                </tr>
                <!-- END: user -->
            </tbody>
        </table>
    </div>
</form>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(".datepicker").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        showOn : "focus",
        yearRange : "-90:+5",
    });

    //]]>
</script>
<!-- END: main -->