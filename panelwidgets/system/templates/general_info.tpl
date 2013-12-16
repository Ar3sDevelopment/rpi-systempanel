<div class="row">
	<div class="col-xs-6">Hostname</div>
	<div class="col-xs-6" id="host">{$widget->host}</div>
</div>
<div class="row">
	<div class="col-xs-6">System Time</div>
	<div class="col-xs-6" id="time">{$widget->current_time}</div>
</div>
<div class="row">
	<div class="col-xs-6">Kernel</div>
	<div class="col-xs-6" id="kernel">{$widget->system} {$widget->kernel}</div>
</div>
<div class="row">
	<div class="col-xs-6">Firmware</div>
	<div class="col-xs-6" id="firmware">{$widget->firmware}</div>
</div>
<div class="row">
	<div class="col-xs-6">Uptime</div>
	<div class="col-xs-6" id="uptime">{$widget->uptime}</div>
</div>
<script type="text/javascript">
	function callbackSysInfoFunc(data)
	{
		$('#host').html(data.host);
		$('#time').html(data.current_time);
		$('#kernel').html(data.system + ' ' + data.kernel);
		$('#firmware').html(data.firmware);
		$('#uptime').html(data.uptime);
		setTimeout(timeoutSysInfoFunc, {$widget_info->updatetime});
	}
	
	function timeoutSysInfoFunc()
	{
		updateWidgetJson('{$user_widget_info->id}', '{$sid}', callbackSysInfoFunc, null);
	}
	
	$(document).ready(function () {
		setTimeout(timeoutSysInfoFunc, {$widget_info->updatetime});
	});
</script>