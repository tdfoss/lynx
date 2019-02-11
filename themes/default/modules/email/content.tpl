<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="redirect" value="{ROW.redirect}" />
    <div class="panel panel-default">
        <div class="panel-body">
            <input type="hidden" name="id" value="{ROW.id}" />
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
                </div>
            </div>
            <div class="form-group" id="customer">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.sendto}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">
                    <select name="sendto_id[]" id="selectid" class="form-control" multiple="multiple">
                        <!-- BEGIN: customer -->
                        <option value="{CUSTOMER.customerid}" selected="selected">{CUSTOMER.fullname}</option>
                        <!-- END: customer -->
                    </select> <span class="help-block pointer" id="email_cc" style="margin-bottom: 0">{LANG.sendcc}</span>
                </div>
            </div>
            <div class="form-group" id="cc" style="display: none">
                <label class="col-sm-5 col-md-4 control-label"><strong>Cc</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2" name="cc_id[]" multiple="multiple" style="width: 100%">
                        <!-- BEGIN: user -->
                        <option value="{USER.userid}"{USER.selected}>{USER.fullname}</option>
                        <!-- END: user -->
                    </select>
                </div>
            </div>
            <div class="form-group" id="content">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.content}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">{ROW.content}</div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.files}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input type="file" name="upload_fileupload" id="upload_fileupload" style="display: none" /> <input type="text" class="form-control" id="file_name" disabled> <span class="input-group-btn">
                            <button class="btn btn-default" onclick="$('#upload_fileupload').click();" type="button">
                                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em> {LANG.file_selectfile}
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.send_my_cc}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <label><input type="checkbox" name="send_my_cc" value="1" {ROW.send_my_cc_checked} />{LANG.send_my_cc_note}</label>
                </div>
            </div>
            <div class="form-group text-center">
                <input class="btn btn-warning loading" name="draft" type="submit" value="{LANG.draft}" onclick="subdraft();" /> <input class="btn btn-primary" name="submit" type="submit" id="btn-submit" value="{LANG.save}" />
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {

        $(".select2").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
            tag : true,
        });
        
        $("#selectid").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
            tag : true,
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