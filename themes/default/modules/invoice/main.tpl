<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<div class="well">
    <form action="{NV_BASE_SITEURL}index.php" method="get">
        <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" /> <input type="hidden" name="search" value="1" /> <input type="hidden" name="serviceid" value="{SEARCH.serviceid}" />
        <div class="row">
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <input class="form-control" type="text" value="{SEARCH.q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
                </div>
            </div>
            <!-- BEGIN: admin -->
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <select name="customerid" id="customerid" class="form-control">
                        <!-- BEGIN: customer -->
                        <option value="{CUSTOMER.id}" selected="selected">{CUSTOMER.fullname}</option>
                        <!-- END: customer -->
                    </select>
                </div>
            </div>
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <select class="form-control select2" name="workforceid">
                        <option value="0">---{LANG.workforceid_select}---</option>
                        <!-- BEGIN: user -->
                        <option value="{USER.userid}"{USER.selected}>{USER.fullname}</option>
                        <!-- END: user -->
                    </select>
                </div>
            </div>
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <select class="form-control select2" name="presenterid">
                        <option value="0">---{LANG.presenterid_select}---</option>
                        <!-- BEGIN: user1 -->
                        <option value="{USER.userid}"{USER.selected1}>{USER.fullname}</option>
                        <!-- END: user1 -->
                    </select>
                </div>
            </div>
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <select class="form-control select2" name="performerid">
                        <option value="0">---{LANG.performerid_select}---</option>
                        <!-- BEGIN: user2 -->
                        <option value="{USER.userid}"{USER.selected2}>{USER.fullname}</option>
                        <!-- END: user2 -->
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-5">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" value="{SEARCH.daterange}" type="text" name="daterange" autocomplete="off" placeholder="{LANG.choice_time}" /><span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <em class="fa fa-calendar fa-fix">&nbsp;</em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <!-- END: admin -->
            <div class="col-xs-24 col-md-3">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="-1">---{LANG.status_select}---</option>
                        <!-- BEGIN: status -->
                        <option value="{STATUS.index}"{STATUS.selected}>{STATUS.value}</option>
                        <!-- END: status -->
                    </select>
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
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-left">{LANG.list_date_invoice}</span>
        <div class="pull-right">
            <div class="col-sm-19 col-md-24">
                <select class="form-control invoice_list input-sm" name="invoice_list" id="list_invoice">
                    <!-- BEGIN: select_time -->
                    <option value="{TIME.key}"{TIME.selected}>{TIME.title}</option>
                    <!-- END: select_time -->
                </select>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="100">{LANG.code}</th>
                            <th>{LANG.title}</th>
                            <th>{LANG.customerid}</th>
                            <th>{LANG.createtime}</th>
                            <th>{LANG.duetime}</th>
                            <th width="150">{LANG.addtime}</th>
                            <th>{LANG.grand_total}</th>
                            <th>{LANG.status}</th>
                        </tr>
                    </thead>
                    <!-- BEGIN: generate_page -->
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="10">{NV_GENERATE_PAGE}</td>
                        </tr>
                    </tfoot>
                    <!-- END: generate_page -->
                    <tbody id="tbody">
                        <!-- BEGIN: empty_data_invoice -->
                        <td colspan="8" class="text-center">{LANG.empty_data_invoice}</td>
                        <!-- END: empty_data_invoice -->
                        {DATA_INVOICE}
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<!-- BEGIN: admin2 -->
<form class="form-inline m-bottom">
    <select class="form-control" id="action-top">
        <!-- BEGIN: action_top -->
        <option value="{ACTION.key}">{ACTION.value}</option>
        <!-- END: action_top -->
    </select>
    <button class="btn btn-primary" onclick="nv_list_action( $('#action-top').val(), '{BASE_URL}', '{LANG.error_empty_data}' ); return false;">{LANG.perform}</button>
    <a class="btn btn-primary" href="{URL_ADD}">{LANG.add}</a>
