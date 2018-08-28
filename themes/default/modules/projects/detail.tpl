<!-- BEGIN: main -->
<ul class="pull-right list-inline">
    <li><a href="{CONTROL.url_creatinvoice}" class="btn btn-primary btn-xs"><em class="fa fa-file-text">&nbsp;</em>{LANG.creatinvoice}</a></li>
    <li><a href="{CONTROL.url_sendmail}" class="btn btn-primary btn-xs"><em class="fa fa-envelope">&nbsp;</em>{LANG.sendmail}</a></li>
    <li><a href="{CONTROL.url_add}" class="btn btn-primary btn-xs"><em class="fa fa-sign-in">&nbsp;</em>{LANG.project_add}</a></li>
    <li><a href="{CONTROL.url_edit}" class="btn btn-default btn-xs"><em class="fa fa-edit">&nbsp;</em>{LANG.project_edit}</a></li>
    <li><a href="{CONTROL.url_delete}" class="btn btn-danger btn-xs" onclick="return confirm(nv_is_del_confirm[0]);"><em class="fa fa-trash-o">&nbsp;</em>{LANG.delete}</a></li>
</ul>
<div class="clearfix"></div>
<div class="row">
    <div class="col-xs-24 col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{ROW.title}</div>
            <div class="panel-body">
                <ul class="list-info m-bottom">
                    <li><label>{LANG.customerid}</label><a href="{ROW.customer.link_view}">{ROW.customer.fullname}</a></li>
                    <li><label>{LANG.workforceid}</label>{ROW.performer_str}</li>
                    <li><label>{LANG.price}</label>{ROW.price}</li>
                    <li><label>{LANG.vat}</label>{ROW.vat}</li>
                    <li><label>{LANG.begintime}</label>{ROW.begintime}</li>
                    <li><label>{LANG.endtime}</label>{ROW.endtime}</li>
                    <li><label>{LANG.realtime}</label>{ROW.realtime}</li>
                    <li><label>{LANG.typeid}</label>{ROW.type_id}</li>
                    <li><label>{LANG.url_code}</label><a href="{ROW.url_code}" target="_blank">{ROW.url_code}</a></li>
                    <li><label class="pull-left" style="margin-top: 6px">{LANG.status}</label> <select class="form-control" style="width: 200px" id="change_status_{ROW.id}" onchange="nv_chang_status('{ROW.id}');">
                            <!-- BEGIN: status -->
                            <option value="{STATUS.index}"{STATUS.selected}>{STATUS.value}</option>
                            <!-- END: status -->
                    </select></li>
                </ul>
            </div>
        </div>
        <!-- BEGIN: content -->
        <div class="panel panel-default">
            <div class="panel-heading">{LANG.content}</div>
            <div class="panel-body">{ROW.content}</div>
        </div>
        <!-- END: content -->
    </div>
    <div class="col-xs-24 col-sm-12 col-md-12">
        <!-- BEGIN: task_list -->
        <div id="task_list">{TASK_LIST}</div>
        <div class="text-center m-bottom">
            <button class="btn btn-success btn-xs" onclick="nv_task_content(0, {ROW.id});">{LANG.task_add}</button>
        </div>
        <!-- END: task_list -->
        <!-- BEGIN: comment -->
        <div class="panel panel-default">
            <div class="panel-body">{COMMENT}</div>
        </div>
        <!-- END: comment -->
    </div>
</div>
<!-- END: main -->
<!-- BEGIN: task_list -->
<div class="panel panel-default">
    <div class="panel-heading">{LANG.task_list}</div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th width="40"></th>
                <th>{LANG.title}</th>
                <th>{LANG.workforceid}</th>
                <th>{LANG.task_begin_time}</th>
                <th>{LANG.task_end_time}</th>
                <th>{LANG.status}</th>
                <th width="50"></th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td class="text-center">{TASK.number}</td>
                <td>{TASK.title}</td>
                <td>{TASK.performer_str}</td>
                <td>{TASK.begintime}</td>
                <td>{TASK.endtime}</td>
                <td>{TASK.status}</td>
                <td><a href="" class="btn btn-default btn-xs" onclick="nv_task_content({TASK.taskid}, {TASK.projectid});"><i class="fa fa-edit"></i></a></td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: task_list -->
