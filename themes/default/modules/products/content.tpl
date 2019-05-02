<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="panel panel-default">
        <div class="panel-body">
            <input type="hidden" name="id" value="{ROW.id}" />
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control required" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_type}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control " name="catid">
                        <option value="0">---{LANG.typeid}---</option>
                        <!-- BEGIN: select_type -->
                        <option value="{TYPE.key}"{TYPE.selected}>{TYPE.title}</option>
                        <!-- END: select_type -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="price" value="{ROW.price}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.vat}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="number" name="vat" value="{ROW.vat}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price_unit}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select name="price_unit" class="form-control select2" style="width: 100%">
                        <option value="0">---{LANG.price_type_select}---</option>
                        <!-- BEGIN: price -->
                        <option value="{PRICE.id}"{PRICE.selected}>{PRICE.title}</option>
                        <!-- END: price -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.url}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="url" name="url" value="{ROW.url}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
                <div class="col-sm-19 col-md-20">{ROW.note}</div>
            </div>
            <div class="form-group text-center">
                <input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
            </div>
        </div>
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
        theme : 'bootstrap',
        tags : true
    });

    //]]>
</script>
<!-- END: main -->