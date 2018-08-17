<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.timeago.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.timeago-{NV_LANG>DATA}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.slimscroll.min.js"></script>

<div id="notification_load" style="height: 350px; font-size: 13px">
	<!-- BEGIN: loop -->
	<div class="notify_item">
		<div class="row">
			<div class="col-xs-4">
				<img src="{DATA.photo}" alt="" class="img-thumbnail" style="background: #dddddd" />
			</div>
			<div class="col-xs-20">
				{DATA.title}
				<abbr class="timeago" title="{DATA.add_time_iso}">{DATA.add_time}</abbr>
			</div>
		</div>
	</div>
	<hr />
	<!-- END: loop -->
	<p class="text-center"><a href="{URL}" title="{LANG.viewall}">{LANG.viewall}</a></p>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("abbr.timeago").timeago();
		$('#notification_load').slimScroll({
			height : '350px'
		});
	});
</script>
<!-- END: main -->