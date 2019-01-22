
<!-- BEGIN: lt_ie9 -->
<p class="chromeframe">{LANG.chromeframe}</p>
<!-- END: lt_ie9 -->
<div id="timeoutsess" class="chromeframe">
    {LANG.timeoutsess_nouser}, <a onclick="timeoutsesscancel();" href="#">{LANG.timeoutsess_click}</a>. {LANG.timeoutsess_timeout}: <span id="secField"> 60 </span> {LANG.sec}
</div>
<div id="openidResult" class="nv-alert" style="display: none"></div>
<div id="openidBt" data-result="" data-redirect=""></div>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/bootstrap.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.slimscroll.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/fastclick.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/adminlte.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/demo.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.sparkline.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/Chart.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/dashboard2.js"></script>
<script>
jQuery(document).ready(function() { 
    fadeMenuWrap(); 
    jQuery(window).scroll(fadeMenuWrap);
});

function fadeMenuWrap() { 
    var scrollPos = window.pageYOffset || document.documentElement.scrollTop; 
    if (scrollPos > 300) { 
        jQuery('.bttop').fadeIn(300); 
    } else { 
        jQuery('.bttop').fadeOut(300); 
    } 
} 
</script>
<script>
        $(function(){
            $(".edm").hover(
              function () {
                $(this).toggleClass('menu-open');
              }, 
              function () {
                $(this).toggleClass('menu-open');
              }
            );
        });
        </script>
<script type="text/javascript">
// $(document).ready(function () {
//     $('.material-button-toggle').on("click", function () {
//         $(this).toggleClass('open');
//         $('.dropdown.open').toggleClass('close-up');
//     });
//     });

</script>
<script>
// $(document).ready(function () {
// $('.button-push-menu').on('click',function(){
//     $('.button-skin').removeClass('sidebar-collapse');
//     $(this).addClass('sidebar-collapse');
// });
// });
        </script>
</body>
</html>