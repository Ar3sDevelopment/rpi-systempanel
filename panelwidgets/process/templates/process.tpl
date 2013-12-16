{for $i = 0 to count($widget->procs) - 1}
{$proc = $widget->procs[$i]}
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-4">
				[PID: {$proc->pid}] {$proc->command}
			</div>
			<div class="col-xs-4">
				{$proc->user}
			</div>
			<div class="col-xs-4">
				Started: {$proc->start_date}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				CPU %
			</div>
			<div class="col-xs-4">
				{$proc->cpu_percent}%
			</div>
			<div class="col-xs-4">
				<div class="progress">
					<div style="width: {$proc->cpu_percent}%;" aria-valuenow="{$proc->cpu_percent}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				RAM %
			</div>
			<div class="col-xs-4">
				{$proc->mem_percent}%
			</div>
			<div class="col-xs-4">
				<div class="progress">
					<div style="width: {$proc->mem_percent}%;" aria-valuenow="{$proc->mem_percent}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		{if ($i < count($widget->procs) - 1)}
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
	function callbackProcessFunc(data)
	{
		$('#{$user_widget_info->id_html} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml({$user_widget_info->id}, '{$sid}', callbackProcessFunc, null);
		}, {$widget_info->updatetime});
	});
</script>