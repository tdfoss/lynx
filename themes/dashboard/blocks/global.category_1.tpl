<!-- BEGIN: submenu -->
<ul class="treeview-menu">
    <!-- BEGIN: loop -->
    <li>
        <!-- BEGIN: strong --> <a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}><i class="fa fa-circle-o"></i>{SUBMENU.title_trim}</a> <!-- END: strong --> <!-- BEGIN: normal --> <a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a> <!-- END: normal --> <!-- BEGIN: item --> {SUB} <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->
<!-- BEGIN: main -->
<ul class="sidebar-menu hidden-xs hidden-sm" data-widget="tree">
    <!-- BEGIN: top_menu -->
    <li class="edm" ><a href="{TOP_MENU.link}" title="TOP_MENU.title">
    <i class="{TOP_MENU.css}"></i>
<span>{TOP_MENU.title_trim}</span> <!--  BEGIN: iconsub --> <span class="pull-right-container material-button-toggle"> <i class="fa fa-angle-left pull-right"></i>
        </span> <!--  END: iconsub -->
    </a> <!-- BEGIN: sub --> {SUB} <!-- END: sub --></li>
    <!-- END: top_menu -->
    <div class="clear"></div>
</ul>
<!-- END: main -->
