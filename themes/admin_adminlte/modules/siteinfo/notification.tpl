<!-- BEGIN: main -->
<div id="notification-lists">
    <ul class="dropdown-menu">
        <li class="header">You have 4 messages</li>
        <!-- BEGIN: loop -->
        <li>
            <!-- inner menu: contains the messages -->
            <ul class="menu">
                <li><a href="{DATA.link}">
                        <div class="pull-left">
                            <img src="{DATA.photo}" class="img-circle" alt="">
                        </div>
                        <h4>{DATA.title}</h4> <abbr class="timeago" title="{DATA.add_time_iso}">{DATA.add_time}</abbr>
                </a></li>
                <!-- end message -->
            </ul> <!-- /.menu -->
        </li>
        <!-- END: loop -->
        <li class="footer"><a href="#">See All Messages</a></li>
    </ul>
</div>

<!-- BEGIN: generate_page -->
<div class="clearfix notification-pages">{GENERATE_PAGE}</div>
<!-- END: generate_page -->

<!-- END: main -->

<!-- BEGIN: empty -->
<div class="alert alert-info">{LANG.notification_empty}</div>
<!-- END: empty -->