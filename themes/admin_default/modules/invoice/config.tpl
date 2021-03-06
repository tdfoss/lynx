<!-- BEGIN: main -->
<form action="" method="post" class="form-horizontal">
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.general}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_groups_admin}</label>
                <div class="col-sm-20" style="height: 200px; padding: 10px; border: solid 1px #ddd; overflow: scroll;">
                    <!-- BEGIN: groups_use -->
                    <label class="show"><input type="checkbox" name="groups_admin[]" value="{GROUPS_USE.value}" {GROUPS_USE.checked} />{GROUPS_USE.title}</label>
                    <!-- END: groups_use -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_groups_manage}</label>
                <div class="col-sm-20" style="height: 200px; padding: 10px; border: solid 1px #ddd; overflow: scroll;">
                    <!-- BEGIN: groups -->
                    <label class="show"><input type="checkbox" name="groups_manage[]" value="{GROUPS.value}" {GROUPS.checked} />{GROUPS.title}</label>
                    <!-- END: groups -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 text-right">{LANG.config_default_status}</label>
                <div class="col-sm-20">
                    <!-- BEGIN: status -->
                    <label><input type="checkbox" name="default_status[]" value="{STATUS.index}"{STATUS.checked}>{STATUS.value}</label>
                    <!-- END: status -->
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{LANG.score}</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 text-right">{LANG.config_score_allow}</label>
                <div class="col-sm-20">
                    <label><input type="checkbox" name="score_allow" value="1" {DATA.ck_score_allow} />{LANG.config_score_allow_note}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_score_money}</label>
                <div class="col-sm-20">
                    <input class="form-control" type="text" name="score_money" value="{DATA.score_money}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_money_score}</label>
                <div class="col-sm-20">
                    <input class="form-control" type="text" name="money_score" value="{DATA.money_score}" />
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary" value="{LANG.save}" name="savesetting" />
    </div>
</form>
<!-- END: main -->
