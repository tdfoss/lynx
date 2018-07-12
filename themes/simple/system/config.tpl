<!-- BEGIN: main -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="panel panel-default">
		<div class="panel-body">
			<label class="col-xs-24 col-sm-3 text-right">{LANG.layout}</label>
			<div class="col-xs-24 col-sm-21">
				<!-- BEGIN: layout -->
				<label><input type="radio" name="layout" value="{LAYOUT.key}" {LAYOUT.checked} />{LAYOUT.value}</label>&nbsp;&nbsp;&nbsp;
				<!-- END: layout_color -->
			</div>
		</div>
	</div>
	<div class="text-center">
		<input class="btn btn-primary" type="submit" name="submit" value="{LANG.save}" />
	</div>
</form>
<!-- END:main -->