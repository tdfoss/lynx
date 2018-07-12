<!-- BEGIN: main -->
<table class="table table-striped table-bordered table-hover">
  <thead>
		<tr>
			<th>Tên dự án</th>
			<th>Trạng thái</th>
		</tr>
	</thead>
	<tbody>
<!-- BEGIN: projects -->

 <tr onclick="nv_table_row_click(event, '{PROJECTS_VIEW.link_view}', false);" class="pointer">
    <td>{PROJECTS_VIEW.title}</td>
    <td>{PROJECTS_VIEW.status}</td>
  </tr>
<!-- END: projects -->
</tbody>
</table>


<!-- END: main -->