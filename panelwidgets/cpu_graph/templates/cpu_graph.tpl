<div class="row">
	<div class="col-xs-12">
		<div id="cpu_load_gauge"></div>
	</div>
</div>
<script type="text/javascript">
	function callbackCPUGraphFunc(data)
	{
		$('#cpu_load_gauge').jqxGauge('setValue', data.cpuload);
		setTimeout(timeoutCPUGraphFunc, {$widget_info->updatetime});
	}
	
	function timeoutCPUGraphFunc()
	{
		updateWidgetJson('{$user_widget_info->id}', '{$sid}', callbackCPUGraphFunc, null);
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
			width: '100%',
			height: 350,
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
		
		$('#cpu_load_gauge').jqxGauge('setValue', {$widget->cpuload});
	
		setTimeout(timeoutCPUGraphFunc, {$widget_info->updatetime});
	});
</script>
