<!-- BEGIN: main -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">{CAPTION}</h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>{THEAD0}</th>
						<th>{THEAD1}</th>
						<th>{THEAD2}</th>
					</tr>
				</thead>
				<tbody>
					<!-- BEGIN: loop -->
					<tr>
						<td>{KEY}</td>
						<!-- BEGIN: if -->
						<td>{VALUE}</td>
						<td>{VALUE}</td>
						<!-- END: if -->
						<!-- BEGIN: else -->
						<th>{VALUE0}</th>
						<th>{VALUE1}</th>
						<!-- END: else -->
					</tr>
					<!-- END: loop -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- END: main -->