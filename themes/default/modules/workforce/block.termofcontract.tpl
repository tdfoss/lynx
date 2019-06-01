<!-- BEGIN: main -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>{LANG.work_staff}</th>
            <th width="200">{LANG.endtime}</th>
            <th width="200">{LANG.day_left}</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: task -->
        <tr onclick="nv_table_row_click(event, '{TASK_VIEW.link_view}', false);" class="pointer">
            <td>{TASK_VIEW.accout_connect}</td>
            <td>{TASK_VIEW.duetime}</td>
            <td>{TASK_VIEW.day_left}</td>
        </tr>
        <!-- END: task -->
    </tbody>
</table>
<!-- END: main -->