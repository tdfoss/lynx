<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}

<!-- Page Content -->
<div class="container">
	<div class="{MODULE_NAME}">
	{MODULE_CONTENT}
	</div>
	<div class="row m-bottom">
		<div class="col-xs-24 col-sm-12">[BOTTOM_LEFT]</div>
		<div class="col-xs-24 col-sm-12">[BOTTOM_RIGHT]</div>
	</div>
	[BOTTOM]
</div>

{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->