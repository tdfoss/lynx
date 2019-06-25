<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<div class="well">
    <form action="{NV_BASE_SITEURL}index.php" method="get" id="frm-search">
        <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
        <!--         <input type="hidden" name="page" value="{PAGE}" /> -->
        <input type="hidden" name="is_contact" value="{SEARCH.is_contact}" />
        <div class="row">
            <div class="col-xs-24 col-md-4">
                <div class="form-group">
                    <input class="form-control" type="text" value="{SEARCH.q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
                </div>
            </div>
            <div class="col-xs-24 col-md-4">
                <div class="form-group">
                    <select class="form-control select2" name="type_id">
                        <option value="0">---{LANG.typeid}---</option>
                        <!-- BEGIN: select_type_id -->
                        <option value="{TYPEID.key}"{TYPEID.selected}>{TYPEID.title}</option>
                        <!-- END: select_type_id -->
                    </select>
                </div>
            </div>
            <div class="col-xs-24 col-md-4">
                <div class="form-group">
                    <select class="form-control select2" name="care_staff">
                        <option value="0">---{LANG.care_staff_name}---</option>
                        <!-- BEGIN: care_staff -->
                        <option value="{CARE_START.userid}"{CARE_START.selected}>{CARE_START.fullname}</option>
                        <!-- END: care_staff -->
                    </select>
                </div>
            </div>
            <div class="col-xs-24 col-md-4">
                <div class="form-group">
                    <select class="form-control select2" name="tag_id[]" multiple="multiple" data-placeholder="---{LANG.tags_select}---">
                        <!-- BEGIN: tags -->
                        <option value="{TAGS.tid}"{TAGS.selected}>{TAGS.title}</option>
                        <!-- END: tags -->
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
<form class="form-inline m-bottom pull-left">
    <select class="form-control" id="action-top">
        <!-- BEGIN: action_top -->
        <option value="{ACTION.key}">{ACTION.value}</option>
        <!-- END: action_top -->
    </select>
    <button class="btn btn-primary" onclick="nv_list_action( $('#action-top').val(), '{BASE_URL}', '{LANG.error_empty_data}' ); return false;">{LANG.perform}</button>
    <a href="{URL_ADD}" class="btn btn-primary">{LANG.customer_add}</a>
    <div class="dropdown dropdown-hover pull-right margin-left">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            <em class="fa fa-list-ul">&nbsp;</em>{LANG.other} <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <!-- BEGIN: import -->
            <li><a href="{IMPORT_EXCEL}"><em class="fa fa-plus-square">&nbsp;</em>{LANG.import_excel}</a></li>
            <!-- END: import -->
            <li><a href="" onclick="nv_customer_export_option('{URL_PARAM}', '{LANG.export_title}'); return !1;"><em class="fa fa-plus-square">&nbsp;</em>{LANG.export}</a></li>
        </ul>
    </div>
</form>
<!-- BEGIN: generate_page_top -->
<div class="pull-right">{NV_GENERATE_PAGE}</div>
<!-- END: generate_page_top -->
<div class="clearfix"></div>
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover row-click">
            <thead>
                <tr>
                    <th width="50" class="text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);"></th>
                    <th>{LANG.customer_types}</th>
                    <th>{LANG.last_name}</th>
                    <th>
                        <!-- BEGIN: first_name_no --> <em class="fa fa-sort">&nbsp;</em> <!-- END: first_name_no --> <!-- BEGIN: first_name --> <!-- BEGIN: desc --> <em class="fa fa-sort-numeric-desc">&nbsp;</em> <!-- END: desc --> <!-- BEGIN: asc --> <em class="fa fa-sort-numeric-asc">&nbsp;</em> <!-- END: asc --> <!-- END: first_name --> <a href="{SORTURL.first_name}" title="">{LANG.first_name}</a>
                    </th>
                    <th>{LANG.main_phone}</th>
                    <th>{LANG.main_email}</th>
                    <th width="200">{LANG.care_staff_name}</th>
                    <th width="150">
                        <!-- BEGIN: addtime_no --> <em class="fa fa-sort">&nbsp;</em> <!-- END: addtime_no --> <!-- BEGIN: addtime --> <!-- BEGIN: desc --> <em class="fa fa-sort-numeric-desc">&nbsp;</em> <!-- END: desc --> <!-- BEGIN: asc --> <em class="fa fa-sort-numeric-asc">&nbsp;</em> <!-- END: asc --> <!-- END: addtime --> <a href="{SORTURL.addtime}" title="">{LANG.addtime}</a>
                    </th>
                    <th width="150">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: loop -->
                <tr onclick="nv_table_row_click(event, '{VIEW.link_view}', false);">
                    <td class="text-center">
                        <input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.id}" name="idcheck[]" class="post">
                    </td>
                    <td>{VIEW.type_id}</td>
                    <td>{VIEW.last_name}</td>
                    <td>{VIEW.first_name}</td>
                    <td>{VIEW.main_phone}</td>
                    <td>
                        <a href="mailto:{VIEW.main_email}">{VIEW.main_email}</a>
                    </td>
                    <td>{VIEW.workforce}</td>
                    <td>{VIEW.addtime}</td>
                    <td class="text-center">
                        <!-- BEGIN: admin -->
                        <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a>
                        <!-- END: admin -->
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<form class="form-inline m-bottom pull-left">
    <select class="form-control" id="action-bottom">
        <!-- BEGIN: action_bottom -->
        <option value="{ACTION.key}">{ACTION.value}</option>
        <!-- END: action_bottom -->
    </select>
    <button class="btn btn-primary" onclick="nv_list_action( $('#action-bottom').val(), '{BASE_URL}', '{LANG.error_empty_data}' ); return false;">{LANG.perform}</button>
</form>
<!-- BEGIN: generate_page -->
<div class="pull-right">{NV_GENERATE_PAGE}</div>
<!-- END: generate_page -->
<div class="clearfix"></div>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script>
    $('.select2').select2({
        language : '{NV_LANG_INTERFACE}',
        theme : 'bootstrap'
    });
</script>
<!-- END: main -->