<!-- BEGIN: submenu -->
<ul class="treeview-menu">
<!-- BEGIN: loop -->
	<li>
		<!-- BEGIN: strong -->
			<a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}><i class="fa fa-circle-o"></i>{SUBMENU.title_trim}</a>
		<!-- END: strong -->
		
		<!-- BEGIN: normal -->
		<a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a>
		<!-- END: normal -->
		
		<!-- BEGIN: item --> {SUB} <!-- END: item -->
	</li>
<!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<!-- BEGIN: top_menu -->
<li{TOP_MENU.current} class="treeview" role="button" aria-expanded="false" {TOP_MENU.target}>
          <a href="{TOP_MENU.link}" title="{TOP_MENU.note}">
          <!-- BEGIN: icon --><div class="icon-img"><img src="{TOP_MENU.icon}" alt="nav-cat" class="img-responsive"></div><!-- END: icon --> 
          <span>{TOP_MENU.title_trim}</span>
           <!--  BEGIN: iconsub -->
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             <!--  END: iconsub -->
          </a>
          <!-- BEGIN: sub -->
          {SUB}
          <!-- BEGIN: sub -->
        </li>   
<!-- END: main -->
<!-- END: top_menu -->