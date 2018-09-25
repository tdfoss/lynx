<!-- BEGIN: main -->
<div class="table-responsive" style="max-height: {CONFIG.height">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>{LANG.content}</th>
                <th width="150">{LANG.log_time}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td><a href="{LOGS.link_acess}"><strong>{LOGS.fullname}</strong> {LOGS.note_action}</a><!-- BEGIN: link --> <em class="fa fa-link pull-right">&nbsp;</em> <!-- END: link --></td>
                <td>{LOGS.log_time}</td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: main -->
