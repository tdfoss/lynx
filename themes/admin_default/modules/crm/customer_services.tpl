<!-- BEGIN: main -->
<!-- BEGIN: view -->
<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="get">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" /> <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" /> <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
		<div class="row">
			<div class="col-xs-24 col-md-6">
				<div class="form-group">
					<input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
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
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="w100">{LANG.weight}</th>
					<th>{LANG.id_customer}</th>
					<th>{LANG.id_services}</th>
					<th>{LANG.id_user}</th>
					<th>{LANG.time_add}</th>
					<th>{LANG.time_exp}</th>
					<th>{LANG.id_order}</th>
					<th class="w150">&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="8">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td><select class="form-control" id="id_weight_{VIEW.id}" onchange="nv_change_weight('{VIEW.id}');">
							<!-- BEGIN: weight_loop -->
							<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
							<!-- END: weight_loop -->
					</select></td>
					<td>{VIEW.id_customer}</td>
					<td>{VIEW.id_services}</td>
					<td>{VIEW.id_user}</td>
					<td>{VIEW.time_add}</td>
					<td>{VIEW.time_exp}</td>
					<td>{VIEW.id_order}</td>
					<td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.id_customer}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<select class="form-control" name="id_customer">
						<option value="">---</option>
						<!-- BEGIN: select_id_customer -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_id_customer -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.id_services}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<select class="form-control" name="id_services">
						<option value="">---</option>
						<!-- BEGIN: select_id_services -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_id_services -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.id_user}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<select class="form-control" name="id_user">
						<option value="">---</option>
						<!-- BEGIN: select_id_user -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_id_user -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.time_add}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="time_add" value="{ROW.time_add}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.time_exp}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="time_exp" value="{ROW.time_exp}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.id_order}</strong></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="id_order" value="{ROW.id_order}" pattern="^[0-9]*$" oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group text-center">
				<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	//<![CDATA[
	function nv_change_weight(id) {
		var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
		var new_vid = $('#id_weight_' + id).val();
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name
				+ '&' + nv_fc_variable + '=customer_services&nocache='
				+ new Date().getTime(), 'ajax_action=1&id=' + id + '&new_vid='
				+ new_vid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] != 'OK') {
				alert(nv_is_change_act_confirm[2]);
			}
			window.location.href = script_name + '?' + nv_name_variable + '='
					+ nv_module_name + '&' + nv_fc_variable
					+ '=customer_services';
			return;
		});
		return;
	}

	//]]>
</script>
<!-- END: main -->