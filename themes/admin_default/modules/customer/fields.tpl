<!-- BEGIN: main -->
<!-- BEGIN: data -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="text-center">
                <th class="w100">{LANG.weight}</th>
                <th class="w150">{LANG.field_id}</th>
                <th>{LANG.field_title}</th>
                <th class="w200">{LANG.field_type}</th>
                <th class="text-center w100">{LANG.field_required_s}</th>
                <th class="text-center w100">{LANG.field_show_profile_s}</th>
                <th class="text-center w150"></th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td class="text-center">
                    <select class="form-control" id="id_weight_{ROW.fid}" onchange="nv_chang_field({ROW.fid});">
                        <!-- BEGIN: weight -->
                        <option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
                        <!-- END: weight -->
                    </select>
                </td>
                <td>{ROW.field}</td>
                <td>{ROW.field_lang}</td>
                <td>{ROW.field_type}</td>
                <td class="text-center">
                    <input type="checkbox" onclick="nv_change_status({ROW.fid}, 'required');" id="change_status_required_{ROW.fid}" {ROW.required}/>
                </td>
                <td class="text-center">
                    <input type="checkbox" onclick="nv_change_status({ROW.fid}, 'show_profile');" id="change_status_show_profile_{ROW.fid}" {ROW.show_profile}/>
                </td>
                <td class="text-center">
                    <em class="fa fa-edit fa-lg">&nbsp;</em> <a href="javascript:void(0);" onclick="nv_edit_field({ROW.fid});">{LANG.field_edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="javascript:void(0);" onclick="nv_del_field({ROW.fid})">{LANG.delete}</a>
                </td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: data -->
<!-- BEGIN: load -->
<div id="module_show_list">&nbsp;</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.validator-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-danger">{ERROR}</div>
<!-- END: error -->
<form action="{FORM_ACTION}" method="post" id="ffields" autocomplete="off">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{CAPTIONFORM}
            </caption>
            <colgroup>
                <col class="w250" />
                <col />
            </colgroup>
            <tbody>
                <!-- BEGIN: field -->
                <tr>
                    <td>{LANG.field_id}:</td>
                    <td>
                        <input class="form-control" type="text" value="{DATAFORM.field}" name="field"{DATAFORM.fielddisabled}><span class="help-block">{LANG.field_id_note}</span>
                    </td>
                </tr>
                <!-- END: field -->
                <tr>
                    <td>{LANG.field_title}</td>
                    <td>
                        <input class="form-control required" type="text" value="{DATAFORM.title}" name="title">
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_description}:</td>
                    <td>
                        <textarea cols="60" rows="3" name="description" class="form-control">{DATAFORM.description}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_required}</td>
                    <td>
                        <input name="required" value="1" type="checkbox"{DATAFORM.required}> {LANG.field_required_note}
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_show_profile}</td>
                    <td>
                        <input name="show_profile" value="1" type="checkbox"{DATAFORM.show_profile}>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_type}:</td>
                    <td>
                        <!-- BEGIN: field_type -->
                        <ul style="list-style: none; padding: 0">
                            <!-- BEGIN: loop -->
                            <li><label for="f_{FIELD_TYPE.key}"> <input type="radio" {FIELD_TYPE.checked} id="f_{FIELD_TYPE.key}" value="{FIELD_TYPE.key}" name="field_type"> {FIELD_TYPE.value}
                            </label></li>
                            <!-- END: loop -->
                        </ul>
                        {LANG.field_type_note}
                        <!-- END: field_type -->
                        {FIELD_TYPE_TEXT}
                    </td>
                </tr>
                <tr id="classfields"{DATAFORM.classdisabled}>
                    <td>{LANG.field_class}</td>
                    <td>
                        <input class="form-control validalphanumeric" type="text" value="{DATAFORM.class}" name="class" maxlength="50">
                    </td>
                </tr>
                <tr id="editorfields"{DATAFORM.editordisabled}>
                    <td>{LANG.field_size}</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" value="{DATAFORM.editor_width}" name="editor_width" maxlength="5" placeholder="{LANG.field_width}">
                            </div>
                            <div class="col-xs-12">
                                <input class="form-control" type="text" value="{DATAFORM.editor_height}" name="editor_height" maxlength="5" placeholder="{LANG.field_height}">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover" id="textfields"{DATAFORM.display_textfields}>
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{LANG.field_options_text}
            </caption>
            <colgroup>
                <col class="w250" />
                <col />
            </colgroup>
            <tbody>
                <tr>
                    <td>{LANG.field_match_type}</td>
                    <td>
                        <ul style="list-style: none; padding: 0" class="form-inline">
                            <!-- BEGIN: match_type -->
                            <li id="li_{MATCH_TYPE.key}"><label for="m_{MATCH_TYPE.key}"> <input type="radio" {MATCH_TYPE.checked} id="m_{MATCH_TYPE.key}" value="{MATCH_TYPE.key}" name="match_type"> {MATCH_TYPE.value}
                            </label> <!-- BEGIN: match_input --> <input class="form-control" type="text" value="{MATCH_TYPE.match_value}" name="match_{MATCH_TYPE.key}"{MATCH_TYPE.match_disabled}> <!-- END: match_input --></li>
                            <!-- END: match_type -->
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_default_value}:</td>
                    <td>
                        <input class="form-control" maxlength="255" type="text" value="{DATAFORM.default_value}" name="default_value">
                    </td>
                </tr>
                <tr id="max_length">
                    <td>{LANG.field_length}</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-3 text-right">
                                <span class="text-middle">{LANG.field_length_min}</span>
                            </div>
                            <div class="col-xs-9">
                                <input class="form-control number" type="number" value="{DATAFORM.min_length}" name="min_length" placeholder="{LANG.field_length_min}">
                            </div>
                            <div class="col-xs-3 text-right">
                                <span class="text-middle">{LANG.field_length_max}</span>
                            </div>
                            <div class="col-xs-9">
                                <input class="form-control number" type="number" value="{DATAFORM.max_length}" name="max_length" placeholder="{LANG.field_length_max}" />
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover" id="numberfields"{DATAFORM.display_numberfields}>
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{LANG.field_options_number}
            </caption>
            <colgroup>
                <col class="w250" />
                <col />
            </colgroup>
            <tbody>
                <tr>
                    <td>{LANG.field_number_type}</td>
                    <td>
                        <label><input type="radio" value="1" name="number_type"{DATAFORM.number_type_1}>{LANG.field_integer}</label>&nbsp; <label><input type="radio" value="2" name="number_type"{DATAFORM.number_type_2}> {LANG.field_real}</label>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_default_value}</td>
                    <td>
                        <input class="form-control required number" maxlength="255" type="number" value="{DATAFORM.default_value_number}" name="default_value_number">
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_value}</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control required number" type="text" value="{DATAFORM.min_number}" name="min_number_length" maxlength="11" placeholder="{LANG.field_value_min}">
                            </div>
                            <div class="col-xs-12">
                                <input class="form-control required number" type="text" value="{DATAFORM.max_number}" name="max_number_length" maxlength="11" placeholder="{LANG.field_value_max}">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover" id="datefields"{DATAFORM.display_datefields}>
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{LANG.field_options_date}
            </caption>
            <colgroup>
                <col class="w250" />
                <col />
            </colgroup>
            <tbody>
                <tr>
                    <td>{LANG.field_default_value}:</td>
                    <td>
                        <label><input type="radio" value="1" name="current_date"{DATAFORM.current_date_1}> {LANG.field_current_date}</label>&nbsp; <label><input type="radio" value="0" name="current_date"{DATAFORM.current_date_0}> {LANG.field_default_date}</label>&nbsp;
                        <div class="input-group">
                            <input class="date form-control datepicker" type="text" value="{DATAFORM.default_date}" name="default_date"> <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                </button>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.field_date}:</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <input class="form-control datepicker required" type="text" value="{DATAFORM.min_date}" name="min_date" maxlength="10" placeholder="{LANG.field_date_min}"> <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <input class="form-control datepicker required" type="text" value="{DATAFORM.max_date}" name="max_date" maxlength="10" placeholder="{LANG.field_date_max}"> <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <em class="fa fa-calendar fa-fix">&nbsp;</em>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover" id="choicetypes"{DATAFORM.display_choicetypes} >
            <colgroup>
                <col class="w250" />
                <col />
            </colgroup>
            <tr>
                <td>{LANG.field_choicetypes_title}</td>
                <td>
                    <!-- BEGIN: choicetypes_add -->
                    <select class="form-control" name="choicetypes">
                        <!-- BEGIN: choicetypes -->
                        <option {CHOICE_TYPES.selected} value="{CHOICE_TYPES.key}">{CHOICE_TYPES.value}</option>
                        <!-- END: choicetypes -->
                    </select>
                    <!-- END: choicetypes_add -->
                    <!-- BEGIN: choicetypes_add_hidden -->
                    {FIELD_TYPE_SQL}<input type="hidden" name="choicetypes" value="{choicetypes_add_hidden}" />
                    <!-- END: choicetypes_add_hidden -->
                </td>
            </tr>
        </table>
        <table class="table table-striped table-bordered table-hover" id="choicesql"{DATAFORM.display_choicesql} >
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{LANG.field_options_choicesql}
            </caption>
            <colgroup>
                <col class="w250" />
                <col span="2" />
            </colgroup>
            <thead>
                <tr>
                    <th>{LANG.field_options_choicesql_module}</th>
                    <th>{LANG.field_options_choicesql_table}</th>
                    <th>{LANG.field_options_choicesql_column}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span id="choicesql_module">&nbsp;</span>
                    </td>
                    <td>
                        <span id="choicesql_table">&nbsp;</span>
                    </td>
                    <td>
                        <span id="choicesql_column">&nbsp;</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-bordered table-hover" id="choiceitems"{DATAFORM.display_choiceitems} >
            <caption>
                <em class="fa fa-file-text-o">&nbsp;</em>{LANG.field_options_choice}
            </caption>
            <colgroup>
                <col class="w250" />
                <col span="3" />
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center">{LANG.field_number}</th>
                    <th class="text-center">{LANG.field_value}</th>
                    <th class="text-center">{LANG.field_text}</th>
                    <th class="text-center">{LANG.field_default_value}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <input style="margin-left: 50px;" type="button" value="{LANG.field_add_choice}" onclick="nv_choice_fields_additem();" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <!-- BEGIN: loop_field_choice -->
                <tr class="text-center">
                    <td>{FIELD_CHOICES.number}</td>
                    <td>
                        <input class="form-control w100 validalphanumeric" type="text" value="{FIELD_CHOICES.key}" name="field_choice[{FIELD_CHOICES.number}]" />
                    </td>
                    <td>
                        <input class="form-control w350" type="text" value="{FIELD_CHOICES.value}" name="field_choice_text[{FIELD_CHOICES.number}]" />
                    </td>
                    <td>
                        <input type="radio" {FIELD_CHOICES.checked} value="{FIELD_CHOICES.number}" name="default_value_choice">
                    </td>
                </tr>
                <!-- END: loop_field_choice -->
            </tbody>
        </table>
    </div>
    <div style="margin-left: 350px;">
        <input type="hidden" value="{DATAFORM.fid}" name="fid"> <input type="hidden" value="{DATAFORM.field}" name="fieldid"> <input class="btn btn-primary" type="submit" value="{LANG.save}" name="submit">
    </div>
