<div class="row">
	<div class="col-xs-12">
		<div id="cpu_temp_gauge"></div>
	</div>
</div>
<script type="text/javascript">
	function callbackTempGraphFunc(data)
	{
		$('#cpu_temp_gauge').jqxLinearGauge('value', data.cpu_temperature);
		setTimeout(timeoutTempGraphFunc, {$widget_info->updatetime});
	}
	
	function timeoutTempGraphFunc()
	{
		updateWidgetJson('{$user_widget_info->id}', '{$sid}', callbackTempGraphFunc, null);
	}
	
	$(document).ready(function () {
		var majorTicks = { size: '10%', interval: 10 };
		var minorTicks = { size: '5%', interval: 2.5, style: { 'stroke-width': 1, stroke: '#aaaaaa'} };
		var labels = { interval: 20, position: 'near' };
		$('#cpu_temp_gauge').jqxLinearGauge({
			width: 100,
			height: 350,
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
				{ startValue: 0, endValue: 60, style: { fill: '#FFF157', stroke: '#FFF157'} },
				{ startValue: 60, endValue: 70, style: { fill: '#FFA200', stroke: '#FFA200'} },
				{ startValue: 70, endValue: 80, style: { fill: '#FF4800', stroke: '#FF4800'}}
			]
		});
		
		$('#cpu_temp_gauge').jqxLinearGauge('value', {$widget->cpu_temperature});
	
		setTimeout(timeoutTempGraphFunc, {$widget_info->updatetime});
	});
</script>
