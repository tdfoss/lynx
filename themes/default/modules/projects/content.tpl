<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" id="frm-submit" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xs-24 col-sm-18 col-md-19">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="id" value="{ROW.id}" />
                    <input type="hidden" name="redirect" value="{ROW.redirect}" />
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong> <span class="red">(*)</span></label>
                        <div class="col-sm-19 col-md-20">
                            <input class="form-control" type="text" name="title" id="title" value="{ROW.title}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customerid}</strong> <span class="red">(*)</span></label>
                        <div class="col-sm-19 col-md-20">
                            <select name="customerid" id="customerid" class="form-control">
                                <!-- BEGIN: customer -->
                                <option value="{CUSTOMER.id}" selected="selected">{CUSTOMER.fullname}</option>
                                <!-- END: customer -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.workforceid}</strong> <span class="red">(*)</span></label>
                        <div class="col-sm-19 col-md-20">
                            <select class="form-control select2" id="workforceid" name="workforceid[]" multiple="multiple">
                                <option value="0">---{LANG.workforceid_select}---</option>
                                <!-- BEGIN: workforce -->
                                <option value="{WORKFORCE.userid}"{WORKFORCE.selected}>{WORKFORCE.fullname}</option>
                                <!-- END: workforce -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price}</strong></label>
                        <div class="col-sm-19 col-md-20">
                            <input type="text" class="form-control" name="price" value="{ROW.price}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.vat}</strong></label>
                        <div class="col-sm-19 col-md-20">
                            <input type="text" class="form-control" name="vat" value="{ROW.vat}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.content}</strong></label>
                        <div class="col-sm-19 col-md-20">{ROW.content}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.url_code}</strong></label>
                        <div class="col-sm-19 col-md-20">
                            <input type="url" class="form-control" name="url_code" value="{ROW.url_code}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{LANG.files}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.files}</strong></label>
                        <div class="col-sm-19 col-md-20">
                            <div id="view_files" class="m-bottom">
                                <ul>
                                    <!-- BEGIN: view_files -->
                                    <li><span class="pointer">{FILES.basename}</span><em class="fa fa-trash-o pull-right pointer" onclick="$(this).parent().remove();">&nbsp;</em> <input type="hidden" name="files[]" value="{FILES.basename}" /></li>
                                    <!-- END: view_files -->
                                </ul>
                            </div>
                            <div class="m-bottom" id="listfile">
                                <div class="upload_fileupload m-bottom">
                                    <input type="file" name="upload_fileupload[]" value="{FILES.path}" />
                                </div>
                            </div>
                            <button class="btn btn-primary btn-xs" id="addfile">
                                <em class="fa fa-hand-pointer-o">&nbsp;</em>{LANG.files_add}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-24 col-sm-6 col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label"><strong>{LANG.typeid}</strong></label> <select class="form-control" name="type_id">
                            <option value="">---{LANG.typeid}---</option>
                            <!-- BEGIN: select_type_id -->
                            <option value="{TYPEID.key}"{TYPEID.selected}>{TYPEID.title}</option>
                            <!-- END: select_type_id -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><strong>{LANG.begintime}</strong></label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="begintime" value="{ROW.begintime}" id="begintime" autocomplete="off" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="begintime-btn">
                                    <em class="fa fa-calendar fa-fix"> </em>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><strong>{LANG.endtime}</strong></label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="endtime" value="{ROW.endtime}" id="endtime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" autocomplete="off" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="endtime-btn">
                                    <em class="fa fa-calendar fa-fix"> </em>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><strong>{LANG.realtime}</strong></label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="realtime" value="{ROW.realtime}" id="realtime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" autocomplete="off" />
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="realtime-btn">
                                    <em class="fa fa-calendar fa-fix"> </em>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><strong>{LANG.status}</strong></label> <select name="status" class="form-control">
                            <!-- BEGIN: status -->
                            <option value="{STATUS.index}"{STATUS.selected}>{STATUS.value}</option>
                            <!-- END: status -->
                        </select>
                    </div>
                    <!-- BEGIN: sendinfo -->
                    <div class="form-group">
                        <label><input type="checkbox" name="sendinfo" value="1" checked="checked" />{LANG.sendinfo_note}</label>
                    </div>
                    <!-- END: sendinfo -->
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center">
        <input type="hidden" name="submit" value="1" />
        <input class="btn btn-primary" type="submit" value="{LANG.save}" />
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
    //<![CDATA[
    
    $(document).ready(function() {
        $(".select2").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
        });
        
        $("#customerid").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
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
    
    $("#begintime,#endtime,#realtime").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        showOn : "focus",
        yearRange : "-90:+5",
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
