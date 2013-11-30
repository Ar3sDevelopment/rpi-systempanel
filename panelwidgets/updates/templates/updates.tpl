{if count($widget->updates) > 0}
<div class="row">
	<div class="col-xs-12">
		<ul class="list-group">
			{for $i = 0 to count($widget->updates) - 1}
				{$update = $widget->updates[$i]}
				<li class="list-group-item">{$update}</li>
			{/for}
		</ul>
	</div>
</div>
{/if}
<script type="text/javascript">
	function callbackUpdatesFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml('{$widget_info->id}', '{$widget_info->phpfile}', '{$sid}', callbackUpdatesFunc, null);
		}, {$widget_info->updatetime});
	});
</script>