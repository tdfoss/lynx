<!-- BEGIN: main -->

<!-- BEGIN: updateinfo -->
<div class="alert alert-info text-center" id="infodetectedupg">
	<p>{LANG.update_package_detected}</p>
	<strong><a href="{URL_UPDATE}" title="{LANG.update_package_do}">{LANG.update_package_do}</a></strong> - <strong><a href="{URL_DELETE_PACKAGE}" title="{LANG.update_package_delete}" class="delete_update_backage">{LANG.update_package_delete}</a></strong>
</div>
<!-- END: updateinfo -->

<!-- BEGIN: pendinginfo -->
<div class="box box-warning">
	<div class="box-header with-border">
		<h3 class="box-title">{LANG.pendingInfo}</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<!-- BEGIN: loop -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="info-box border-yellow">
					<span class="info-box-icon bg-yellow"><i class="fa fa-globe"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">{MODULE}</span> <span class="info-box-number">
							<!-- BEGIN: link --> <a class="link" href="{LINK}" title="{KEY}">{KEY}:</a> <!-- END: link --> <!-- BEGIN: text --> {KEY}: <!-- END: text --> <strong>{VALUE}</strong>
						</span>
					</div>
				</div>
			</div>
			<!-- END: loop -->
		</div>
	</div>
</div>
<!-- END: pendinginfo -->

<!-- BEGIN: info -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">{LANG.moduleInfo}</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<!-- BEGIN: loop -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="info-box border-aqua">
					<span class="info-box-icon bg-aqua"><i class="fa fa-globe"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">{MODULE}</span> <span class="info-box-number">
							<!-- BEGIN: link --> <a class="link" href="{LINK}" title="{KEY}">{KEY}:</a> <!-- END: link --> <!-- BEGIN: text --> {KEY}: <!-- END: text --> <strong>{VALUE}</strong>
						</span>
					</div>
				</div>
			</div>
			<!-- END: loop -->
		</div>
	</div>
</div>
<!-- END: info -->

<!-- BEGIN: version -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">
			<strong>{LANG.version}</strong> <span style="font-weight: 400">(<a href="{ULINK}">{CHECKVERSION}</a>)
		</h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>{LANG.moduleContent}</th>
						<th>{LANG.moduleValue}</th>
					</tr>
				</thead>
				<tbody>
					<!-- BEGIN: loop -->
					<tr>
						<td>{KEY}</td>
						<td class="aright">{VALUE}</td>
					</tr>
					<!-- END: loop -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- BEGIN: inf -->
<div class="newVesionInfo">{INFO}</div>
<!-- END: inf -->

<!-- END: version -->
<script type="text/javascript">
	$(function() {
		$("img.imgstatnkv").attr("src", "http://static.nukeviet.vn/img.jpg");
	});
</script>

<!-- END: main -->