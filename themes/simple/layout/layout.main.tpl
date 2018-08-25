<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}

<div class="container">
    <div class="row">
    	<div class="col-xs-24 col-sm-12 col-md-12">
    	[TOP_LEFT]
    	</div>
    	<div class="col-xs-24 col-sm-12 col-md-12">
    	[TOP_RIGHT]
    	</div>
    </div>
	<div class="{MODULE_NAME}">
	{MODULE_CONTENT}
	</div>
    <div class="row">
    	<div class="col-xs-24 col-sm-12 col-md-12">
    	[BOTTOM_LEFT]
    	</div>
    	<div class="col-xs-24 col-sm-12 col-md-12">
    	[BOTTOM_RIGHT]
    	</div>
    </div>
	[BOTTOM]
</div>

{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->