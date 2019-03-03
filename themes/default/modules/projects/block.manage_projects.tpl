<!-- BEGIN: main -->
<table class="table table-striped table-bordered table-hover">
  <thead>
		<tr>
			<th>{LANG.title}</th>
			<th width="130">{LANG.status}</th>
		</tr>
	</thead>
	<tbody>
<!-- BEGIN: projects -->

 <tr onclick="nv_table_row_click(event, '{PROJECTS_VIEW.link_view}', false);" class="pointer">
    <td><strong>{PROJECTS_VIEW.title}</strong><span class="help-block">{PROJECTS_VIEW.performer_str}</span></td>
    <td>{PROJECTS_VIEW.status}</td>
  </tr>
<!-- END: projects -->
</tbody>
</table>


<!-- END: main -->