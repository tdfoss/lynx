<!-- BEGIN: main -->
<!-- BEGIN: admin -->
<!-- BEGIN: dompdf_link -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE_CSS}/css/invoice_pdf.css" type="text/css" />
<!-- END: dompdf_link -->
<!-- BEGIN: dompdf_link_sendemail -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE_CSS}/css/invoice_pdf.css" type="text/css" />
<!-- END: dompdf_link_sendemail -->
<!-- BEGIN: button_funs -->
<ul class="pull-right list-inline form-tooltip">
    <!-- BEGIN: invoice_payment_confirm -->
    <li><a href="javascript:void(0);" onclick="nv_invoice_sendmail_confirm({ROW.id}); return !1;" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="{LANG.send_mail_note_confirm}"><em class="fa fa-check-circle">&nbsp;</em>{LANG.confirm_payment}</a></li>
    <!-- END: invoice_payment_confirm -->
    <!--     <li><a href="javascript:void(0);" onclick="nv_invoice_sendmail({ROW.id}); return !1;" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="{LANG.send_mail_note}"><em class="fa fa-envelope">&nbsp;</em>{LANG.send_mail}</a></li> -->
    <li><a href="{CONTROL.url_sendmail}" onclick="nv_invoice_sendmail({ROW.id}); return !1;" class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="{LANG.send_mail_note}"><em class="fa fa-envelope">&nbsp;</em>{LANG.send_mail}</a></li>
    <li><a href="{CONTROL.url_edit}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="{LANG.edit_invoice}"><em class="fa fa-edit">&nbsp;</em>{LANG.edit}</a></li>
    <li><a href="{CONTROL.url_delete}" class="btn btn-danger btn-xs" onclick="return confirm(nv_is_del_confirm[0]);" data-toggle="tooltip" data-original-title="{LANG.delete_invoice}"><em class="fa fa-trash-o">&nbsp;</em>{LANG.delete}</a></li>
</ul>
<div class="dropdown dropdown-hover pull-right" style="padding-right: 10px">
    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
        <em class="fa fa-list-ul">&nbsp;</em>{LANG.other} <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{CONTROL.url_add}"><em class="fa fa-plus-square">&nbsp;</em>{LANG.add}</a></li>
        <li><a href="{CONTROL.url_copy}" onclick="nv_invoice_copy({ROW.id}); return !1;"><em class="fa fa-copy">&nbsp;</em>{LANG.invoice_copy}</a></li>
        <!-- BEGIN: support -->
        <li><a href="{CONTROL.url_support}"><em class="fa fa-user">&nbsp;</em>{LANG.new_ticket}</a></li>
        <!-- END: support -->
        <li><a href="{CONTROL.url_export_pdf}"><em class="fa fa-download">&nbsp;</em>{LANG.export_pdf}</a></li>
    </ul>
