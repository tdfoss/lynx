<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}

<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-6">
			[LEFT]
		</div>
		<div class="col-sm-16 col-md-18">
			<div class="{MODULE_NAME}">
				{MODULE_CONTENT}
			</div>
			[BOTTOM]
		</div>
	</div>
</div>

{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->