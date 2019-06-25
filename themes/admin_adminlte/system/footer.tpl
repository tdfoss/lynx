
<div id="sitemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">&nbsp;</h3>
            </div>
            <div class="modal-body">
                <em class="fa fa-spinner fa-spin">&nbsp;</em>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/css/custom.css">

<!-- BEGIN: lt_ie9 -->
<p class="chromeframe">{LANG.chromeframe}</p>
<!-- END: lt_ie9 -->

<!-- BEGIN: ckeditor -->
<script type="text/javascript">
    for ( var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].on('key', function(e) {
            $(window).bind('beforeunload', function() {
                return '{LANG.msgbeforeunload}';
            });
        });
    }
</script>
<!-- END: ckeditor -->

<script type="text/javascript" src="{NV_BASE_SITEURL}themes/default/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/js/main.js"></script>

<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/js/notification.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.timeago.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.timeago-{NV_LANG_DATA}.js"></script>

<!-- AdminLTE App -->
<script src="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/dist/js/adminlte.min.js"></script>
<script>
$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
    EnableRemember: true,
    NoTransitionAfterReload: false
    //Removes the transition after page reload.
};

$(function () {
    "use strict";

    $("body").on("collapsed.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=closed";
        } 
    });
    $("body").on("expanded.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            document.cookie = "toggleState=opened";
        } 
    });

    if($.AdminLTESidebarTweak.options.EnableRemember){
        var re = new RegExp('toggleState' + "=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if(toggleState == 'closed'){
            if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function(){
                    $(this).removeClass('hold-transition'); 
                });
            }else{
                $("body").addClass('sidebar-collapse');
            }
        }
    } 
});
</script>
</body>
</html>