</div>
<!-- END: button_funs -->
<!-- END: admin -->
<div class="clearfix"></div>
<div class="row">
    <div class="col-xs-24 col-sm-24 col-md-24">
        <div class="panel panel-default font-invoice_info">
            <!-- BEGIN: non_title_pdf -->
            <div class="panel-heading">{LANG.invoice_info}</div>
            <!-- END: non_title_pdf -->
            <div class="panel-body">
                <div class="text-center title_invoice">
                    <h3 class="control-label">
                        <strong>{LANG.invoice_number} <span class="red">#{ROW.code}</span></strong>
                    </h3>
                    <p>{ROW.title}</p>
                </div>
                <div class="col-sm-24 col-md-24 ">
                    <div class="col-sm-12 col-md-12 col-pdf-12">
                        <table class="info_customer">
                            <tr>
                                <td width="150"><strong>{LANG.customerid}:</strong></td>
                                <td><strong><a href="{ROW.customer.link_view}">{ROW.customer.fullname}</a></strong></td>
                            </tr>
                            <tr>
                                <td><p>{LANG.createtime}:&nbsp;</p></td>
                                <td><p>{ROW.createtime}</p></td>
                            </tr>
                            <tr>
                                <td><p>{LANG.status}:</p></td>
                                <td><p>{ROW.status_str}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-12 col-pdf-12">
                        <table class="info_customer">
                            <tr>
                                <td width="150"><strong>{LANG.workforceid}:&nbsp;</strong></td>
                                <td><strong>{ROW.workforceid}</strong></td>
                            </tr>
                            <tr>
                                <td><p>{LANG.duetime}:</p></td>
                                <td><p>{ROW.duetime}</p></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-24 col-md-24 table_infoinvoice">
                    <p class="text-center title_table text-center text-bold">{LANG.list_pro_ser}</p>
                    <table class="table table-striped table-bordered table-hover table-middle">
                        <!--  BEGIN: invoice_list -->
                        <thead>
                            <tr>
                                <th width="50" class="text-center stt">{LANG.number}</th>
                                <th class="title_th">{LANG.title}</th>
                                <th width="150">{LANG.unit_price}</th>
                                <th class="quantity text-center" width="100">{LANG.quantity}</th>
                                <th class="price_string" width="150">{LANG.price_string}</th>
                                <th class="vat" width="150">{LANG.vat}</th>
                                <th class="total">{LANG.total}</th>
                            </tr>
                        </thead>
                        <tbody id="item-detail">
                            <!-- BEGIN: loop -->
                            <tr>
                                <td class="text-center">{ORDERS.number}</td>
                                <td><strong>{ORDERS.itemid}</strong> <span class="help-block">{ORDERS.note}</span></td>
                                <td>{ORDERS.unit_price}</td>
                                <td class="text-center">{ORDERS.quantity}</td>
                                <td>{ORDERS.price}</td>
                                <td><!-- BEGIN: vat -->{ORDERS.vat_price} ({ORDERS.vat}%)<!-- END: vat --><!-- BEGIN: vat_empty -->-<!-- END: vat_empty --></td>
                                <td>{ORDERS.total}</td>
                            </tr>
                            <!-- END: loop -->
                        </tbody>
                        <!--  END: invoice_list -->
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-right"><strong>{LANG.item_total}</strong></td>
                                <td>{ROW.item_total}</td>
                            </tr>
                            <tr>
                                <th colspan="6" class="text-right"><strong>{LANG.vat_total}</strong></th>
                                <td>{ROW.vat_total}</td>
                            </tr>
                            <!-- BEGIN: discount -->
                            <tr>
                                <td colspan="6" class="text-right"><strong>{LANG.discount}</strong></td>
                                <td>{ROW.discount_value} ({ROW.discount_percent}%)</td>
                            </tr>
                            <!-- END: discount -->
                            <tr>
                                <td colspan="6" class="text-right"><strong>{LANG.grand_total}</strong></td>
                                <td>{ROW.grand_total}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>{LANG.grand_total_string}</strong></td>
                                <td>{ROW.grand_total_string}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-left">{LANG.transaction_history}</span> <span class="pull-right"><button data-invoiceid="{ROW.id}" data-lang-add="{LANG.transaction_add}" id="btn-transaction-add" class="btn btn-primary btn-xs">{LANG.transaction_add}</button></span>
                <div class="clearfix"></div>
            </div>
            <div id="transaction-body">{TRANSACTION}</div>
        </div>
        <!-- BEGIN: terms -->
        <div class="panel panel-default font-invoice_info">
            <div class="panel-heading">{LANG.terms}</div>
            <div class="panel-body">{ROW.terms}</div>
        </div>
        <!-- END: terms -->
        <!-- BEGIN: description -->
        <div class="panel panel-default font-invoice_info">
            <div class="panel-heading">{LANG.description}</div>
            <div class="panel-body">{ROW.description}</div>
        </div>
        <!-- END: description -->
    </div>
</div>
<script>
	var invoice_sendmail_confirm = '{LANG.invoice_sendmail_confirm}';
	var invoice_sendmail_confirm_payment = '{LANG.invoice_sendmail_confirm_payment}';
	var invoice_copy_invoice = '{LANG.invoice_copy_invoice}';
</script>
<!-- END: main -->