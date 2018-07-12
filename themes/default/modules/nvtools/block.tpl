<!-- BEGIN: main -->
<!-- BEGIN: tablename -->
<form action="{NV_BASE_SITEURL}index.php" method="get">
	<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}"/>
	<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}"/>
	<h3>Chức năng thêm mới block sử dụng cho NukeViet 4</h3>
	<table class="table table-striped table-bordered table-hover">
		<tbody>
			<tr>
				<td> Kiểu Block</td>
				<td>
				<select name="blocktheme">
					<option value=""> Block của module </option>
					<!-- BEGIN: theme_list -->
					<option value="{THEME_LIST.value}" {THEME_LIST.selected}>Giao diện: {THEME_LIST.value}</option>
					<!-- END: theme_list -->
				</select></td>
			</tr>
			<tr>
				<td> Block Global:</td>
				<td><input type="checkbox" name="blockglobal" value="1"  checked="checked"/></td>
			</tr>
			<tr>
				<td> Block Setting:</td>
				<td><input type="checkbox" name="blocksetting" value="1"  checked="checked"/></td>
			</tr>

			<tr>
				<td>Chọn module:</td>
				<td>
				<select name="modname">
					<option value=""> -- chọn module -- </option>
					<!-- BEGIN: modname -->
					<option value="{MODNAME.value}" {MODNAME.selected}>{MODNAME.value}</option>
					<!-- END: modname -->
				</select></td>
			</tr>
			<tr>
				<td> Bảng CSDL</td>
				<td>
				<select name="tablename">
					<option value=""> -- chọn bảng dữ liệu -- </option>
					<!-- BEGIN: loop -->
					<option value="{MODNAME.value}" {MODNAME.selected}>{MODNAME.value}</option>
					<!-- END: loop -->
				</select></td>
			</tr>
			<tr>
				<td>Tên Block:</td><td><input required="required" oninvalid="setCustomValidity('Dữ liệu này là bắt buộc chỉ dùng các ký tự a-z 0-9 và gạch dưới')" oninput="setCustomValidity('')"  pattern="^[a-z0-9\_]*$"  type="text" name="blockname" style="width:150px;" value="{FUNNAME}" /></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><input class="btn btn-primary" type="submit" value="Thực hiện" /></td>
			</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
	$('select[name=modname]').change(function() {
		$("select[name=tablename]").load(script_name + "?" + nv_name_variable + "=" + nv_module_name + "&" + nv_fc_variable + "=addfun&loadmodname=" + $(this).val() + "&nocache=" + new Date().getTime());
	});
	$('select[name=tablename]').change(function() {
		var r_split = $(this).val().split('_');
		len = r_split.length - 1;
		$("input[name=blockname]").val(r_split[len]);
	});
</script>
<!-- END: tablename -->

<!-- BEGIN: form -->
<form action="{NV_BASE_SITEURL}index.php" method="post">
	<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}"/>
	<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}"/>
	<input type="hidden" name="blocktheme" value="{BLOCKTHEME}"/>
	<input type="hidden" name="modname" value="{MODNAME}"/>
	<input type="hidden" name="tablename" value="{TABLENAME}"/>
	<table class="table table-striped table-bordered table-hover">
		<caption>
			Tạo block cho module {MODNAME} từ bảng: {TABLENAME}
		</caption>
		<thead>
			<tr>
				<th>Tên cột</th>
				<th>Loại dữ liệu</th>
				<th>Chọn các trường trong câu truy vấn SQL</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: column -->
			<tr id="column_{COLUMN.column_name}">
				<td>{COLUMN.column_name}</td>
				<td>{COLUMN.data_type}</td>
				<td>
				<select name="views[{COLUMN.column_name}]}">
					<option value=""> ---- </option>
					<!-- BEGIN: field_type -->
					<option value="{FIELD_TYPE.key}" {FIELD_TYPE.selected}>{FIELD_TYPE.value}</option>
					<!-- END: field_type -->
				</select></td>
			</tr>
			<!-- END: column -->
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<caption>
			Các chức năng của block
		</caption>
		<colgroup>
			<col style="width: 50%" />
		</colgroup>
		<tbody>
			<tr>
				<td>Tên Block:</td><td><input required="required" oninvalid="setCustomValidity('Dữ liệu này là bắt buộc chỉ dùng các ký tự a-z 0-9 và gạch dưới')" oninput="setCustomValidity('')"  pattern="^[a-z0-9\_]*$"  type="text" name="blockname" style="width:150px;" value="{BLOCKNAME}" /></td>
			</tr>
			<tr>
				<td> Block Global:</td>
				<td><input type="checkbox" name="blockglobal" value="1"  {BLOCKGLOBALCHECK}/></td>
			</tr>
			<tr>
				<td> Block Setting:</td>
				<td><input type="checkbox" name="blocksetting" value="1"  {BLOCKSETTINGCHECK}/></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td align="center" colspan="2"><input class="btn btn-primary" type="submit" value="Thực hiện" /></td>
			</tr>
		</tfoot>
	</table>
</form>
<!-- END: form -->
<!-- END: main -->