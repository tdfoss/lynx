<!-- BEGIN: main -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <em class="fa fa-user fa-lg user-image"></em>
              <span class="hidden-xs">{GLANG.signin} - {GLANG.register}</span>
            </a>
<ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{NV_BASE_SITEURL}themes/dashboard/images/1005206.png" class="img-circle" alt="{GLANG.signin} - {GLANG.register}" style="max-width:60px;">
                <p>{LANG.login_info}
                  <small>TDFOSS.,LTD</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  {FILE "login_form.tpl"}
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{USER_LOSTPASS}" class="btn btn-default btn-flat">{GLANG.lostpass}?</a>
                </div>
                <div class="pull-right">
                  <a href="{USER_REGISTER}" class="btn btn-default btn-flat">Đăng ký
                  </a>
                </div>
              </li>
              
            </ul>
<!-- START FORFOOTER -->
<!-- END FORFOOTER -->
<!-- BEGIN: datepicker -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<!-- END: datepicker -->
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{BLOCK_JS}/js/users.js"></script>
<!-- END: main -->

<!-- BEGIN: signed -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{AVATA}" class="user-image" alt="User Image" style="max-width:60px;">
              <span class="hidden-xs">{USER.full_name}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <a title="{LANG.edituser}" class="edituser" href="#" onclick="changeAvatar('{URL_AVATAR}')"><img src="{AVATA}" class="img-circle" alt="{USER.full_name}" style="max-width:60px;"></a>
                <p>
                 <a href="{URL_MODULE}" class="user-a">{LANG.user_info}</a> - <a class="user-a" href="{URL_HREF}editinfo">{LANG.editinfo}</a>
                  <small>{WELCOME} : {USER.full_name}</small>
                </p>
              </li>
               <!-- BEGIN: admintoolbar -->
               <p class="margin-bottom-sm p-10 f-s15"><strong>{GLANG.for_admin}</strong></p>
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-24 text-left">
                    <a href="{NV_BASE_SITEURL}{NV_ADMINDIR}/index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}" title="{GLANG.admin_page}">{GLANG.admin_page}</a>
                  </div>
                  <!-- BEGIN: is_modadmin -->
                  <div class="col-xs-24 text-left">
                    <a href="{URL_ADMINMODULE}" title="{GLANG.admin_module_sector} {MODULENAME}">{GLANG.admin_module_sector} {MODULENAME}</a>
                  </div>
                  <!-- END: is_modadmin -->
                  <!-- BEGIN: is_spadadmin -->
                  <div class="col-xs-24 text-left">
                    <a href="{URL_DBLOCK}" title="{LANG_DBLOCK}">{LANG_DBLOCK}</a>
                  </div>
                  <!-- END: is_spadadmin -->
                  <div class="col-xs-24 text-left">
                    <a href="{URL_AUTHOR}" title="{GLANG.admin_view}">{GLANG.admin_view}</a>
                  </div>
                </div>
              </li>
               <!-- END: admintoolbar -->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" title="{LANG.current_login}">{USER.current_login_txt}</a>
                </div>
                <div class="pull-right">
                  <a href="#" onclick="{URL_LOGOUT}(this);" class="btn btn-default btn-flat">{LANG.logout_title}</a>
                </div>
              </li>
            </ul>
<script src="{NV_BASE_SITEURL}themes/{BLOCK_JS}/js/users.js"></script>
<!-- END: signed -->