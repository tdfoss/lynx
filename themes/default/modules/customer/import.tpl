<!-- BEGIN: main -->
<ol class="breadcrumb">
	<li><a href="/index.php?language=vi" title="{LANG.import_excel_step1}"><span>{LANG.import_excel_step1}</span></a></li>
	<li><a href="/index.php?language=vi" title="{LANG.import_excel_step2}"><span>{LANG.import_excel_step2}</span></a></li>
	<li><a href="/index.php?language=vi" title="{LANG.import_excel_step3}"><span>{LANG.import_excel_step3}</span></a></li>
</ol>
<!-- BEGIN: error -->
<div class="error well">{error}</div>
<!-- END: error -->
<form class="form-inline" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}&action={action}" enctype="multipart/form-data" method="post">
	<!-- BEGIN: check_data -->
	<h1>{LANG.import_action_customer}</h1>
	<div class="well">
		<div class="row">
			<div class="col-xs-24 col-md-24 clear">
				<label class="w200">{LANG.import_excel_browse_file}</label>
				<div class="input-group">
					<input type="text" class="form-control" id="upload-file-info" readonly> <label class="input-group-btn"> <span class="btn btn-primary"> <input name="upload_fileupload" id="my-file-selector" style="display: none;" type="file"> <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
					</span>
					</label>
				</div>
				<span id="loading_bar"><input type="button" class="btn btn-success" name="data_export" value="{LANG.download_file}" /></span>
			</div>
			<p>{LANG.note_import_data}</p>
		</div>
	</div>
	<div style="text-align: center">
		<input name="submit" class="btn btn-default" type="submit" value="{LANG.check_data}" />
	</div>
	<!-- END: check_data -->
</form>
<!-- BEGIN: data_customer -->
<div class="alert alert-success text-center" style="display: none" id="notice_finish">
	<p>
		Bạn đã thêm thành công <strong>{RESULT}</strong> khách hàng vào danh sách
	</p>
</div>
<div class="panel panel-body" style="height: 500px; overflow: scroll; overflow-x: auto;">
	<div id="data_result">
		<!-- BEGIN: data_result -->
		<div class="infoalert">
			<p>
				{LANG.total_row}: <strong>{TOTAL_ROW}</strong>
			</p>
			<p>
				{LANG.total_row_error}: <strong>{TOTAL_ROW_ERROR}</strong>
			</p>
		</div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{LANG.number}</th>
					<th>{LANG.customer_types}</th>
					<th>{LANG.last_name}</th>
					<th>{LANG.first_name}</th>
					<th>{LANG.main_phone}</th>
					<th>{LANG.other_phone}</th>
					<th>{LANG.main_email}</th>
					<th>{LANG.other_email}</th>
					<th>{LANG.birthday}</th>
					<th>{LANG.gender}</th>
					<th>{LANG.address}</th>
					<th>{LANG.unit}</th>
					<th>{LANG.fb}</th>
					<th>{LANG.skp}</th>
					<th>{LANG.zalo}</th>
					<th>{LANG.care_staff}</th>
					<th>{LANG.note}</th>
					<th>{LANG.trading_person}</th>
					<th>{LANG.unit_name}</th>
					<th>{LANG.tax_code}</th>
					<th>{LANG.address_invoice}</th>
				</tr>
				<!-- BEGIN: loop -->
				<tr>
					<td>{DATA.stt}</td>
					<td>{DATA.type_id}</td>
					<td>{DATA.first_name}</td>
					<td>{DATA.last_name}</td>
					<td class="{DATA.error_main_phone}">{DATA.main_phone}</td>
					<td>{DATA.other_phone}</td>
					<td class="{DATA.error_main_email}">{DATA.main_email}</td>
					<td>{DATA.other_email}</td>
					<td>{DATA.birthday}</td>
					<td>{DATA.gender}</td>
					<td>{DATA.address}</td>
					<td>{DATA.unit}</td>
					<td class="{DATA.error_facebook}">{DATA.facebook}</td>
					<td class="{DATA.error_skype}">{DATA.skype}</td>
					<td class="{DATA.error_skype}">{DATA.zalo}</td>
					<td>{DATA.workforce}</td>
					<td>{DATA.note}</td>
					<td>{DATA.trading_person}</td>
					<td>{DATA.unit_name}</td>
					<td class="{DATA.error_mst}">{DATA.tax_code}</td>
					<td>{DATA.address_invoice}</td>
				</tr>
				<!-- END: loop -->
			</thead>
		</table>
		<!-- END: data_result -->
	</div>
</div>
<div style="text-align: center">
	<input id="btn_import" name="save_data" class="btn btn-primary" onclick="nv_save_data_import();" type="button" value="{LANG.save_data}" /> <a href="{BTN_FINISH}" id="btn_finish" class="btn btn-primary" style="display: none"> {LANG.btn_finish} </a>
</div>
<!-- END: data_customer -->
<script>
	$('#my-file-selector').on('change', function() {
		$('#upload-file-info').val($(this).val())
	})
	//download data template
	function nv_data_export(set_export) {
		$.ajax({
			type : "POST",
			url : nv_base_siteurl + "index.php?" + nv_name_variable + "="
					+ nv_module_name + "&" + nv_fc_variable
					+ "=export&nocache=" + new Date().getTime(),
			data : "&act={action}&limit=5&step=1&set_export=" + set_export,
			success : function(response) {
				if (response == "NEXT") {
					nv_data_export(0);
				} else if (response == "COMPLETE") {
					$("#loading_bar").hide();
					alert('{LANG.export_complete}');
					window.location.href = script_name + '?' + nv_name_variable
							+ '=' + nv_module_name + '&' + nv_fc_variable
							+ '=export&step=2&act={action}';
				} else {
					$("#loading_bar").hide();
					alert(response);
					window.location.href = script_name + '?' + nv_name_variable
							+ '=' + nv_module_name + '&' + nv_fc_variable
							+ '=import';
				}
			}
		});
	}
	function nv_save_data_import() {
		$.ajax({
			type : "POST",
			url : nv_base_siteurl + "index.php?" + nv_name_variable + "="
					+ nv_module_name + "&" + nv_fc_variable
					+ "=import&nocache=" + new Date().getTime(),
			data : "&action={action}&save_data=1",
			success : function(response) {
				$('#data_result').html(response);
				$('#btn_import').hide();
				$('#btn_finish').show();
				$('#notice_finish').show();
			}
		});
	}

	$("input[name=data_export]")
			.click(
					function() {
						$("input[name=data_export]").attr("disabled",
								"disabled");
						$('#loading_bar')
								.html(
										'<center>{LANG.export_note}<br /><br /><img src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/images/load_bar.gif" alt="" /></center>');
						nv_data_export(1);
					});
</script>
<!-- END: main -->