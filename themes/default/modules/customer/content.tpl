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
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_types}</strong></label>
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
                <label class="col-sm-5 col-md-4 text-right"><strong>Email</strong></label>
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
                    <input class="form-control datepicker" value="{ROW.birthday}" type="text" name="birthday" autocomplete="off"/> <span class="input-group-btn">
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
                    <label><input type="radio" name="gender" value="{GENDER.index}"{GENDER.checked} >{GENDER.value}</label>
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
                    <input class="form-control" type="text" name="unit" value="{ROW.unit}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>Facebook</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="facebook" value="{ROW.facebook}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>Skype</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="skype" value="{ROW.skype}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>Zalo</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="zalo" value="{ROW.zalo}" />
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
             
            <div class="form-group" id="cc" >
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
                        <!--                         <option value="">---{LANG.care_staff_select}---</option> -->
                        <!-- BEGIN: select_care_staff -->
                        <option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
                        <!-- END: select_care_staff -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
                <div class="col-sm-19 col-md-20">{ROW.note}</div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.customer_invoice}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.trading_person}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="trading_person" value="{ROW.trading_person}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit_name}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="unit_name" value="{ROW.unit_name}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tax_code}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="tax_code" value="{ROW.tax_code}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address_invoice}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="address_invoice" value="{ROW.address_invoice}" />
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center button_fixed_bottom">
        <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
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

    //]]>
</script>
<!-- END: main -->