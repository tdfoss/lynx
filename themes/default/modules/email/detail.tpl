<!-- BEGIN: main -->
<div class="detail">
    <ul class="pull-right list-inline">
        <li><a href="{CONTROL.url_add}" class="btn btn-primary btn-xs"><em class="fa fa-sign-in">&nbsp;</em>{LANG.add_new}</a></li>
        <!-- BEGIN: send -->
        <li><a href="{CONTROL.url_edit}" class="btn btn-primary btn-xs"><em class="fa fa-pencil-square-o">&nbsp;</em>{LANG.edit}</a></li>
        <!-- END: send -->
        <li><a href="{CONTROL.url_delete}" class="btn btn-danger btn-xs" onclick="return confirm(nv_is_del_confirm[0]);"><em class="fa fa-trash-o">&nbsp;</em>{LANG.delete}</a></li>
    </ul>
    <div class="clearfix"></div>
    <div class="panel panel-default">
        <div class="panel-heading">{EMAILIF.title}</div>
        <div class="panel-body">
            <ul class="list-info m-bottom">
                <li><label>{LANG.useradd}</label>{EMAILIF.useradd}</li>
                <li><label>{LANG.sendto}</label>{EMAILIF.sendto}</li>
                <!-- BEGIN: cc -->
                <li><label>Cc</label>{EMAILIF.cclist}</li>
                <!-- END: cc -->
                <li><label>{LANG.addtime}</label>{EMAILIF.addtime}</li>
                <!-- BEGIN: file -->
                <li><label>{LANG.files}</label><em class="fa fa-download">&nbsp;</em><a href="{EMAILIF.url_file_download}" target="_blank">{EMAILIF.files}</a></li>
                <!-- END: file -->
                <li><label>{LANG.status}</label>{EMAILIF.status}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.content}</div>
        <div class="panel-body content">{EMAILIF.content}</div>
    </div>
</div>
<!-- END: main -->