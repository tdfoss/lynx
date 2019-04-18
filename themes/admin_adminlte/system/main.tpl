<!-- BEGIN: main -->
{FILE "header.tpl"}
<div class="wrapper">
		<header class="main-header">
				<!-- Logo -->
				<a
                        title="Lynx CMR"
						href="{NV_BASE_SITEURL}{NV_ADMINDIR}/index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}"
						class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
						<span class="logo-mini"><img class="logo-xs"
								alt="{NV_SITE_NAME}"
								src="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/images/logo-xs.png"
								width="45" height="45" /></span> <!-- logo for regular state and mobile devices -->
						<span class="logo-lg"><img class="logo-md"
								alt="{NV_SITE_NAME}"
								src="{NV_BASE_SITEURL}themes/{NV_ADMIN_THEME}/images/logo_small.png" /></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
						<!-- Sidebar toggle button-->
						<a href="#" class="sidebar-toggle"
								data-toggle="push-menu" role="button"> <span
								class="sr-only">Toggle navigation</span>
						</a>
						<!-- Navbar Right Menu -->
						<div class="navbar-custom-menu">
								<ul class="nav navbar-nav">
										<!-- BEGIN: notification -->
										<li class="dropdown messages-menu"
												id="notification-area"><a href="#"
												class="dropdown-toggle" data-toggle="dropdown">
														<i class="fa fa-bell-o fa-lg"></i> <span
														id="notification" class="label label-danger"
														style="display: none"></span>
										</a>
												<ul class="dropdown-menu">
														<li>
																<div id="notification_load"></div>
																<div id="notification_waiting">
																		<div class="text-center">
																				<i class="fa fa-spin fa-spinner"></i>
																		</div>
																</div>
														</li>
														<li class="footer"><a
																href="{NV_GO_ALL_NOTIFICATION}">{LANG.view_all}</a></li>
												</ul></li>
										<!-- END: notification -->
										<li><a href="{NV_GO_CLIENTSECTOR_URL}"
												data-toggle="tooltip" data-placement="bottom"
												title="{NV_GO_CLIENTSECTOR}"><i
														class="fa fa-home fa-lg"></i></a></li>
										<!-- User Account: style can be found in dropdown.less -->
										<li class="dropdown user user-menu"><a
												href="#" class="dropdown-toggle"
												data-toggle="dropdown"> <img
														src="{ADMIN_PHOTO}" class="user-image"
														alt="{ADMIN_USERNAME}"> <span
														class="hidden-xs">{ADMIN_USERNAME}</span>
										</a>
												<ul class="dropdown-menu">
														<!-- {ADMIN_USERNAME} -->
														<li class="user-header"><img
																src="{ADMIN_PHOTO}" class="img-circle"
																alt="{ADMIN_USERNAME}">
																<p>
																		{ADMIN_USERNAME}<small>IP:
																				{ADMIN_IP}</small>
																</p></li>
														<!-- Menu Body -->
														<!-- Menu Footer-->
														<li class="user-footer">
																<div class="pull-left"></div>
																<div class="pull-right">
																		<a href="javascript:void(0);"
																				class="btn btn-default btn-flat"
																				onclick="nv_admin_logout();">{NV_LOGOUT}</a>
																</div>
														</li>
												</ul></li>
								</ul>
						</div>
				</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
						<!-- Sidebar user panel -->
						<div class="user-panel">
								<div class="pull-left image">
										<img src="{ADMIN_PHOTO}" class="img-circle"
												alt="{ADMIN_USERNAME}">
								</div>
								<div class="pull-left info">
										<p>{ADMIN_USERNAME}</p>
										<a href="#"><i
												class="fa fa-circle text-success"></i> Online</a>
								</div>
						</div>
						<!-- sidebar menu: : style can be found in sidebar.less -->
						<ul class="sidebar-menu">
								<!-- BEGIN: menu_loop -->
								<li class="treeview {MENU_CLASS}"><a
										href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MENU_HREF}"><em
												class="fa fa-{MODULE_ICON}"></em><span>{MENU_NAME}</span></a>
										<!-- BEGIN: submenu -->
										<ul class="treeview-menu">
												<!-- BEGIN: loop -->
												<li><a
														href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MENU_SUB_HREF}&amp;{NV_OP_VARIABLE}={MENU_SUB_OP}">{MENU_SUB_NAME}</a></li>
												<!-- END: loop -->
										</ul> <!-- END: submenu --> <!-- BEGIN: current -->
										<ul class="treeview-menu">
												<!-- BEGIN: loop -->
												<li class="{MENU_SUB_CURRENT}"><a
														href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MENU_SUB_HREF}&amp;{NV_OP_VARIABLE}={MENU_SUB_OP}">{MENU_SUB_NAME}</a>
														<!-- BEGIN: submenu -->
														<ul class="treeview-menu">
																<!-- BEGIN: loop -->
																<li><a
																		href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MENU_SUB_HREF}&amp;{NV_OP_VARIABLE}={CUR_SUB_OP}">{CUR_SUB_NAME}</a></li>
																<!-- END: loop -->
														</ul> <!-- END: submenu --></li>
												<!-- END: loop -->
										</ul> <!-- END: current --></li>
								<!-- END: menu_loop -->
						</ul>
				</section>
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="navbar navbar-inverse navbar-static-top"
						role="navigation">
						<div class="container-fluid">
								<div class="navbar-header">
										<button type="button" class="navbar-toggle"
												data-toggle="collapse"
												data-target="#menu-horizontal">
												<span class="sr-only">&nbsp;</span> <span
														class="icon-bar">&nbsp;</span> <span
														class="icon-bar">&nbsp;</span> <span
														class="icon-bar">&nbsp;</span>
										</button>
								</div>
								<div class="collapse navbar-collapse"
										id="menu-horizontal">
										<ul class="nav navbar-nav">
												<!-- BEGIN: top_menu_loop -->
												<li{TOP_MENU_CLASS}><a
														href="{NV_BASE_SITEURL}{NV_ADMINDIR}/index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={TOP_MENU_HREF}">{TOP_MENU_NAME}<!-- BEGIN: has_sub -->
																<strong class="caret">&nbsp;</strong> <!-- END: has_sub --></a>
														<!-- BEGIN: submenu -->
														<ul class="dropdown-menu">
																<!-- BEGIN: submenu_loop -->
																<li><a href="{SUBMENULINK}"
																		title="{SUBMENUTITLE}">{SUBMENUTITLE}</a></li>
																<!-- END: submenu_loop -->
														</ul> <!-- END: submenu --></li>
												<!-- END: top_menu_loop -->
										</ul>
								</div>
						</div>
				</div>
				<section class="content-header">
						<!-- BEGIN: breadcrumbs -->
						<div class="pull-left">
								<!-- BEGIN: loop -->
								<h1
										<!-- BEGIN: active -->
										class="active"
										<!-- END: active -->
										>
										<!-- BEGIN: text -->
										{BREADCRUMBS.title}
										<!-- END: text -->
										<!-- BEGIN: linked -->
										<a href="{BREADCRUMBS.link}">{BREADCRUMBS.title}</a>
										<!-- END: linked -->
								</h1>
								<!-- END: loop -->
						</div>
						<!-- END: breadcrumbs -->
						<ul class="pull-right list-inline btncontrol">
								<!-- BEGIN: url_instruction -->
								<li><a target="_blank"
										href="{NV_URL_INSTRUCTION}" data-toggle="tooltip"
										data-placement="bottom" title=""
										data-original-title="{NV_INSTRUCTION}"><em
												class="fa fa-book fa-lg">&nbsp;</em></a></li>
								<!-- END: url_instruction -->
								<!-- BEGIN: site_mods -->
								<li><a target="_blank"
										href="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}"
										data-toggle="tooltip" data-placement="bottom"
										title="" data-original-title="{NV_GO_CLIENTMOD}"><em
												class="fa fa-globe fa-lg">&nbsp;</em></a></li>
								<!-- END: site_mods -->
						</ul>
						<!-- BEGIN: select_option -->
						<div class="pull-right btn-group">
								<button
										class="btn btn-default btn-xs dropdown-toggle"
										type="button" data-toggle="dropdown">
										{PLEASE_SELECT} <span class="caret">&nbsp;</span>
								</button>
								<ul class="dropdown-menu">
										<!-- BEGIN: select_option_loop -->
										<li><a href="{SELECT_VALUE}">{SELECT_NAME}</a></li>
										<!-- END: select_option_loop -->
								</ul>
						</div>
						<!-- END: select_option -->
						<div class="clearfix"></div>
				</section>
				<!-- Main content -->
				<section class="content module-{MODULE_NAME}">{MODULE_CONTENT}</section>
				<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
				<div class="pull-right hidden-xs">[MEMORY_TIME_USAGE]</div>
				{NV_COPYRIGHT}
		</footer>
</div>
{FILE "footer.tpl"}
<!-- END: main -->