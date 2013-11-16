<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="System Info Panel"}
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="home"}
		{$c = 0}
		{$columns = 0}
		<div class="row">
		{while $c < count($widgets)}
			{if $widgets[$c]->enabled}
				{if !$widgets[$c]->visible}
					<div class="col-md-{$widgets[$c]->columns}" style="display: none;">
				{else}
					<div class="col-md-{$widgets[$c]->columns}">
				{/if}
				{include file="widget.tpl" widget=$widgets[$c] sid=$sid}
				</div>
				{$columns = $columns + {$widgets[$c]->columns}}
				{if $columns == 12}
					{$columns = 0}
					</div>
					<div class="row">
				{/if}
			{/if}
			{$c = $c + 1}
		{/while}
		</div>
	</div>
</body>
</html>
