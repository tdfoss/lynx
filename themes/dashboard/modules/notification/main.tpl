<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.timeago.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.timeago-{NV_LANG>DATA}.js"></script>

<div class="notification">
	<!-- BEGIN: error -->
	{ERROR}
	<!-- END: error -->

	<!-- BEGIN: loop -->
	<div class="notify_item pointer <!-- BEGIN: view -->view<!-- END: view -->" onclick="nv_viewitem($(this));" data-item-id="{DATA.id}" data-item-url="{DATA.link}" data-view="{DATA.view}" data-item-module="{MODULE_NAME}">
		<div class="row">
			<div class="col-xs-3 col-sm-2 text-center">
				<img src="{DATA.photo}" alt="" class="img-thumbnail" style="background: #dddddd" />
			</div>
			<div class="col-xs-21 col-sm-22">
				{DATA.title}<br />
				<abbr class="timeago" title="{DATA.add_time_iso}">{DATA.add_time}</abbr>
			</div>
		</div>
	</div>
	<!-- END: loop -->

	<!-- BEGIN: alias_page -->
	<div class="text-center">{PAGE}</div>
	<!-- END: alias_page -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("abbr.timeago").timeago();
	});
</script>
<!-- END: main -->