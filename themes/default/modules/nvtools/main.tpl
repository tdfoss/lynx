<!-- BEGIN: main -->
<form id="nvtools_module" action="{NV_BASE_SITEURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <table  class="table table-striped table-bordered table-hover">
        <caption>
            {LANG.system_tools}
        </caption>
        <col style="width:250px;" />
        <tbody>
            <tr>
                <td>
                    {LANG.module_name}
                </td>
                <td>
                    <input type="text" name="module_name" style="width:150px;" value="{DATA_SYSTEM.module_name}" />
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.version}
                </td>
                <td>
                    <input type="text" name="version1" value="{DATA_SYSTEM.version1}" style="width:20px; text-align: center;" />.<input type="text" name="version2" value="{DATA_SYSTEM.version2}" style="width:20px; text-align: center;" />.<input type="text" name="version3" value="{DATA_SYSTEM.version3}" style="width:20px; text-align: center;" />
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.author_name}
                </td>
                <td>
                    <input type="text" name="author_name" value="{DATA_SYSTEM.author_name}" style="width:400px;" />
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.author_email}
                </td>
                <td>
                    <input type="email" name="author_email" value="{DATA_SYSTEM.author_email}" style="width:400px;" />
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.note}
                </td>
                <td>
                    <input type="text" name="note" value="{DATA_SYSTEM.note}" style="width:400px;" />
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.uploads}
                </td>
                <td>
                    <input type="text" name="uploads" value="{DATA_SYSTEM.uploads}" style="width:400px;" />
					<br />
					{LANG.note_uploads}
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.files}
                </td>
                <td>
                    <input type="text" name="files" value="{DATA_SYSTEM.files}" style="width:400px;" />
					<br />
					{LANG.note_files}
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.is_sysmod}
                </td>
                <td>
                    <input type="checkbox" class="noStyle" name="is_sysmod" value="1" {DATA_SYSTEM.is_sysmodcheckbox}/>
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.virtual}
                </td>
                <td>
                    <input type="checkbox" class="noStyle" name="virtual" value="1" {DATA_SYSTEM.virtualcheckbox}/>
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.is_rss}
                </td>
                <td>
                    <input type="checkbox" class="noStyle" name="is_rss" value="1" {DATA_SYSTEM.is_rsscheckbox}/>
                </td>
            </tr>
            <tr>
                <td>
                    {LANG.is_sitemap}
                </td>
                <td>
                    <input type="checkbox" class="noStyle" name="is_sitemap" value="1" {DATA_SYSTEM.is_sitemapcheckbox}/>
                </td>
            </tr>
        </tbody>
    </table>
    <table id="adminitems" class="table table-striped table-bordered table-hover">
        <caption>
            {LANG.admin_tools}
        </caption>
        <col style="width:10%"/><col style="width:20%"/><col style="width:30%"/>
        <thead align="center">
            <tr>
                <th>
                    {LANG.number}
				</th>
                <th>
                	{LANG.functionname}
                </th>
                <th>
                	{LANG.title_en}
                </th>
                <th>
                	{LANG.title_vi}
                </th>
                <th>
                    {LANG.file_ajax}
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <input type="button" value="{LANG.additem_admin}" onclick="nv_additem_admin();" />
                </td>
            </tr>
        </tfoot>
       	<tbody>
			<!-- BEGIN: admin -->
	            <tr>
	                <td align="center">
	                    {DATA_ADMIN.number}
	                </td>
	                <td>
	                    <input type="text" name="adminfile[{DATA_ADMIN.number}]" style="width:150px;" value="{DATA_ADMIN.file}" />
	                </td>
	                <td>
	                    <input type="text" name="admintitle[{DATA_ADMIN.number}]" style="width:220px;" value="{DATA_ADMIN.title}" />
	                </td>
	                <td>
	                    <input type="text" name="admintitlevi[{DATA_ADMIN.number}]" style="width:220px;" value="{DATA_ADMIN.titlevi}" />
	                </td>
	                <td>
	                    <input type="checkbox" class="noStyle" name="adminajax[{DATA_ADMIN.number}]" value="1" {DATA_ADMIN.checkbox} />
	                </td>
	            </tr>
			<!-- END: admin -->
		</tbody>
    </table>
    <table id="siteitems" class="table table-striped table-bordered table-hover">
        <caption>
            {LANG.site_tools}
        </caption>
        <col style="width:10%"/><col style="width:20%"/><col style="width:30%"/>
        <thead align="center">
            <tr>
                <th>
                    {LANG.number}
				</th>
                <th>
                	{LANG.functionname}
                </th>
                <th>
                	{LANG.title_en}
                </th>
                <th>
                	{LANG.title_vi}
                </th>
                <th>
                    {LANG.file_ajax}
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <input type="button" value="{LANG.additem_site}" onclick="nv_additem_site();" />
                </td>
            </tr>
        </tfoot>
        <tbody>
		<!-- BEGIN: site -->
            <tr>
                <td align="center">
                    {DATA_SITE.number}
                </td>
                <td>
                    <input type="text" name="sitefile[{DATA_SITE.number}]" style="width:150px;" value="{DATA_SITE.file}" />
                </td>
                <td>
                    <input type="text" name="sitetitle[{DATA_SITE.number}]" style="width:220px;" value="{DATA_SITE.title}" />
                </td>
                <td>
                    <input type="text" name="sitetitlevi[{DATA_SITE.number}]" style="width:220px;" value="{DATA_SITE.titlevi}" />
                </td>
                <td>
                    <input type="checkbox" class="noStyle" name="siteajax[{DATA_SITE.number}]" value="1" {DATA_SITE.checkbox} />
                </td>
            </tr>
		<!-- END: site -->
        </tbody>
    </table>
    <table id="sqlitems" class="table table-striped table-bordered table-hover">
        <caption>
            {LANG.sql_tools}
        </caption>
        <col style="width:10%"/><col style="width:20%"/>
        <thead align="center">
            <tr>
                <th>
                    {LANG.number}
                </th>
                <th>
                    {LANG.table_name}
                </th>
                <th>
                    {LANG.code_sql}
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="3">
                    <input type="button" value="{LANG.additem_sql}" onclick="nv_additem_sql();" />
                </td>
            </tr>
        </tfoot>
		<tbody>
            <tr>
            	<td colspan="3">{LANG.note_sql}
            	</td>
            </tr>
        <!-- BEGIN: sql -->
            <tr>
                <td align="center">
                    {DATA_SQL.number}
                </td>
                <td>
                    <input type="text" name="tablename[{DATA_SQL.number}]" value="{DATA_SQL.table}" style="width:150px;"/>
					<textarea id="idsqltablehidden_{DATA_SQL.number}" name="sqltablehidden[{DATA_SQL.number}]" style="display: none;" rows="3" cols="30"></textarea>
                </td>
                <td>
                    <textarea id="idsqltable_{DATA_SQL.number}" style="width:99%; height:150px;" rows="9" cols="80">{DATA_SQL.sql}</textarea>
                </td>
            </tr>
        <!-- END: sql -->
        </tbody>
    </table>
    <div style="text-align: center">
        <input name="savedata" type="hidden" value="1" />
        <input class="btn btn-primary" id="submitmod" type="button" value="{LANG.action}" />
        <input class="btn btn-primary" id="downloadmod" type="button" value="{LANG.download}" />
    </div>
</form>
<script type="text/javascript">
    //<![CDATA[
    var items_admin = '{ITEMS_ADMIN}';
    var items_site = '{ITEMS_SITE}';
    var items_sql = '{ITEMS_SQL}';
   	$.base64.utf8encode = true;
    $("#nvtools_module").submit(function(event)
    {
        for (var i = 1; i <= items_sql; i++)
        {
            sql = $("#idsqltable_" + i).val();
            if(sql!=''){
            	sql = $.base64.encode(sql);
            }
            $("#idsqltablehidden_" + i).val(sql);
        };
        sql = $("#idsqltablehidden_" + 1).val();
    });
	$(document).ready(function(){
		$('#downloadmod').click(function(){
			$('#hiddensubmit').remove();
			$('#nvtools_module').append('<input name="download" id="hiddendownload" type="hidden" value="download" />').submit();
		});
		$('#submitmod').click(function(){
			$('#hiddendownload').remove();
			$('#nvtools_module').append('<input name="submit" id="hiddensubmit" type="hidden" value="submit" />').submit();
		});
	});
    //]]>
</script>
<!-- END: main -->