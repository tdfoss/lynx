<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<div class="well">
    <form action="{NV_BASE_SITEURL}index.php" method="get">
        <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
        <div class="row">
            <div class="col-xs-24 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <select class="form-control select2" name="workforceid">
                    <option value="0">{LANG.workforceid_select}</option>
                    <!-- BEGIN: user -->
                    <option value="{USER.userid}"{USER.selected}>{USER.fullname}</option>
                    <!-- END: user -->
                </select>
            </div>
            <div class="col-xs-12 col-md-4">
                <select class="form-control" name="customerid" id="customerid">
                    <option value="0">{LANG.customerid_select}</option>
                    <!-- BEGIN: customerid -->
                    <option value="{CUSTOMER.id}" selected="selected">{CUSTOMER.fullname}</option>
                    <!-- END: customerid -->
                </select>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group ">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control datepicker" value="{SEARCH.from}" type="text" name="begintime" autocomplete="off" placeholder="{LANG.begintime_holder}" /> <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control datepicker" value="{SEARCH.from}" type="text" name="endtime" autocomplete="off" placeholder="{LANG.endtime_holder}" /> <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control datepicker" value="{SEARCH.from}" type="text" name="realtime" autocomplete="off" placeholder="{LANG.realtime_holder}" /> <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <select class="form-control form-group" name="status">
                    <option value="0">-- {LANG.status_select}--</option>
                    <!-- BEGIN: status -->
                    <option value="{STATUS.index}"{STATUS.selected}>{STATUS.value}</option>
                    <!-- END: status -->
                </select>
            </div>
            <div class="col-xs-12 col-md-2 ">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
                </div>
            </div>
        </div>
    </form>
</div>
<form class="form-inline m-bottom">
    <select class="form-control" id="action-top">
        <!-- BEGIN: action_top -->
        <option value="{ACTION.key}">{ACTION.value}</option>
        <!-- END: action_top -->
    </select>
    <button class="btn btn-primary" onclick="nv_list_action( $('#action-top').val(), '{BASE_URL}', '{LANG.error_empty_data}' ); return false;">{LANG.perform}</button>
    <a class="btn btn-primary" href="{ADD_URL}">{LANG.project_add}</a>
    <a href="{DOWNLOAD_URL}" target="_blank" class="btn btn-primary <!-- BEGIN: btn_disabled -->disabled<!-- END: btn_disabled -->"><em class="fa fa-save">&nbsp;</em>{LANG.task_export} </a>
</form>
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-middle">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);"></th>
                    <th>{LANG.title}</th>
                    <th width="200">{LANG.customerid}</th>
                    <th width="110" class="text-center">{LANG.begintime}</th>
                    <th width="110" class="text-center">{LANG.endtime}</th>
                    <th width="110" class="text-center">{LANG.realtime}</th>
                    <th width="130">{LANG.status}</th>
                    <th width="70">&nbsp;</th>
                </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="text-center" colspan="9">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr onclick="nv_table_row_click(event, '{VIEW.link_view}', false);" class="pointer">
                    <td class="text-center"><input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.id}" name="idcheck[]" class="post"></td>
                    <td><strong>{VIEW.title}</strong> <!-- BEGIN: files --> <em class="fa fa-paperclip pull-right">&nbsp;</em> <!-- END: files -->
                    <span class="help-block">{VIEW.performer_str}</span>
                    </td>
                    <td><a href="{VIEW.customer.link}">{VIEW.customer.fullname}</a></td>
                    <td class="text-center">{VIEW.begintime}</td>
                    <td class="text-center">{VIEW.endtime}</td>
                    <td class="text-center">{VIEW.realtime}</td>
                    <td>{VIEW.status}</td>
                    <td class="text-center form-tooltip"><a href="{VIEW.link_edit}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="{LANG.edit}"><i class="fa fa-edit"></i></a> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="{LANG.delete}"><em class="fa fa-trash-o"></em></a></td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<form class="form-inline m-bottom">
    <select class="form-control" id="action-bottom">
        <!-- BEGIN: action_bottom -->
        <option value="{ACTION.key}">{ACTION.value}</option>
        <!-- END: action_bottom -->
    </select>
    <button class="btn btn-primary" onclick="nv_list_action( $('#action-bottom').val(), '{BASE_URL}', '{LANG.error_empty_data}' ); return false;">{LANG.perform}</button>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script>
    $(".datepicker").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : !0,
        changeYear : !0,
        showOtherMonths : !0,
        showOn : "focus",
        yearRange : "-90:+0"
    });
    
    $('.select2').select2({
        language : '{NV_LANG_INTERFACE}',
        theme : 'bootstrap'
    });
</script>
<script type="text/javascript">
    //<![CDATA[
    
    var confirm_confirm_payment = '{LANG.confirm_confirm_payment}';
    var list_error = '{LANG.error_unknow}';
    
    $(document).ready(function() {
        $(".select2").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
        });
        
        $("#customerid").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
            placeholder : "{LANG.customerid_select}",
            ajax : {
                url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&get_user_json=1',
                dataType : 'json',
                delay : 250,
                data : function(params) {
                    return {
                        q : params.term, // search term
                        page : params.page
                    };
                },
                processResults : function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results : data,
                        pagination : {
                            more : (params.page * 30) < data.total_count
                        }
                    };
                },
                cache : true
            },
            escapeMarkup : function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength : 1,
            templateResult : formatRepo, // omitted for brevity, see the source of this page
            templateSelection : formatRepoSelection
        // omitted for brevity, see the source of this page
        });
    });
    
    function formatRepo(repo) {
        if (repo.loading)
            return repo.text;
        var markup = '<div class="clearfix">' + '<div class="col-sm-19">' + repo.fullname + '</div>' + '<div clas="col-sm-5"><span class="show text-right">' + repo.phone + '</span></div>' + '</div>';
        markup += '</div></div>';
        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.fullname || repo.text;
    }

    //]]>
</script>
<!-- END: main -->