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
<div class="row">
	<div id="cpu_load_gauge" class="col-xs-8"></div>
	<div id="cpu_temp_gauge" class="col-xs-4"></div>
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
		$('#cpu_load_gauge').jqxGauge('setValue', data.cpuload);
		$('#cpu_temp_gauge').jqxLinearGauge('value', data.cpu_temperature);
		setTimeout(timeoutCPUFunc, {$widget_info->updatetime});
	}
	
	function timeoutCPUFunc()
	{
		updateWidgetJson('{$widget_info->id}', '{$widget_info->phpfile}', '{$sid}', callbackCPUFunc, null);
	}
	
	$(document).ready(function () {
		var labels = { visible: true, position: 'inside' };
		$('#cpu_load_gauge').jqxGauge({
			ranges: [
				{ startValue: 0, endValue: 50, style: { fill: '#e2e2e2', stroke: '#e2e2e2' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
				{ startValue: 50, endValue: 70, style: { fill: '#f6de54', stroke: '#f6de54' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
				{ startValue: 70, endValue: 85, style: { fill: '#db5016', stroke: '#db5016' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
				{ startValue: 85, endValue: 100, style: { fill: '#d02841', stroke: '#d02841' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 }
			],
			width: 200,
			height: 200,
			cap: { radius: 0.04 },
			caption: { offset: [0, 0], value: 'CPU Load', position: 'bottom' },
			value: 0,
			max: 100,
			style: { stroke: '#ffffff', 'stroke-width': '1px', fill: '#ffffff' },
			animationDuration: 1500,
			colorScheme: 'scheme09',
			labels: labels,
			ticksMinor: { interval: 5, size: '5%' },
			ticksMajor: { interval: 10, size: '10%' }
		});
		
		var majorTicks = { size: '10%', interval: 10 };
		var minorTicks = { size: '5%', interval: 2.5, style: { 'stroke-width': 1, stroke: '#aaaaaa'} };
		var labels = { interval: 20, position: 'near' };
		$('#cpu_temp_gauge').jqxLinearGauge({
			width: 100,
			height: 200,
			orientation: 'vertical',
			labels: labels,
			ticksMajor: majorTicks,
			ticksMinor: minorTicks,
			min: 0,
			max: 80,
			value: 0,
			pointer: { size: '6%' },
			colorScheme: 'scheme09',
			ranges: [
				{ startValue: 0, endValue: 40, style: { fill: '#FFF157', stroke: '#FFF157'} },
				{ startValue: 40, endValue: 60, style: { fill: '#FFA200', stroke: '#FFA200'} },
				{ startValue: 60, endValue: 80, style: { fill: '#FF4800', stroke: '#FF4800'}}
			]
		});
		
		$('#cpu_load_gauge').jqxGauge('setValue', {$widget->cpuload});
		$('#cpu_temp_gauge').jqxLinearGauge('value', {$widget->cpu_temperature});
	
		setTimeout(timeoutCPUFunc, {$widget_info->updatetime});
	});
</script>
