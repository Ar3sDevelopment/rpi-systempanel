<div class="row">
	<div class="col-xs-6">CPU</div>
	<div class="col-xs-6" id="processor">{$widget->processor}</div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Frequency</div>
	<div class="col-xs-6" id="freq">{$widget->frequency} MHz</div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Load</div>
	<div class="col-xs-3" id="cpuload">{$widget->cpuload} %</div>
	<div class="col-xs-3" id="cpuload_percent">
		<div class="progress">
			<div style="width: {$widget->cpuload}%" aria-valuenow="{$widget->cpuload}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Temperature</div>
	<div class="col-xs-6" id="cpu_temperature">{$widget->cpu_temperature}&deg;C</div>
</div>