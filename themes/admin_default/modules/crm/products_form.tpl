<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_title}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="price" value="{ROW.price}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.description}</strong></label>
				<div class="col-sm-19 col-md-20">{ROW.description}</div>
			</div>
			<div class="form-group text-center">
				<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</div>
	</div>
</form>
<!-- END: main -->