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
<ul class="sidebar-menu">
 <!-- BEGIN: top_menu -->
<li{TOP_MENU.current}  rol="presentation">
          <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" >
          <!-- BEGIN: icon --><div class="icon-img"><img src="{TOP_MENU.icon}" alt="nav-cat" class="img-responsive"></div><!-- END: icon --> 
          <span>{TOP_MENU.title_trim}</span>
          </a>
          <!--  BEGIN: iconsub -->
            <span class="material-button-toggle ">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          <!--  END: iconsub -->
          
          <!-- BEGIN: sub -->
          {SUB}
          <!-- END: sub -->
        </li>
<!-- END: top_menu -->
  <div class="clear"></div>
      </ul>
<script type="text/javascript">
$(document).ready(function () {
    $('.material-button-toggle').on("click", function () {
        $(this).toggleClass('open');
        $('.expand-menu').toggleClass('close-up');
    });
});
</script>
<!-- END: main -->