</form>
<!-- END: admin2 -->
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="50"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);"></th>
                    <th width="100">{LANG.code}</th>
                    <th>{LANG.title}</th>
                    <th>{LANG.customerid}</th>
                    <th>{LANG.createtime}</th>
                    <th>{LANG.duetime}</th>
                    <th width="150">{LANG.addtime}</th>
                    <th>{LANG.grand_total}</th>
                    <th>{LANG.status}</th>
                    <!-- BEGIN: admin4 -->
                    <th width="150">&nbsp;</th>
                    <!-- END: admin4 -->
                </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="text-center" colspan="10">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr onclick="nv_table_row_click(event, '{VIEW.link_view}', false);" class="pointer <!-- BEGIN: warning -->warning<!-- END: warning --> <!-- BEGIN: danger -->danger<!-- END: danger --> <!-- BEGIN: success -->success<!-- END: success -->">
                    <td class="text-center">
                        <input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.id}" name="idcheck[]" class="post">
                    </td>
                    <td>#{VIEW.code}</td>
                    <td>{VIEW.title}</td>
                    <td>
                        <a href="{VIEW.customer.link}">{VIEW.customer.fullname}</a>
                    </td>
                    <td>{VIEW.createtime}</td>
                    <td>{VIEW.duetime}</td>
                    <td>{VIEW.addtime}</td>
                    <td>{VIEW.grand_total}</td>
                    <td>{VIEW.status_str}</td>
                    <!-- BEGIN: admin3 -->
                    <td class="text-center">
                        <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a>
                    </td>
                    <!-- END: admin3 -->
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- BEGIN: admin1 -->
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
$(function() {

  $('input[name="daterange"]').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: true,
      opens: "center",
      locale: {
          cancelLabel: 'Clear',
          format: 'DD/MM/YYYY',
          separator: " - ",
          applyLabel: "{LANG.applyLabel}",
          cancelLabel: "{LANG.cancelLabel}",
          fromLabel: "{LANG.fromLabel}",
          toLabel: "{LANG.toLabel}",
          customRangeLabel: "Custom",
          daysOfWeek: [
              "{LANG_GLOBAL.sun}",
              "{LANG_GLOBAL.mon}",
              "{LANG_GLOBAL.tue}",
              "{LANG_GLOBAL.wed}",
              "{LANG_GLOBAL.thu}",
              "{LANG_GLOBAL.fri}",
              "{LANG_GLOBAL.sat}"  
              ],
          monthNames: [
              "{LANG_GLOBAL.january}",
              "{LANG_GLOBAL.february}",
              "{LANG_GLOBAL.march}",
              "{LANG_GLOBAL.april}",
              "{LANG_GLOBAL.may}",
              "{LANG_GLOBAL.june}",
              "{LANG_GLOBAL.july}",
              "{LANG_GLOBAL.august}",
              "{LANG_GLOBAL.september}",
              "{LANG_GLOBAL.october}",
              "{LANG_GLOBAL.december}"  
              ]   
      }
  });

 

  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
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

    $('#list_invoice').change(function(){      
        var date = $('#list_invoice').val();
        $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'get_info_invoice_json=1&date=' + date, function(json) {            
            $("#tbody").empty();
            $("#tbody").append(json);
         
        });
    });

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
<!-- END: admin1 -->
<!-- END: main -->
<!-- BEGIN: list -->
<!-- BEGIN: list_invoice -->
<tr onclick="nv_table_row_click(event, '{VIEW.link_view}', false);" class="pointer <!-- BEGIN: warning -->warning<!-- END: warning --> <!-- BEGIN: danger -->danger<!-- END: danger --> <!-- BEGIN: success -->success<!-- END: success -->">
    <td>#{LIST.code}</td>
    <td>{LIST.title}</td>
    <td>
        <a href="{LIST.customer.link}">{LIST.customer.fullname}</a>
    </td>
    <td>{LIST.createtime}</td>
    <td>{LIST.duetime}</td>
    <td>{LIST.addtime}</td>
    <td>{LIST.grand_total}</td>
    <td>{LIST.status_str}</td>
</tr>
<!-- END: list_invoice -->
<!-- BEGIN: empty_list_invoice -->
<tr>
    <td colspan="8" class="text-center">{LANG.empty_data_invoice}</td>
</tr>
<!-- END: empty_list_invoice -->
<!-- END: list -->