</form>
<script type="text/javascript">
var items = '{FIELD_CHOICES_NUMBER}';
$(document).ready(function() {
    if ($("input[name=fid]").val() == 0) {
        nv_show_list_field();
    }
    nv_load_current_date();
    $.validator.addMethod('validalphanumeric', function(str) {
        if (str == '') {
            return true;
        }
        var fieldCheck_rule = /^([a-zA-Z0-9_-])+$/;
        return (fieldCheck_rule.test(str) ) ? true : false;
    }, ' required a-z, 0-9, and _ only');
    $.validator.addMethod('validatefield', function(str) {
        if (str == '') {
            return true;
        }
        var fieldCheck_rule = /^([a-zA-Z0-9_])+$/;
        return (fieldCheck_rule.test(str) ) ? true : false;
    }, ' required a-z, and _ only');
    $('#ffields').validate({
        rules : {
            field : {
                required : true,
                validatefield : true
            }
        }
    });
});
function nv_load_sqlchoice(choice_name_select, choice_seltected) {
    var getval = "";
    if (choice_name_select == "table") {
        var choicesql_module = $("select[name=choicesql_module]").val();
        var module_selected = (choicesql_module == "" || choicesql_module == undefined ) ? '{SQL_DATA_CHOICE.0}' : choicesql_module;
        getval = "&module=" + module_selected;
        $("#choicesql_column").html("");
    } else if (choice_name_select == "column") {
        var choicesql_module = $("select[name=choicesql_module]").val();
        var module_selected = (choicesql_module == "" || choicesql_module == undefined ) ? '{SQL_DATA_CHOICE.0}' : choicesql_module;
        var choicesql_table = $("select[name=choicesql_table]").val();
        var table_selected = (choicesql_table == "" || choicesql_table == undefined ) ? '{SQL_DATA_CHOICE.1}' : choicesql_table;
        getval = "&module=" + module_selected + "&table=" + table_selected;
    }
    $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=fields&nocache=' + new Date().getTime(), 'choicesql=1&choice=' + choice_name_select + getval + '&choice_seltected=' + choice_seltected, function(res) {
        $('#choicesql_' + choice_name_select).html(res);
    });
}
</script>
<!-- END: load -->
<!-- BEGIN: nv_load_sqlchoice -->
<script type="text/javascript">
    nv_load_sqlchoice('module', '{SQL_DATA_CHOICE.0}');
    nv_load_sqlchoice('table', '{SQL_DATA_CHOICE.1}');
    nv_load_sqlchoice('column', '{SQL_DATA_CHOICE.2}|{SQL_DATA_CHOICE.3}');
</script>
<!-- END: nv_load_sqlchoice -->
<!-- END: main -->
<!-- BEGIN: choicesql -->
<select class="form-control" onchange="nv_load_sqlchoice( '{choicesql_next}', '' )" name="{choicesql_name}">
    <!-- BEGIN: loop -->
    <option {SQL.sl} value="{SQL.key}">{SQL.val}</option>
    <!-- END: loop -->
</select>
<!-- END: choicesql -->
<!-- BEGIN: column -->
{LANG.field_options_choicesql_key}:
<select class="form-control" name="choicesql_column_key" id="choicesql_column_key">
    <!-- BEGIN: loop1 -->
    <option {SQL.sl_key} value="{SQL.key}">{SQL.val}</option>
    <!-- END: loop1 -->
</select>
{LANG.field_options_choicesql_val}:
<select class="form-control" name="choicesql_column_val" id="choicesql_column_val">
    <!-- BEGIN: loop2 -->
    <option {SQL.sl_val} value="{SQL.key}">{SQL.val}</option>
    <!-- END: loop2 -->
</select>
<!-- END: column -->