<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-heading">
        {ROWS.title}
        <ul class="pull-right list-inline">
            <li><a href="{ROWS.link_add}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="{LANG.add_product}"><em class="fa fa-plus-square">&nbsp;</em>{LANG.add_product}</a></li>
            <li><a href="{ROWS.link_edit}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="{LANG.edit}"><em class="fa fa-edit fa-lg">&nbsp;</em>{LANG.edit}</a></li>
            <li><a href="{ROWS.link_delete}" class="btn btn-danger btn-xs" onclick="return confirm(nv_is_del_confirm[0]);" data-toggle="tooltip" data-original-title="{LANG.delete}"><em class="fa fa-trash-o">&nbsp;</em>{LANG.delete}</a></li>
        </ul>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="200">{LANG.title}</th>
                <td>{ROWS.title}</td>
                <th>{LANG.product_type}</th>
                <td>{ROWS.catid}</td>
            </tr>
            <tr>
                <th>{LANG.url}</th>
                <td>
                    <a href={ROWS.url} target="_blank">{ROWS.url}</a>
                </td>
                <th>{LANG.price}</th>
                <td>{ROWS.price}</td>
            </tr>
            <tr>
                <th>{LANG.vat}</th>
                <td>
                    {ROWS.vat}</a>
                </td>
                <th>{LANG.price_unit}</th>
                <td>{ROWS.price_unit}</td>
            </tr>
            <tr>
                <th>{LANG.active}</th>
                <td>
                    <input type="checkbox" name="active" id="change_status_{ROWS.id}" value="{ROWS.id}" {CHECK} onclick="nv_change_status({ROWS.id});" />
                </td>
                <th>{LANG.note}</th>
                <td>{ROWS.note}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        {LANG.list_buy_product}
        <ul class="pull-right list-inline">{LANG.total_buy}{ROWS.total_buy}
        </ul>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th width="50" class="text-center">{LANG.number}</th>
                <th>{LANG.idinvoice}</th>
                <th>{LANG.fullname}</th>
                <th>{LANG.phone}</th>
                <th>{LANG.email}</th>
                <th>{LANG.date}</th>
            </tr>
        </thead>
        <!-- BEGIN: generate_page -->
        <tfoot>
            <tr>
                <td class="text-center" colspan="6">{NV_GENERATE_PAGE}</td>
            </tr>
        </tfoot>
        <!-- END: generate_page -->
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td class="text-center">{VIEW.number}</td>
                <td>
                    <a href={VIEW.url} target="_blank">#{VIEW.code}</a>
                </td>
                <td>
                    <a href={VIEW.url_customer} target="_blank">{VIEW.fullname}</a>
                </td>
                <td>{VIEW.main_phone}</td>
                <td><a href="mailto:{VIEW.main_email}">{VIEW.main_email}</a></td>
                <td>{VIEW.addtime}</td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<script>
    function nv_change_status(id) {
       var new_status = $('#change_status_' + id).is(':checked') ? true : false;
       if (confirm(nv_is_change_act_confirm[0])) {
          var nv_timer = nv_settimeout_disable('change_status_' + id, 5000);
          $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail&nocache=' + new Date().getTime(), 'change_status=1&id=' + id, function(res) {
             var r_split = res.split('_');
             if (r_split[0] != 'OK') {
                alert(nv_is_change_act_confirm[2]);
             }
          });
       }
       else{
          $('#change_status_' + id).prop('checked', new_status ? false : true );
       }
       return;
    }

</script>
<!-- END: main -->
