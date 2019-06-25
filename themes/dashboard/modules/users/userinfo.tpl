<!-- BEGIN: main -->
      <div class="row">
        <div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <div onclick="changeAvatar('{URL_AVATAR}');"  class="pointer">
              <img class="profile-user-img img-responsive img-circle" src="{IMG.src}" alt="{USER.username}" title="{USER.username}">
            </div>
              <p class="text-muted text-center">{IMG.title}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{LANG.account2}:</b> <a class="pull-right">{USER.username}</a>
                </li>
                <li class="list-group-item">
                  <b>Email :</b> <a class="pull-right">{USER.email}</a>
                </li>
                <li class="list-group-item">
                  <b>Truy cập:</b> <a class="pull-right">{USER.current_login}</a>
                </li>
                <li class="list-group-item">
                  <b>{LANG.ip}:</b> <a class="pull-right"> {USER.current_ip}</a>
                </li>
                <li class="list-group-item">
                  <b>{USER.current_mode}</b>
                </li>
              </ul>

              <a href="#" onclick="changeAvatar('{URL_AVATAR}');" class="btn btn-primary btn-block"><b>{IMG.title}</b></a>
            </div>
          </div>
          <!-- BEGIN: change_login_note -->
<div class="alert alert-danger">
    <em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.change_name_info}
</div>
<!-- END: change_login_note -->
<!-- BEGIN: pass_empty_note -->
<div class="alert alert-danger">
    <em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.pass_empty_note}
</div>
<!-- END: pass_empty_note -->
<!-- BEGIN: question_empty_note -->
<div class="alert alert-danger">
    <em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.question_empty_note}
</div>
<!-- END: question_empty_note -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thiết lập</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- BEGIN: navbar -->
            <a href="{NAVBAR.href}">  <strong><i class="fa fa-book margin-r-5"></i> {NAVBAR.title}</strong></a>
              <hr>
            <!-- END: navbar -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-18">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">{LANG.user_info}</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->

              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-12 control-label" style="text-align:left;">{LANG.name} </label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.full_name}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-12 control-label" style="text-align:left;">{LANG.birthday}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.birthday}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-12 control-label" style="text-align:left;">{LANG.gender}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.gender}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-12 control-label" style="text-align:left;"">{LANG.showmail}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.view_mail}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-12 control-label" style="text-align:left;">{LANG.regdate}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.regdate}</label>
                    </div>
                  </div>
                  <!-- BEGIN: group_manage -->
                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-12 control-label" style="text-align:left;">{LANG.group_manage_count}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.group_manage}<a href="{URL_GROUPS}" title="{LANG.group_manage_list}">({LANG.group_manage_list})</a></label>
                    </div>
                  </div>
            <!-- END: group_manage -->
            <div class="form-group">
                    <label for="inputSkills" class="col-sm-12 control-label" style="text-align:left;">{LANG.st_login2}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.st_login}</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-12 control-label" style="text-align:left;">{LANG.2step_status}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.active2step}(<a href="{URL_2STEP}">{LANG.2step_link}</a>)</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-12 control-label" style="text-align:left;">{LANG.last_login}</label>

                    <div class="col-sm-12">
                    <label for="inputName" class="control-label"> : {USER.last_login}</label>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- END: main -->