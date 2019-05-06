<!-- BEGIN: tree -->
<li><a title="{MENUTREE.note}" href="{MENUTREE.link}" class="sf-with-ul"{MENUTREE.target}><strong>{MENUTREE.title}</strong></a> <!-- BEGIN: tree_content -->
    <ul>{TREE_CONTENT}
    </ul> <!-- END: tree_content --></li>
<!-- END: tree -->
<!-- BEGIN: main -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-plus-square"></i> 
<!-- <span class="label label-success">4</span> -->
</a>
<ul class="dropdown-menu">
    <li>
        <ul class="menu menu_select">
        <!-- BEGIN: loopcat1 -->
            <li><a href="{CAT1.link}"{CAT1.target} title="{CAT1.note}">
                    <div class="icon_select">
                        <i {CAT1.class}></i>
                    </div>
                    <h3>{CAT1.title}</h3>
            </a></li>
            <!-- END: loopcat1 -->
        </ul>
    </li>
</ul>
<!-- END: main -->
<div class="style_nav">
    <ul id="sample-menu-4" class="sf-menu sf-navbar sf-js-enabled sf-shadow">
        <!-- BEGIN: loopcat1 -->
        <li{CAT1.class}><a title="{CAT1.note}" class="sf-with-ul" href="{CAT1.link}"{CAT1.target}><strong>{CAT1.title}</strong></a> <!-- BEGIN: cat2 -->
            <ul>{HTML_CONTENT}
            </ul> <!-- END: cat2 --></li>
        <!-- END: loopcat1 -->
    </ul>
</div>
<div class="clear"></div>
