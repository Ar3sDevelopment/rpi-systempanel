{for $i = 0 to count($widget->nics) - 1}
	{$nic = $widget->nics[$i]}
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-6">
					Interface {$nic->name}
				</div>
				<div class="col-xs-6">
					{$nic->encap}
				</div>
			</div>
			{if $nic->mac != null && $nic->mac|count_characters > 0}
				<div class="row">
					<div class="col-xs-6">
						MAC Address
					</div>
					<div class="col-xs-6">
						{$nic->mac}
					</div>
				</div>
			{/if}
			<div class="row">
				<div class="col-xs-6">
					IP Address
				</div>
				<div class="col-xs-6">
					{$nic->ip}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					Received
				</div>
				<div class="col-xs-6">
					{$nic->rx}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					Transmitted
				</div>
				<div class="col-xs-6">
					{$nic->tx}
				</div>
			</div>
			{if ($i < count($widget->nics) - 1)}
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
	function callbackNetworkFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml({$user_widget_info->id}, '{$sid}', callbackNetworkFunc, null);
		}, {$widget_info->updatetime});
	});
</script>
