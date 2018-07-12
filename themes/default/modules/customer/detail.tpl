<!-- BEGIN: main -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<ul class="list-inline pull-right">
	<!-- BEGIN: iscontacts_change -->
	<li><button class="btn btn-primary btn-xs" onclick="nv_change_contacts(); return  false;">
			<em class="fa fa-exchange">&nbsp;</em>{LANG.changecontacts}
		</button></li>
	<!-- END: iscontacts_change -->
	<li><a href="{URL_ADD}" class="btn btn-primary btn-xs"><em class="fa fa-plus">&nbsp;</em>{LANG.customer_add}</a></li>
	<li><a href="{URL_ADD_EMAIL}" class="btn btn-primary btn-xs"><em class="fa fa-plus">&nbsp;</em>{LANG.email_add}</a></li>
    <!-- BEGIN: support -->
	<li><a href="{URL_ADD_SUPPORT}" class="btn btn-primary btn-xs"><em class="fa fa-user">&nbsp;</em>{LANG.add_support}</a></li>
    <!-- END: support -->
	<li><a href="{URL_EDIT}" class="btn btn-default btn-xs"><em class="fa fa-edit">&nbsp;</em>{LANG.customer_edit}</a></li>
	<li><a href="{URL_DELETE}" class="btn btn-danger btn-xs" onclick="return confirm(nv_is_del_confirm[0]);"><em class="fa fa-trash-o">&nbsp;</em>{LANG.delete}</a></li>
