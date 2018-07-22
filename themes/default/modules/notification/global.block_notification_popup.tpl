<!-- BEGIN: main -->
<div class="notification-popup">
	<div class="navbar pull-right">
		<!-- BEGIN: guest -->
		<a href="#" onclick="return loginForm('');" title="{LANG.login}">
			<em class="fa fa-bell-o fa-2x">&nbsp;</em>
		</a>
		<!-- END: guest -->
		<!-- BEGIN: user -->
		<a class="dropdown-toggle" href="#" data-toggle="dropdown">
			<em class="fa fa-bell-o fa-2x">&nbsp;</em><span id="notification-number">{COUNT}</span>
		</a>
		<div class="dropdown-menu">
			<div id="notification-box">
				<!-- BEGIN: data -->
				<ul class="notification-list">
					<!-- BEGIN: loop -->
					<li class="item <!-- BEGIN: view -->view<!-- END: view -->" onclick="nv_viewitem($(this));" data-item-id="{DATA.id}" data-item-url="{DATA.link}" data-view="{DATA.view}" data-item-module="{MODULE_NAME}">
						<div class="row">
							<div class="col-xs-3">
								<img src="{DATA.photo}" alt="" class="img-thumbnail" style="background: #dddddd" />
							</div>
							<div class="col-xs-21">
								<p>
									<span class="show">{DATA.title}</span>
									<abbr class="timeago" title="{DATA.add_time_iso}">{DATA.add_time}</abbr>
								</p>
							</div>
						</div>
					</li>
					<!-- END: loop -->
				</ul>
				<!-- END: data -->

				<!-- BEGIN: empty -->
				<p class="text-center">{LANG.notification_empty}</p>
				<!-- END: empty -->
			</div>
			<ul class="text-center list-inline">
				<li><a href="{VIEW_ALL}" title="{LANG.viewall}">{LANG.viewall}</a></li>
				<li><a id="readall" href="#" data-module="{MODULE_NAME}" data-readallok="{LANG.readall_ok}" title="{LANG.readall}">{LANG.readall}</a></li>
			</ul>
		</div>
		<!-- END: user -->
	</div>
	<div class="clearfix"></div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.timeago.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.timeago-{NV_LANG>DATA}.js"></script>
<!-- END: main -->