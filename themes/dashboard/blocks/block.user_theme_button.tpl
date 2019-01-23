<!-- BEGIN: main -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <em class="fa fa-user fa-lg user-image"></em>
              <span class="hidden-xs">{GLANG.signin} - {GLANG.register}</span>
            </a>
<ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{NV_BASE_SITEURL}themes/dashboard/images/1005206.png" class="img-circle" alt="{GLANG.signin} - {GLANG.register}">
                <p>{LANG.login_info}
                  <small>TDFOSS.,LTD</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
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
<div class="pull-left image">
          <img src="{AVATA}" class="img-circle" alt="{LANG.edituser}">
        </div>
        <div class="pull-left info">
          <p>{USER.full_name}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
<script src="{NV_BASE_SITEURL}themes/{BLOCK_JS}/js/users.js"></script>
<!-- END: signed -->