</ul>
<div class="clearfix"></div>
<div class="panel with-nav-tabs panel-success">
	<div class="panel-heading">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1success" data-toggle="tab">{LANG.customer_detail}</a></li>
			<!-- BEGIN: iscontacts -->
			<li><a href="#tab2success" data-toggle="tab">{LANG.service_detail} <span class="red">({CUSTOMER.count_services})</span></a></li>
			<li><a href="#tab3success" data-toggle="tab">{LANG.products_detail} <span class="red">({CUSTOMER.count_products})</span></a></li>
			<li><a href="#tab4success" data-toggle="tab">{LANG.invoice_detail} <span class="red">({CUSTOMER.count_invoices})</span></a></li>
			<li><a href="#tab5success" data-toggle="tab">{LANG.project_detail} <span class="red">({CUSTOMER.count_projects})</span></a></li>
			<!-- END: iscontacts -->
			<li><a href="#tab6success" data-toggle="tab">{LANG.email_detail} <span class="red">({CUSTOMER.count_emails})</span></a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div class="tab-content">
			<div class="tab-pane fade in active" id="tab1success">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th>{LANG.fullname}</th>
							<td>{CUSTOMER.fullname}</td>
							<th>{LANG.care_staff_name}</th>
							<td>{CUSTOMER.care_staff}</td>
						</tr>
						<tr>
							<th>{LANG.main_phone}</th>
							<td>{CUSTOMER.main_phone}</td>
							<th>{LANG.other_phone}</th>
							<td>{CUSTOMER.other_phone}</td>
						</tr>
						<tr>
							<th>{LANG.main_email}</th>
							<td>{CUSTOMER.main_email}</td>
							<th>{LANG.other_email}</th>
							<td>{CUSTOMER.other_email}</td>
						</tr>
                        <tr>
                            <th>{LANG.customer_types}</th>
                            <td>{CUSTOMER.type_id}</td>
							<th>{LANG.birthday}</th>
							<td>{CUSTOMER.birthday}</td>
                        </tr>
						<tr>
							<th>Facebook</th>
							<td>{CUSTOMER.facebook}</td>
							<th>Skype</th>
							<td>{CUSTOMER.skype}</td>
						</tr>
						<tr>
							<th>Zalo</th>
							<td>{CUSTOMER.zalo}</td>
							<th>{LANG.address}</th>
							<td>{CUSTOMER.address}</td>
						</tr>
						<tr>
							<th>{LANG.gender}</th>
							<td>{CUSTOMER.gender}</td>
							<th>{LANG.unit}</th>
							<td>{CUSTOMER.unit}</td>
						</tr>
						<tr>
							<th>{LANG.addtime}</th>
							<td>{CUSTOMER.addtime}</td>
							<th>{LANG.user_account}</th>
							<td>{CUSTOMER.user_account}</td>
						</tr>
						<tr>
							<th>{LANG.edittime}</th>
							<td>{CUSTOMER.edittime}</td>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<th>{LANG.note}</th>
							<td colspan="3">{CUSTOMER.note}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="tab2success">
				<!-- BEGIN: service -->
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="50" class="text-center">{LANG.number}</th>
							<th>{LANG.service}</th>
							<th>{LANG.title}</th>
							<th>{LANG.begintime}</th>
							<th>{LANG.endtime}</th>
							<th>{LANG.addtime}</th>
						</tr>
					</thead>
					<tbody>
						<!-- BEGIN: loop -->
						<tr>
							<td class="text-center">{SERVICE.number}</td>
							<td>{SERVICE.service}</td>
							<td>{SERVICE.title}</td>
							<td>{SERVICE.begintime}</td>
							<td>{SERVICE.endtime}</td>
							<td>{SERVICE.addtime}</td>
						</tr>
						<!-- END: loop -->
					</tbody>
				</table>
				<!-- END: service -->
			</div>
			<div class="tab-pane fade" id="tab3success">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">{LANG.product_name}</th>
							<th scope="col">{LANG.product_time}</th>
						</tr>
					</thead>
					<tbody>
						<!-- BEGIN: products -->
						<tr>
							<td>{PRODUCTS.product_name}</td>
							<td>{PRODUCTS.time_add}</td>
						</tr>
						<!-- END: products -->
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="tab4success">
                <!-- BEGIN: invoice -->
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">{LANG.number}</th>
							<th scope="col">{LANG.invoice_code}</th>
							<th scope="col">{LANG.title}</th>
							<th scope="col">{LANG.invoice_createtime}</th>
							<th scope="col">{LANG.invoice_duetime}</th>
							<th scope="col">{LANG.addtime}</th>
							<th scope="col">{LANG.invoice_grand_total}</th>
							<th scope="col">{LANG.status}</th>
						</tr>
					</thead>
					<tbody>
                        <!-- BEGIN: loop -->
						<tr onclick="nv_table_row_click(event, '{INVOICE.link_view}', false);" class="pointer">
							<td>{INVOICE.number}</td>
							<td>#{INVOICE.code}</td>
							<td>{INVOICE.title}</td>
							<td>{INVOICE.createtime}</td>
							<td>{INVOICE.duetime}</td>
							<td>{INVOICE.addtime}</td>
							<td>{INVOICE.grand_total}</td>
							<td>{INVOICE.status}</td>
							<td></td>
						</tr>
                        <!-- END: loop -->
					</tbody>
				</table>
                <!-- END: invoice -->
			</div>
			<div class="tab-pane fade" id="tab5success">
				<!-- BEGIN: project -->
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="50" class="text-center">{LANG.number}</th>
							<th>{LANG.title}</th>
							<th width="150">{LANG.project_begintime}</th>
							<th width="150">{LANG.project_endtime}</th>
							<th width="190">{LANG.project_realtime}</th>
							<th width="150">{LANG.status}</th>
						</tr>
					</thead>
					<!-- BEGIN: generate_page -->
					<tfoot>
						<tr>
							<td class="text-center" colspan="9">{NV_GENERATE_PAGE}</td>
						</tr>
					</tfoot>
					<!-- END: generate_page -->
					<tbody>
						<!-- BEGIN: loop -->
						<tr>
							<td class="text-center">{PROJECT.number}</td>
							<td>{PROJECT.title}</td>
							<td>{PROJECT.begintime}</td>
							<td>{PROJECT.endtime}</td>
							<td>{PROJECT.realtime}</td>
							<td>{PROJECT.status}</td>
						</tr>
						<!-- END: loop -->
					</tbody>
				</table>
				<!-- END: project -->
			</div>
			<div class="tab-pane fade" id="tab6success">
				<!-- BEGIN: email -->
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="50" class="text-center">{LANG.number}</th>
							<th>{LANG.title}</th>
							<th width="190">{LANG.email_addtime}</th>
							<th width="150">{LANG.email_useradd}</th>
						</tr>
					</thead>
					<tbody>
						<!-- BEGIN: loop -->
						<tr onclick="nv_table_row_click(event, '{EMAIL.link_view}', false);" class="pointer">
							<td class="text-center">{EMAIL.number}</td>
							<td>{EMAIL.title}</td>
							<td>{EMAIL.addtime}</td>
							<td>{EMAIL.useradd}</td>
						</tr>
						<!-- END: loop -->
					</tbody>
				</table>
				<!-- END: email -->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	//Change hash for page-reload
	$('.nav-tabs a').on('shown.bs.tab', function(e) {
		window.location.hash = e.target.hash;
	})

	function nv_change_contacts() {
		if (confirm('{LANG.queue_confirm}')) {
			$.ajax({
				type : 'POST',
				url : script_name + '?' + nv_name_variable + '='
						+ nv_module_name + '&' + nv_fc_variable
						+ '=detail&nocache='
						+ new Date().getTime(),
				data : 'change_contacts=1&id={CUSTOMER.id}',
				success : function(data) {
					var r_split = data.split('_');
					alert(r_split[1]);
					if (r_split[0] == 'OK') {
						location.reload();
					}
				}
			});
		}
		return !1;
	}

	//Javascript to enable link to tab
	var url = document.location.toString();
	if (url.match('#')) {
		$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
	}
</script>
<!-- END: main -->