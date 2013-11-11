<div class="row">
	<div class="col-xs-3">Memory</div>
	<div class="col-xs-3 text-right" id="total_mem">{$widget->total_mem} kB</div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Used</div>
	<div class="col-xs-3 text-right" id="used_mem">{$widget->used_mem} kB</div>
	<div class="col-xs-3">
		<div class="progress">
			<div style="width: {$widget->percent_used}%;" aria-valuenow="{$widget->percent_used}" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_used">{$widget->percent_used} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_mem">{$widget->free_mem} kB</div>
	<div class="col-xs-3">
		<div class="progress">
			<div style="width: {$widget->percent_free}%;" aria-valuenow="{$widget->percent_used}" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_free">{$widget->percent_free} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Buffered</div>
	<div class="col-xs-3 text-right" id="buffer_mem">{$widget->buffer_mem} kB</div>
	<div class="col-xs-3">
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
		<div class="progress">
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
	<div class="col-xs-3">
		<div class="progress">
			<div style="width: {$widget->percent_swap}%;" aria-valuenow="{$widget->percent_swap}" id="bar5" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap">{$widget->percent_swap} %</div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_swap">{$widget->free_swap} kB</div>
	<div class="col-xs-3">
		<div class="progress">
			<div style="width: {$widget->percent_swap_free}%;" aria-valuenow="{$widget->percent_swap_free}" ="bar6" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap_free">{$widget->percent_swap_free} %</div>
</div>