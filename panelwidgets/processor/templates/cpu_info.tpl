<div class="row">
	<div class="col-xs-3">CPUs</div>
	<div class="col-xs-3" id="cpus">{$widget->cpus}</div>
	<div class="col-xs-3">Cores</div>
	<div class="col-xs-3" id="cores">{$widget->cores}</div>
</div>
<div class="row">
	<div class="col-xs-3">Sockets</div>
	<div class="col-xs-3" id="sockets">{$widget->sockets}</div>
	<div class="col-xs-3">Nodes</div>
	<div class="col-xs-3" id="nodes">{$widget->nodes}</div>
</div>
<div class="row">
	<div class="col-xs-6">Model</div>
	<div class="col-xs-6" id="model">{$widget->processor}</div>
</div>
<div class="row">
	<div class="col-xs-6">Frequency</div>
	<div class="col-xs-6" id="freq">{$widget->frequency} MHz</div>
</div>
<div class="row">
	<div class="col-xs-6">Load</div>
	<div class="col-xs-3" id="cpuload">{$widget->cpuload} %</div>
	<div class="col-xs-3" id="cpuload_percent">
		<div class="progress">
			<div style="width: {$widget->cpuload}%" aria-valuenow="{$widget->cpuload}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">Temperature</div>
	<div class="col-xs-6" id="cpu_temperature">{$widget->cpu_temperature}&deg;C</div>
</div>
<script type="text/javascript">
	function callbackCPUFunc(data)
	{
		$('#cpus').html(data.cpus);
		$('#cores').html(data.cores);
		$('#sockets').html(data.sockets);
		$('#nodes').html(data.nodes);
		$('#model').html(data.processor);
		$('#frequency').html(data.frequency + ' MHz');
		$('#cpuload').html(data.cpuload + ' %');
		$('#cpuload_percent .progress div').css({ width: data.cpuload + '%' }).prop('aria-valuenow', data.cpuload)
		$('#cpu_temperature').html(data.cpu_temperature + '&deg;C');
		setTimeout(timeoutCPUFunc, {$widget_info->updatetime});
	}
	
	function timeoutCPUFunc()
	{
		updateWidgetJson({$user_widget_info->id}, '{$sid}', callbackCPUFunc, null);
	}
	
	$(document).ready(function () {
	
		setTimeout(timeoutCPUFunc, {$widget_info->updatetime});
	});
</script>
