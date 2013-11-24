<img class="img-responsive" src="tmp/still.jpg?d={$smarty.now}" />
{if $widget->result != null}
	{if $widget->result|count_characters:true > 0}
	<pre>
		{$widget->result}
	</pre>
	{elseif count($widget->result) > 0}
	<pre>
		{foreach $widget->result as $res}
			{$res}
		{/foreach}
	</pre>
	{/if}
{/if}
<script type="text/javascript">
	function callbackCameraFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml('{$widget_info->id}', '{$widget_info->phpfile}', '{$sid}', callbackCameraFunc, null);
		}, {$widget_info->updatetime});
	});
</script>