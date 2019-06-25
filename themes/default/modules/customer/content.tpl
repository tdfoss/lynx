<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" /> <input type="hidden" name="redirect" value="{ROW.redirect}" /> <input type="hidden" name="is_contacts" value="{ROW.is_contacts}" />
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.customer_info}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4"><strong>{LANG.customer_types}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control" name="type_id">
                        <option value="">---{LANG.typeid}---</option>
                        <!-- BEGIN: select_type_id -->
                        <option value="{TYPEID.key}"{TYPEID.selected}>{TYPEID.title}</option>
                        <!-- END: select_type_id -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.fullname}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.last_name}</label> <input class="form-control" type="text" name="last_name" value="{ROW.last_name}" />
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.first_name}</label> <span class="red">(*)</span> <input class="form-control" type="text" name="first_name" value="{ROW.first_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.phone}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.main_phone}</label> <input class="form-control" type="text" name="main_phone" value="{ROW.main_phone}" />
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.other_phone}</label> <select name="other_phone[]" class="form-control select2_tag" multiple="multiple">
                                <!-- BEGIN: other_phone -->
                                <option value="{OTHER_PHONE}" selected="selected">{OTHER_PHONE}</option>
                                <!-- END: other_phone -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.email}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.main_email}</label> <input class="form-control" type="email" name="main_email" value="{ROW.main_email}" />
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <label>{LANG.other_email}</label> <select name="other_email[]" class="form-control select2_tag" multiple="multiple">
                                <!-- BEGIN: other_email -->
                                <option value="{OTHER_EMAIL}" selected="selected">{OTHER_EMAIL}</option>
                                <!-- END: other_email -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.birthday}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control datepicker" value="{ROW.birthday}" type="text" name="birthday" autocomplete="off" /> <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <em class="fa fa-calendar fa-fix">&nbsp;</em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.gender}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <!-- BEGIN: gender -->
                    <label><input type="radio" name="gender" value="{GENDER.index}"{GENDER.checked} >{GENDER.value}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <!-- END: gender -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="address" value="{ROW.address}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2_tag" name="unit" style="width: 100%">
                        <option value="">---{LANG.choice_units}---</option>
                        <!-- BEGIN: units -->
                        <option value="{UNITS.key}"{UNITS.selected}>{UNITS.title}</option>
                        <!-- END: units -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.social}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-24 col-sm-12 col-md-8">
                            <input class="form-control" type="text" name="facebook" value="{ROW.facebook}" placeholder="{LANG.facebook}" />
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-8">
                            <input class="form-control" type="text" name="skype" value="{ROW.skype}" placeholder="{LANG.skype}" />
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-8">
                            <input class="form-control" type="text" name="zalo" value="{ROW.zalo}" placeholder="{LANG.zalo}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>Website</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2_tag" name="website[]" multiple="multiple" style="width: 100%">
                        <!-- BEGIN: website -->
                        <option value="{WEBSITE}" selected="selected">{WEBSITE}</option>
                        <!-- END: website -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.image}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control" type="text" name="image" value="{ROW.image}" id="id_image" /> <span class="input-group-btn">
                            <button class="btn btn-default selectfile" type="button">
                                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group" id="cc">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tags}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2_tag" name="tag_id[]" multiple="multiple" style="width: 100%">
                        <!-- BEGIN: tags -->
                        <option value="{TAGS.key}"{TAGS.selected}>{TAGS.title}</option>
                        <!-- END: tags -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.care_staff}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2" name="care_staff">
                        <!-- BEGIN: select_care_staff -->
                        <option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
                        <!-- END: select_care_staff -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.share}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <select class="form-control select2" name="share_acc[]" multiple="multiple" style="width: 100%">
                                <!-- BEGIN: share_account -->
                                <option value="{SHAREWF.key}"{SHAREWF.selected}>{SHAREWF.title}</option>
                                <!-- END: share_account -->
                            </select>
                        </div>
                        <div class="col-xs-24 col-sm-12 col-md-12">
                            <select class="form-control" name="share_groups">
                                <option value="0">--- {LANG.share_groups} ---</option>
                                <!-- BEGIN: share_groups -->
                                <option value="{PART.key}"{PART.selected}>{PART.value}</option>
                                <!-- END: share_groups -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN: field -->
            <!-- BEGIN: loop -->
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"> <strong>{FIELD.title}</strong> <!-- BEGIN: required --> <span class="red">(*)</span> <!-- END: required -->
                </label>
                <div class="col-sm-19 col-md-20">
                    <!-- BEGIN: textbox -->
                    <input class="form-control {FIELD.required}" type="text" name="custom_fields[{FIELD.field}]" id="{FIELD.field}" value="{FIELD.value}" />
                    <!-- END: textbox -->
                    <!-- BEGIN: date -->
                    <div class="input-group">
                        <input class="form-control datepicker {FIELD.required}" id="{FIELD.field}" type="text" name="custom_fields[{FIELD.field}]" value="{FIELD.value}" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /> <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <em class="fa fa-calendar fa-fix"> </em>
                            </button>
                        </span>
                    </div>
                    <!-- END: date -->
                    <!-- BEGIN: textarea -->
                    <textarea rows="5" cols="70" class="form-control" id="{FIELD.field}" name="custom_fields[{FIELD.field}]">{FIELD.value}</textarea>
                    <!-- END: textarea -->
                    <!-- BEGIN: editor -->
                    {EDITOR}
                    <!-- END: editor -->
                    <!-- BEGIN: select -->
                    <select class="form-control" id="{FIELD.field}" name="custom_fields[{FIELD.field}]">
                        <!-- BEGIN: loop -->
                        <option value="{FIELD_CHOICES.key}"{FIELD_CHOICES.selected}>{FIELD_CHOICES.value}</option>
                        <!-- END: loop -->
                    </select>
                    <!-- END: loopselect -->
                    <!-- BEGIN: radio -->
                    <label for="lb_{FIELD_CHOICES.id}"> <input type="radio" name="custom_fields[{FIELD.field}]" value="{FIELD_CHOICES.key}" id="lb_{FIELD_CHOICES.id}"{FIELD_CHOICES.checked}> {FIELD_CHOICES.value}
                    </label>
                    <!-- END: radio -->
                    <!-- BEGIN: checkbox -->
                    <label for="lb_{FIELD_CHOICES.id}"> <input type="checkbox" name="custom_fields[{FIELD.field}][]" value="{FIELD_CHOICES.key}" id="lb_{FIELD_CHOICES.id}"{FIELD_CHOICES.checked}> {FIELD_CHOICES.value}
                    </label>
                    <!-- END: checkbox -->
                    <!-- BEGIN: multiselect -->
                    <select class="form-control" id="{FIELD.field}" name="custom_fields[{FIELD.field}][]" multiple="multiple">
                        <!-- BEGIN: loop -->
                        <option value="{FIELD_CHOICES.key}"{FIELD_CHOICES.selected}>{FIELD_CHOICES.value}</option>
                        <!-- END: loop -->
                    </select>
                    <!-- END: multiselect -->
                    <small class="help-block"><em>{FIELD.description}</em></small>
                </div>
            </div>
            <!-- END: loop -->
            <!-- END: field -->
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
                <div class="col-sm-19 col-md-20">{ROW.note}</div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.userid_link}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.userid_link_select}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <!-- BEGIN: userid_link_type -->
                    <label class="m-bottom"><input type="radio" name="userid_link_type" value="{OPTION.key}"{OPTION.checked}>{OPTION.title}</label>&nbsp;&nbsp;&nbsp;
                    <!-- END: userid_link_type -->
                    <div id="select_user"{ROW.userid_link_type_1_style}>
                        <select name="userid_link" id="userid_link" class="form-control">
                            <!-- BEGIN: user -->
                            <option value="{USER.userid}" selected="selected">{USER.fullname}</option>
                            <!-- END: user -->
                        </select>
                    </div>
                    <div id="add_new_user"{ROW.userid_link_type_2_style}>
                        <div class="row">
                            <div class="col-xs-24 col-sm-6 col-md-6">
                                <input type="email" class="form-control required" name="email" placeholder="Email" />
                            </div>
                            <div class="col-xs-24 col-sm-6 col-md-6">
                                <input type="text" class="form-control required" name="username" placeholder="{LANG.username}" />
                            </div>
                            <div class="col-xs-24 col-sm-6 col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="{LANG.password}" />
                            </div>
                            <div class="col-xs-24 col-sm-6 col-md-6">
                                <input type="password" class="form-control" name="password1" placeholder="{LANG.password1}" />
                            </div>
                        </div>
                        <small class="help-block"><em>{LANG.userid_link_note}</em></small> <label><input type="checkbox" name="adduser_email" value="1" {ROW.ck_adduser_email} />{LANG.adduser_email}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center button_fixed_bottom">
        <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /> <a class="cancelLink" href="javascript:history.back()" type="reset">{LANG.cancel}</a>
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $('.select2').select2({
        language : '{NV_LANG_INTERFACE}',
        theme : 'bootstrap'
    });
    
    $('.select2_tag').select2({
        language : '{NV_LANG_INTERFACE}',
        theme : 'bootstrap',
        tags : true
    });
    
    $(".datepicker").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : !0,
        changeYear : !0,
        showOtherMonths : !0,
        showOn : "focus",
        yearRange : "-90:+0"
    });
    
    $(".selectfile").click(function() {
        var area = "id_image";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var type = "image";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
    
    $('input[name="userid_link_type"]').change(function() {
        $('#add_new_user').hide();
        $('#select_user').hide();
        
        if ($(this).val() == 0) {
            //
        }
        
        if ($(this).val() == 1) {
            $('#select_user').show();
        }
        
        if ($(this).val() == 2) {
            $('#add_new_user').show();
            var main_email = $('input[name="main_email"]').val();
            var username = main_email.split('@')[0];
            $('input[name="email"]').val(main_email);
            $('input[name="username"]').val(username);
            
        }
    });
    
    $(document).ready(function() {
        $("#userid_link").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
            placeholder : "{LANG.userid_select}",
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
        var markup = '<div class="clearfix">' + '<div class="col-sm-19">' + repo.fullname + '</div>' + '<div clas="col-sm-5"><span class="show text-right">' + repo.email + '</span></div>' + '</div>';
        markup += '</div></div>';
        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.fullname || repo.text;
    }

    //]]>
</script>
<!-- END: main -->
