<!-- BEGIN: main -->
 <!-- BEGIN: guest -->
        <a href="#" onclick="return loginForm('');" class="dropdown-toggle" data-toggle="dropdown" title="{LANG.login}">
              <i class="fa fa-bell-o"></i>
            </a>
        <!-- END: guest -->
        <!-- BEGIN: user -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{COUNT}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Bạn có {COUNT} Thông báo</li>
              <li>
              <!-- BEGIN: data -->
                <ul class="menu">
                 <!-- BEGIN: loop -->
                 <li class="item " onclick="nv_viewitem($(this));" data-item-id="4271" data-item-url="https://client.tdfoss.vn/index.php?language=vi&amp;nv=task&amp;type=1" data-view="0" data-item-module="notification">
                       <div>
                      <div class=col-xs-3>
                       <img src="{DATA.photo}" alt="" width="100%">
                      </div> 
                        <div class="col-xs-21">
                                   <span class="show">{DATA.title}</span>
									<abbr class="timeago" title="{DATA.add_time_iso}">{DATA.add_time}</abbr>
                    </div>
                    </div>
                    </li>
              <!-- END: loop -->
                </ul>
                <!-- END: data -->
                <!-- BEGIN: empty -->
                <ul class="menu">{LANG.notification_empty}</ul>
                <!-- END: empty -->
              </li>
              <li class="footer"><a href="{VIEW_ALL}" title="{LANG.viewall}">{LANG.viewall}</a></li>
              <li class="footer"><a href="#" data-module="{MODULE_NAME}" data-readallok="{LANG.readall_ok}" title="{LANG.readall}">{LANG.readall}</a></li>
            </ul>
            <!-- END: user -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery/jquery.timeago.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.timeago-{NV_LANG>DATA}.js"></script>
<!-- END: main -->