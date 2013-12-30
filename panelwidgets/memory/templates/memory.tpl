<div class="row">
	<div class="col-xs-3">Memory</div>
	<div class="col-xs-3 text-right" id="total_mem">{$widget->total_mem} kB</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Used</div>
	<div class="col-xs-3 text-right" id="used_mem">{$widget->used_mem} kB</div>
	<div class="col-xs-3" id="percent_used_progress">
		<div class="progress">
			<div style="width: {$widget->percent_used}%;" aria-valuenow="{$widget->percent_used}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_used">{$widget->percent_used} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_mem">{$widget->free_mem} kB</div>
	<div class="col-xs-3" id="percent_free_progress">
		<div class="progress">
			<div style="width: {$widget->percent_free}%;" aria-valuenow="{$widget->percent_used}" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_free">{$widget->percent_free} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Buffered</div>
	<div class="col-xs-3 text-right" id="buffer_mem">{$widget->buffer_mem} kB</div>
	<div class="col-xs-3" id="percent_buff_progress">
		<div class="progress">
			<div style="width: {$widget->percent_buff}%;" aria-valuenow="{$widget->percent_buff}" class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_buff">{$widget->percent_buff} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Cached</div>
	<div class="col-xs-3 text-right" id="cache_mem">{$widget->cache_mem} kB</div>
	<div class="col-xs-3">
		<div class="progress" id="percent_cach_progress">
			<div style="width: {$widget->percent_cach}%;" aria-valuenow="{$widget->percent_cach}" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_cach">{$widget->percent_cach} %</div>
</div>
<div class="row">
	<div class="col-xs-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Swap</div>
	<div class="col-xs-3 text-right" id="total_swap">{$widget->total_swap} kB</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Used</div>
	<div class="col-xs-3 text-right" id="used_swap">{$widget->used_swap} kB</div>
	<div class="col-xs-3" id="percent_swap_progress">
		<div class="progress">
			<div style="width: {$widget->percent_swap}%;" aria-valuenow="{$widget->percent_swap}" id="bar5" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap">{$widget->percent_swap} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_swap">{$widget->free_swap} kB</div>
	<div class="col-xs-3" id="percent_swap_free_progress">
		<div class="progress">
			<div style="width: {$widget->percent_swap_free}%;" aria-valuenow="{$widget->percent_swap_free}" ="bar6" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap_free">{$widget->percent_swap_free} %</div>
</div>
<script type="text/javascript">
	function callbackRAMFunc(data)
	{
		$('#total_mem').html(data.total_mem + ' kB');
		
		$('#used_mem').html(data.used_mem + ' kB');
		$('#percent_used_progress .progress div').css({ width: data.percent_used + '%' }).prop('aria-valuenow', data.percent_used)
		$('#percent_used').html(data.percent_used + ' %');
		
		$('#free_mem').html(data.free_mem + ' kB');
		$('#percent_free_progress .progress div').css({ width: data.percent_free + '%' }).prop('aria-valuenow', data.percent_free)
		$('#percent_free').html(data.percent_free + ' %');
		
		$('#buffer_mem').html(data.buffer_mem + ' kB');
		$('#percent_buff_progress .progress div').css({ width: data.percent_buff + '%' }).prop('aria-valuenow', data.percent_buff)
		$('#percent_buff').html(data.percent_buff + ' %');
		
		$('#cache_mem').html(data.cache_mem + ' kB');
		$('#percent_cach_progress .progress div').css({ width: data.percent_cach + '%' }).prop('aria-valuenow', data.percent_cach)
		$('#percent_cach').html(data.percent_cach + ' %');
		
		$('#total_swap').html(data.total_swap + ' kB');
		
		$('#used_swap').html(data.used_swap + ' kB');
		$('#percent_swap_progress .progress div').css({ width: data.percent_swap + '%' }).prop('aria-valuenow', data.percent_swap)
		$('#percent_swap').html(data.percent_swap + ' %');
		
		$('#free_swap').html(data.free_swap + ' kB');
		$('#percent_swap_free_progress .progress div').css({ width: data.percent_swap_free + '%' }).prop('aria-valuenow', data.percent_swap_free)
		$('#percent_swap_free').html(data.percent_swap_free + ' %');
		
		setTimeout(timeoutRAMFunc, {$widget_info->updatetime});
	}
	
	function timeoutRAMFunc()
	{
		$.updateWidgetJson({$user_widget_info->id}, '{$sid}', callbackRAMFunc, null);
	}
	
	$(document).ready(function () {
		setTimeout(timeoutRAMFunc, {$widget_info->updatetime});
	});
</script>