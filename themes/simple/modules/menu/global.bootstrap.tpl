<!-- BEGIN: submenu -->
<ul class="dropdown-menu">
	<!-- BEGIN: loop -->
	<li
		<!-- BEGIN: submenu -->class="dropdown-submenu"<!-- END: submenu -->>
		<!-- BEGIN: icon --> <img src="{SUBMENU.icon}" />&nbsp; <!-- END: icon -->
		<a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a>
		<!-- BEGIN: item --> {SUB} <!-- END: item -->
	</li>
	<!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Start Bootstrap</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="#">About</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
<!-- END: main -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="menu-site-default">
			<ul class="nav navbar-nav">
				<li
					<!-- BEGIN: home_active --> class="active"<!-- END: home_active -->>
					<a title="{LANG.Home}" href="{THEME_SITE_HREF}"><em
						class="fa fa-lg fa-home">&nbsp;</em> {LANG.Home}</a>
				</li>
				<!-- BEGIN: top_menu -->
				<li {TOP_MENU.current} rol="presentation">
					<!-- BEGIN: icon --> <img src="{TOP_MENU.icon}" />&nbsp; <!-- END: icon -->
					<a
						<!-- BEGIN: has_sub --> class="dropdown-toggle"
						aria-expanded="false" <!-- END: has_sub --> href="{TOP_MENU.link}"
						role="button" title="{TOP_MENU.note}"
						{TOP_MENU.target}>{TOP_MENU.title_trim} <!-- BEGIN: caret --> <span
						class="caret"></span> <!-- END: caret -->
				</a> <!-- BEGIN: sub --> {SUB} <!-- END: sub -->
				</li>
				<!-- END: top_menu -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://mynukeviet.net" title="Ứng dụng NukeViet"><em
						class="fa fa-globe">&nbsp;</em> Ứng dụng NukeViet</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>