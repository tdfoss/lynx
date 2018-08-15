<!-- BEGIN: main -->
<div class="table-responsive" style="max-height: 200px; overflow: scroll;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>{LANG.fullname}</th>
                <th>{LANG.log_time}</th>
                <th>{LANG.content}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td>{LOGS.fullname}</td>
                <td>{LOGS.log_time}</td>
                <td>[{LOGS.name_key}]: {LOGS.note_action}</td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: main -->
