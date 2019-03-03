<!-- BEGIN: main -->
<form action="" method="post" class="form-horizontal">
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.config_onesignal}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_onesignal_appid}</label>
                <div class="col-sm-20">
                    <input class="form-control" name="onesignal_appid" value="{DATA.onesignal_appid}" />
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.config_slack}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_slack_tocken}</label>
                <div class="col-sm-20">
                    <input class="form-control" name="slack_tocken" value="{DATA.slack_tocken}" />
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary" value="{LANG.save}" name="savesetting" />
    </div>
</form>
<!-- END: main -->
