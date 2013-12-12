<div class="row">
	<div class="col-xs-3">Total</div>
	<div class="col-xs-3 text-right total_tor">{$widget->total_torrents}</div>
	<div class="col-xs-6">
		<button type="button" class="btn btn-success btnTransPlay"><span class="glyphicon glyphicon-play"></span></button>
		<button type="button" class="btn btn-danger btnTransStop"><span class="glyphicon glyphicon-stop"></span></button>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">Active</div>
	<div class="col-xs-3 text-right active_tor">{$widget->active_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Seeding</div>
	<div class="col-xs-3 text-right seeding_tor">{$widget->seeding_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Downloading</div>
	<div class="col-xs-3 text-right down_tor">{$widget->downloading_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<script type="text/javascript">
	function callbackTransmissionFunc(data)
	{
		$('#{$user_widget_info->id_html} .panel-body').html(data);
	}

	$(document).ready(function () {
		$('#{$user_widget_info->id_html} .btnTransPlay').click(function () {
			$.post('widget_loader.php', { widget_id: {$user_widget_info->id}, sid: '{$sid}', sta: true }, null);
		});
		
		$('#{$user_widget_info->id_html} .btnTransStop').click(function () {
			$.post('widget_loader.php', { widget_php: {$user_widget_info->id}, sid: '{$sid}', sto: true }, null);
		});
		
		setTimeout(function () {
			updateWidgetHtml('{$user_widget_info->id_html}', {$user_widget_info->id}, '{$sid}', callbackTransmissionFunc, null);
		}, {$widget_info->updatetime});
	});
</script>