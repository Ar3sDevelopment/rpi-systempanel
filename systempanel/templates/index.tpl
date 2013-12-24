<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="System Info Panel"}
</head>
<body>
	<div class="visible-xs visible-sm" style="height: 20px;">&nbsp;</div>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="home"}
		{$columns = 0}
		<div class="row">
		{foreach $widgets as $widget}
			{if $widget->enabled}
				{$columns = $columns + {$widget->widget->columns}}
				{if $columns > 12}
					{$columns = $widget->widget->columns}
					</div>
					<div class="row">
				{/if}
				{if !$widget->visible}
					<div class="col-md-{$widget->widget->columns}" style="display: none;">
				{else}
					<div class="col-md-{$widget->widget->columns}">
				{/if}
				{include file="widget.tpl" widget=$widget sid=$sid}
				</div>
			{/if}
		{/foreach}
		</div>
	</div>
</body>
</html>
