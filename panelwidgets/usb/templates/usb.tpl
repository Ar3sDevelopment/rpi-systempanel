{for $i = 0 to count($widget->devices) - 1}
{$usb = $widget->devices[$i]}
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-4">
				{$usb->name}
			</div>
			<div class="col-xs-4">
				BUS {$usb->bus}
			</div>
			<div class="col-xs-4">
				Device {$usb->device}
			</div>
		</div>
		{if ($i < count($widget->devices) - 1)}
		<div class="row">
			<div class="col-xs-12">
				&nbsp;
			</div>
		</div>
		{/if}
	</div>
</div>
{/for}
<script type="text/javascript">
	function callbackUSBFunc(data)
	{
		$('#{$user_widget_info->id_html} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml({$user_widget_info->id}, '{$sid}', callbackUSBFunc, null);
		}, {$widget_info->updatetime});
	});
</script>