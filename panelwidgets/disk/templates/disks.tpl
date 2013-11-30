{for $i = 0 to count($widget->disks) - 1}
{$disk = $widget->disks[$i]}
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-4">
				{$disk->mount} ({$disk->typex})
			</div>
			<div class="col-xs-4">
				{$disk->size}B
			</div>
			<div class="col-xs-4">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				Available
			</div>
			<div class="col-xs-4">
				{$disk->avail}B ({(100 - $disk->percent_part)}%)
			</div>
			<div class="col-xs-4">
				<div class="progress">
					<div style="width: {(100 - $disk->percent_part)}%;" aria-valuenow="{(100 - $disk->percent_part)}" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				Used
			</div>
			<div class="col-xs-4">
				{$disk->used}B ({$disk->percent})
			</div>
			<div class="col-xs-4">
				<div class="progress">
					<div style="width: {$disk->percent};" aria-valuenow="{$disk->percent|replace:"%":""}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		{if ($i < count($widget->disks) - 1)}
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
	function callbackDiskFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml('{$widget_info->id}', '{$widget_info->phpfile}', '{$sid}', callbackDiskFunc, null);
		}, {$widget_info->updatetime});
	});
</script>
