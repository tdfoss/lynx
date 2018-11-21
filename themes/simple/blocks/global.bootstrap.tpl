<!-- BEGIN: submenu -->
<ul class="dropdown-menu">
    <!-- BEGIN: loop -->
    <li
        <!-- BEGIN: submenu -->class="dropdown-submenu"<!-- END: submenu -->> <!-- BEGIN: icon --> <img src="{SUBMENU.icon}" />&nbsp; <!-- END: icon --> <a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a> <!-- BEGIN: item --> {SUB} <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- <div class="navbar navbar-default navbar-static-top" role="navigation"> -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-site-default">
                <span class="sr-only">&nbsp;</span> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="menu-site-default">
            <ul class="nav navbar-nav">
                <li><a class="home" title="{LANG.Home}" href="{THEME_SITE_HREF}"><em class="fa fa-lg fa-home">&nbsp;</em><span class="visible-xs-inline-block"> {LANG.Home}</span></a></li>
                <!-- BEGIN: top_menu -->
                <li {TOP_MENU.current} rol="presentation">
                    <!-- BEGIN: icon --> <img src="{TOP_MENU.icon}" />&nbsp; <!-- END: icon --> <a class="dropdown-toggle" {TOP_MENU.dropdown_data_toggle} href="{TOP_MENU.link}" role="button" aria-expanded="false" title="{TOP_MENU.note}"{TOP_MENU.target}>{TOP_MENU.title_trim}
                    </a>
                    <!-- BEGIN: has_sub --> <strong class="caret-down fa fa-angle-down fa-2 material-button-toggle"  aria-hidden="true">&nbsp;</strong> <!-- END: has_sub -->
                     <!-- BEGIN: sub --> {SUB} <!-- END: sub -->
                </li>
                <!-- END: top_menu -->
            </ul>
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN: user -->
                <li><a title="{LANG_THEME.userinfo}" href="{URL_USERINFO}"><em class="fa fa-lg fa-user">&nbsp;</em>{LANG_THEME.userinfo}</a></li>
                <!-- END: user -->
                <!-- BEGIN: guest -->
                <li><a title="{LANG_THEME.login}" href="{URL_LOGIN}"><em class="fa fa-lg fa-sign-in">&nbsp;</em>{LANG_THEME.login}</a></li>
                <!-- END: guest -->
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript" data-show="after">
    $(function() {
        checkWidthMenu();
        $(window).resize(checkWidthMenu);
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('.material-button-toggle').on("click", function () {
        $(this).toggleClass('open');
        $('.dropdown.open').toggleClass('close-up');
    });
});
</script>
<!-- END: main -->
