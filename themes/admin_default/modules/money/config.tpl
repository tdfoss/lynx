<!-- BEGIN: main -->
<form action="" method="post" class="form-horizontal">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label">{LANG.config_workgroup}</label>
                <div class="col-sm-20" style="height: 200px; padding: 10px; border: solid 1px #ddd; overflow: scroll;">
                    <!-- BEGIN: groups -->
                    <label class="show"><input type="checkbox" name="workgroup[]" value="{GROUPS.value}" {GROUPS.checked} />{GROUPS.title}</label>
                    <!-- END: groups -->
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary" value="{LANG.save}" name="savesetting" />
    </div>
</form>
<!-- END: main -->