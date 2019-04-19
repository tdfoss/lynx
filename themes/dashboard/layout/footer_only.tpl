
<!-- BEGIN: lt_ie9 -->
<p class="chromeframe">{LANG.chromeframe}</p>
<!-- END: lt_ie9 -->
<div id="timeoutsess" class="chromeframe">
    {LANG.timeoutsess_nouser}, <a onclick="timeoutsesscancel();" href="#">{LANG.timeoutsess_click}</a>. {LANG.timeoutsess_timeout}: <span id="secField"> 60 </span> {LANG.sec}
</div>
<div id="openidResult" class="nv-alert" style="display: none"></div>
<div id="openidBt" data-result="" data-redirect=""></div>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/bootstrap.min.js"></script>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.slimscroll.min.js"></script>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/fastclick.js"></script>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/adminlte.min.js"></script>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/TDconfig.js"></script>
<script defer src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.sparkline.min.js"></script>
 <script defer src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>

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
    $(function() {
        $(".edm").hover(function() {
            $(this).toggleClass('menu-open');
        }, function() {
            $(this).toggleClass('menu-open');
        });
    });
</script>
<script>
$(window).resize(function() {
	console.log('remove class');
	var width = $(window).width();
	if (width >= 0 && width <= 1024) {
		$('.remove_class').removeClass('sidebar-collapse').addClass('');
	} else {
		$('.remove_class').removeClass('').addClass('sidebar-collapse');
	}
}).resize();//trigger the resize event on page load.
</script>
</body>
</html>