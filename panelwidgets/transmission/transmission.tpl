<div class="row">
	<div class="col-xs-3">Total</div>
	<div class="col-xs-3 text-right" id="total_tor">{$widget->total_torrents}</div>
	<div class="col-xs-6">
		<button type="button" id="btnTransPlay" class="btn btn-success"><span class="glyphicon glyphicon-play"></span></button>
		<button type="button" id="btnTransStop" class="btn btn-danger"><span class="glyphicon glyphicon-stop"></span></button>
	</div>
</div>
<div class="row">
	<div class="col-xs-3">Active</div>
	<div class="col-xs-3 text-right" id="active_tor">{$widget->active_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Seeding</div>
	<div class="col-xs-3 text-right" id="seeding_tor">{$widget->seeding_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Downloading</div>
	<div class="col-xs-3 text-right" id="down_tor">{$widget->downloading_torrents}</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<script type="text/javascript">
	function callbackTransmissionFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		$('#btnTransPlay').click(function () {
			$.post('widget_loader.php', { widget_php: 'transmission', sid: '{$sid}', sta: true }, null);
		});
		
		$('#btnTransStop').click(function () {
			$.post('widget_loader.php', { widget_php: 'transmission', sid: '{$sid}', sto: true }, null);
		});
		
		setTimeout(function () {
			updateWidgetHtml('{$widget_info->id}', '{$widget_info->phpfile}', '{$sid}', callbackTransmissionFunc, null);
		}, {$widget_info->updatetime});
	});
</script>