<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2-bootstrap.min.css" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" id="frm-submit">
    <input type="hidden" name="id" value="{ROW.id}" /> <input type="hidden" name="redirect" value="{ROW.redirect}" />
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.invoice_info}</div>
        <div class="panel-body">
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
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong> <span class="red">(*)</span></label>
                <div class="col-sm-19 col-md-20">
                    <input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.createtime}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="input-group">
                        <input class="form-control" type="text" name="createtime" value="{ROW.createtime}" id="createtime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /> <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="createtime-btn">
                                <em class="fa fa-calendar fa-fix"> </em>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.duetime}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <select class="form-control" name="cycle" id="cycle">
                                <option value="0">---{LANG.cycle_month_select}---</option>
                                <!-- BEGIN: cycle -->
                                <option value="{CYCLE.key}"{CYCLE.selected}>{CYCLE.value}</option>
                                <!-- END: cycle -->
                            </select>
                        </div>
                        <div class="col-xs-18 col-sm-18 col-md-18">
                            <div class="input-group">
                                <input class="form-control" type="text" name="duetime" value="{ROW.duetime}" id="duetime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /> <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="duetime-btn">
                                        <em class="fa fa-calendar fa-fix"> </em>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.auto_create}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <label><input type="checkbox" name="auto_create" value="1"{ROW.ck_auto_create}>{LANG.auto_create_note}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.workforceid}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2" name="workforceid">
                        <option value="0">---{LANG.workforceid_select}---</option>
                        <!-- BEGIN: user -->
                        <option value="{USER.userid}"{USER.selected}>{USER.fullname}</option>
                        <!-- END: user -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.presenterid}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2" name="presenterid">
                        <option value="0">---{LANG.performerid_select}---</option>
                        <!-- BEGIN: user1 -->
                        <option value="{USER.userid}"{USER.selected1}>{USER.fullname}</option>
                        <!-- END: user1 -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.performerid}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select class="form-control select2" name="performerid">
                        <option value="0">---{LANG.presenterid_select}---</option>
                        <!-- BEGIN: user2 -->
                        <option value="{USER.userid}"{USER.selected2}>{USER.fullname}</option>
                        <!-- END: user2 -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.status}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select name="status" class="form-control">
                        <!-- BEGIN: status -->
                        <option value="{STATUS.index}"{STATUS.selected}>{STATUS.value}</option>
                        <!-- END: status -->
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.terms}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.terms}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <textarea class="form-control" style="height: 100px;" cols="75" rows="5" name="terms">{ROW.terms}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.description}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.description}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <textarea class="form-control" style="height: 100px;" cols="75" rows="5" name="description">{ROW.description}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="pull-left">{LANG.item_details}</span><span class="pull-right">{LANG.money_unit}: {LANG.vnd}</span>
            <div class="clearfix"></div>
        </div>
        <table class="table table-striped table-bordered table-hover table-middle">
            <thead>
                <tr>
                    <th width="50">{LANG.number}</th>
                    <th>{LANG.title}</th>
                    <th width="150">{LANG.unit_price}</th>
                    <th width="150">{LANG.quantity}</th>
                    <th width="150">{LANG.price_string}</th>
                    <th width="150">{LANG.vat}</th>
                    <th width="300">{LANG.vat_price}</th>
                    <th width="150">{LANG.total}</th>
                    <th width="50"></th>
                </tr>
            </thead>
            <tbody id="item-detail">
                <!-- BEGIN: items -->
                <tr class="item" data-index="{ITEM.index}" data-module="{ITEM.module}">
                    <td class="number text-center">{ITEM.number}</td>
                    <td><input type="hidden" name="detail[{ITEM.index}][module]" value="{ITEM.module}" />
                        <div class="m-bottom">
                            <!-- BEGIN: services -->
                            <select class="select2 form-control" name="detail[{ITEM.index}][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">
                                <option value="0">---{LANG.service_select}---</option>
                                <!-- BEGIN: loop -->
                                <option value="{SERVICES.id}"{SERVICES.selected}>{SERVICES.title}</option>
                                <!-- END: loop -->
                            </select>
                            <!-- END: services -->
                            <!-- BEGIN: products -->
                            <select class="select2 form-control" name="detail[{ITEM.index}][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">
                                <option value="0">---{LANG.product_select}---</option>
                                <!-- BEGIN: loop -->
                                <option value="{PRODUCTS.id}"{PRODUCTS.selected}>{PRODUCTS.title}</option>
                                <!-- END: loop -->
                            </select>
                            <!-- END: products -->
                            <!-- BEGIN: projects -->
                            <select class="select2 form-control" name="detail[{ITEM.index}][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">
                                <option value="0">---{LANG.projects_select}---</option>
                                <!-- BEGIN: loop -->
                                <option value="{PROJECTS.id}"{PROJECTS.selected}>{PROJECTS.title}</option>
                                <!-- END: loop -->
                            </select>
                            <!-- END: projects -->
                        </div> <textarea class="form-control" name="detail[{ITEM.index}][note]" placeholder="{LANG.note}">{ITEM.note}</textarea></td>
                    <td><input type="text" class="form-control unit_price" onchange="nv_item_change_input();" name="detail[{ITEM.index}][unit_price]" value="{ITEM.unit_price}"></td>
                    <td><input type="number" class="form-control quantity" onchange="nv_item_change_input();" name="detail[{ITEM.index}][quantity]" value="{ITEM.quantity}"></td>
                    <td><input type="text" class="form-control price" onchange="nv_item_change_input();" name="detail[{ITEM.index}][price]" value="{ITEM.price}"></td>
                    <td><input type="text" class="form-control vat" onchange="nv_item_change_input();" name="detail[{ITEM.index}][vat]" value="{ITEM.vat}"></td>
                    <td><input type="text" class="form-control vat_price" readonly="readonly" name="detail[{ITEM.index}][vat_price]" value="{ITEM.vat_price}"></td>
                    <td class="total">{ITEM.total}</td>
                    <td class="text-center"><em class="fa fa-trash-o fa-lg pointer" onclick="nv_item_delete(this); return !1;">&nbsp;</em></td>
                </tr>
                <!-- END: items -->
            </tbody>
        </table>
    </div>
    <ul class="list-inline">
        <li><button class="btn btn-primary btn-xs" onclick="nv_service_add(); return !1;">{LANG.service_add}</button></li>
        <li><button class="btn btn-primary btn-xs" onclick="nv_product_add(); return !1;">{LANG.product_add}</button></li>
        <li><button class="btn btn-primary btn-xs" onclick="nv_projects_add(); return !1;">{LANG.projects_add}</button></li>
    </ul>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th class="text-right">{LANG.item_total}</th>
                <td width="300" id="item_total">{TOTAL.item_total}</td>
            </tr>
            <tr>
                <th class="text-right">{LANG.vat_total}</th>
                <td id="vat_total">{TOTAL.vat_total}</td>
            </tr>
            <tr>
                <th class="text-right">{LANG.discount} (%)</th>
                <td width="300"><input type="number" name="discount_percent" value="{ROW.discount_percent}" class="form-control" onchange="nv_item_change_input();" /></td>
            </tr>
            <tr>
                <th class="text-right">{LANG.grand_total}</th>
                <td id="grand_total">{TOTAL.grand_total}</td>
            </tr>
            <tr>
                <th class="text-right">{LANG.grand_total_string}</th>
                <td id="grand_total_string">{TOTAL.grand_total_string}</td>
            </tr>
        </tbody>
    </table>
    <div class="form-group text-center button_fixed_bottom">
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
    
    var count = {COUNT};
    function nv_service_add()
    {
        var html;
        html += '<tr class="item" data-index="' + count + '" data-module="services">';
        html += '    <td class="number text-center">1</td>';
        html += '    <td><input type="hidden" name="detail[' + count + '][module]" value="services" /><div class="m-bottom"><select class="select2_js form-control" name="detail[' + count + '][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">';
        html += '	 <option value="0">---{LANG.service_select}---</option>';
    	<!-- BEGIN: services_js -->
        html += '		<option value="{SERVICES.id}">{SERVICES.title}</option>';
        <!-- END: services_js -->
    	html += '	 </select></div><textarea class="form-control" name="detail[' + count + '][note]" placeholder="{LANG.note}"></textarea></td>';
	    html += '    <td><input type="number" class="form-control unit_price" onchange="nv_item_change_input();" name="detail[' + count + '][unit_price]" value="0"></td>';
	    html += '    <td><input type="number" class="form-control quantity" onchange="nv_item_change_input();" name="detail[' + count + '][quantity]" value="1"></td>';
        html += '    <td><input type="text" class="form-control price" onchange="nv_item_change_input();" name="detail[' + count + '][price]"></td>';
        html += '    <td><input type="text" class="form-control vat" onchange="nv_item_change_input();" name="detail[' + count + '][vat]"></td>';
        html += '    <td><input type="text" class="form-control vat_price" readonly="readonly" name="detail[' + count + '][vat_price]"></td>';
        html += '    <td class="total"></td>';
        html += '    <td class="text-center"><em class="fa fa-trash-o fa-lg pointer" onclick="nv_item_delete(this); return !1;">&nbsp;</em></td>';
        html += '</tr>';
        
        $('#item-detail').append(html);
        $('.number').addNumber();
        
        $(".select2_js").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
        });
        
        count++;
        return !1;
    }
    
    function nv_product_add()
    {
        var html;
        html += '<tr class="item" data-index="' + count + '" data-module="products">';
        html += '    <td class="number text-center">1</td>';
        html += '    <td><input type="hidden" name="detail[' + count + '][module]" value="products" /><div class="m-bottom"><select class="select2_js form-control" name="detail[' + count + '][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">';
        html += '	 <option value="0">---{LANG.product_select}---</option>';
    	<!-- BEGIN: products_js -->
        html += '		<option value="{PRODUCTS.id}">{PRODUCTS.title}</option>';
        <!-- END: products_js -->
    	html += '	 </select></div><textarea class="form-control" name="detail[' + count + '][note]" placeholder="{LANG.note}"></textarea></td>';
    	html += '    <td><input type="number" class="form-control unit_price" onchange="nv_item_change_input();" name="detail[' + count + '][unit_price]" value="0"></td>';
	    html += '    <td><input type="number" class="form-control quantity" onchange="nv_item_change_input();" name="detail[' + count + '][quantity]" value="1"></td>';
        html += '    <td><input type="text" class="form-control price" onchange="nv_item_change_input();" name="detail[' + count + '][price]"></td>';
        html += '    <td><input type="text" class="form-control vat" onchange="nv_item_change_input();" name="detail[' + count + '][vat]"></td>';
        html += '    <td><input type="text" class="form-control vat_price" readonly="readonly" name="detail[' + count + '][vat_price]"></td>';
        html += '    <td class="total"></td>';
        html += '    <td class="text-center"><em class="fa fa-trash-o fa-lg pointer" onclick="nv_item_delete(this); return !1;">&nbsp;</em></td>';
        html += '</tr>';
        
        $('#item-detail').append(html);
        $('.number').addNumber();
        
        $(".select2_js").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
        });
        
        count++;
        return !1;
    }
    
    function nv_projects_add()
    {
        var html;
        html += '<tr class="item" data-index="' + count + '" data-module="projects">';
        html += '    <td class="number text-center">1</td>';
        html += '    <td><input type="hidden" name="detail[' + count + '][module]" value="projects" /><div class="m-bottom"><select class="select2_js form-control" name="detail[' + count + '][itemid]" style="width: 100%" onchange="nv_item_change($(this)); return !1;">';
        html += '	 <option value="0">---{LANG.projects_select}---</option>';
    	<!-- BEGIN: projects_js -->
        html += '		<option value="{PROJECTS.id}">{PROJECTS.title}</option>';
        <!-- END: projects_js -->
    	html += '	 </select></div><textarea class="form-control" name="detail[' + count + '][note]" placeholder="{LANG.note}"></textarea></td>';
    	html += '    <td><input type="number" class="form-control unit_price" onchange="nv_item_change_input();" name="detail[' + count + '][unit_price]" value="0"></td>';
	    html += '    <td><input type="number" class="form-control quantity" onchange="nv_item_change_input();" name="detail[' + count + '][quantity]" value="1"></td>';
        html += '    <td><input type="text" class="form-control price" onchange="nv_item_change_input();" name="detail[' + count + '][price]"></td>';
        html += '    <td><input type="text" class="form-control vat" onchange="nv_item_change_input();" name="detail[' + count + '][vat]"></td>';
        html += '    <td><input type="text" class="form-control vat_price" readonly="readonly" name="detail[' + count + '][vat_price]"></td>';
        html += '    <td class="total"></td>';
        html += '    <td class="text-center"><em class="fa fa-trash-o fa-lg pointer" onclick="nv_item_delete(this); return !1;">&nbsp;</em></td>';
        html += '</tr>';
        
        $('#item-detail').append(html);
        $('.number').addNumber();
        
        $(".select2_js").select2({
            language : "{NV_LANG_INTERFACE}",
            theme : "bootstrap",
        });
        
        count++;
        return !1;
    }
    //]]>
</script>
<script type="text/javascript">
    //<![CDATA[
    $("#createtime,#duetime").datepicker({
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        showOn : "focus",
        yearRange : "-90:+5",
    });    
    
    $('#cycle').change(function(){
		var createtime = $('#createtime').val();
		var cycle = $(this).val();
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&nocache=' + new Date().getTime(), 'get_time_end=1&createtime=' + createtime + '&cycle=' + cycle, function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				$('#duetime').val(r_split[1]);
			}
		});
	});
    
    //]]>
</script>
<!-- END: main -->
