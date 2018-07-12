<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="panel panel-default">
        <div class="panel-body">
            <input type="hidden" name="id" value="{ROW.id}" />
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
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.serviceid}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">
                    <select name="serviceid" class="form-control select2">
                        <!-- BEGIN: services -->
                        <option value="{SERVICE.id}"{SERVICE.selected}>{SERVICE.title}</option>
                        <!-- END: services -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="price" value="{ROW.price}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.month}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="number" name="month" value="{ROW.month}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.begintime}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control" type="text" name="begintime" value="{ROW.begintime}" id="begintime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" autocomplete="off"/> <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="begintime-btn">
                                <em class="fa fa-calendar fa-fix"> </em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.endtime}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control" type="text" name="endtime" value="{ROW.endtime}" id="endtime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" autocomplete="off"/> <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="endtime-btn">
                                <em class="fa fa-calendar fa-fix"> </em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <textarea class="form-control" style="height: 100px;" cols="75" rows="5" name="note">{ROW.note}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center">
        <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
    </div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {
        $("#begintime,#endtime").datepicker({
            dateFormat : "dd/mm/yy",
            changeMonth : true,
            changeYear : true,
            showOtherMonths : true,
            showOn : "focus",
            yearRange : "-90:+5",
        });
        
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