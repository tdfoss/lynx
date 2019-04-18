<!-- BEGIN: main -->
<div class="box">
	<div class="box-header with-border">
		<!-- BEGIN: textcap -->
		<h3 class="box-title">{CAPTION}</h3>
		<!-- END: textcap -->
		<!-- BEGIN: urlcap -->
		<h3 class="box-title">
			{CAPTION} <a href="{URL}" id="checkchmod" title="{LANG.checkchmod}">({LANG.checkchmod})</a><span id="wait"></span>
		</h3>
		<!-- END: urlcap -->
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<!-- BEGIN: loop -->
					<tr>
						<td>{KEY}</td>
						<td>{VALUE}</td>
					</tr>
					<!-- END: loop -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- END: main -->