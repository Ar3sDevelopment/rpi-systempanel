<div class="panel panel-primary" id="{$widget->id}">
	<div class="panel-heading">
		<button type="button" class="btn btn-link" data-toggle="hide" data-target="#{$widget->id} .panel-body">{$widget->title}</button>
		{if $widget->updatetime > 0}
			<button type="button" class="btn btn-link pull-right" class="refreshWidget"><span class="glyphicon glyphicon-refresh"></span></a></button>
		{/if}
		<button type="button" class="btn btn-link pull-right" data-toggle="collapse" data-target="#{$widget->id} .panel-body">Collapse</button>
	</div>
	<div class="panel-body collapse in">
	</div>
</div>
{if $widget->updatetime > 0}
	<script type="text/javascript">
		$(document).ready(function () {
			updateWidget{$widget->id}Repeat();
			
			$('#{$widget->id}').click(function () {
				updateWidget{$widget->id}();
			});
		});
		
		function updateWidget{$widget->id}Repeat() {
			$.post('widget_loader.php', { 'widget_php': '{$widget->phpfile}', 'sid': '{$sid}' }, function (data) {
				$('#{$widget->id} .panel-body').html(data);
				if (data.length > 0)
				{
					if ($('[data-only="true"]').length <= 0)
						$('#{$widget->id}').parent().show();
				}
				else
					$('#{$widget->id}').parent().hide();
					
				setTimeout(function () { updateWidget{$widget->id}Repeat(); }, {$widget->updatetime});
			});
		}
		
		function updateWidget{$widget->id}() {
			$.post('widget_loader.php', { 'widget_php': '{$widget->phpfile}', 'sid': '{$sid}' }, function (data) {
				$('#{$widget->id} .panel-body').html(data);
				if ($('[data-only="true"]').length <= 0)
					$('#{$widget->id}').parent().show();
			});
		}
	</script>
{else}
	<script type="text/javascript">
		$(document).ready(function () {
			updateWidget{$widget->id}();
		});
		
		function updateWidget{$widget->id}() {
			$.post('widget_loader.php', { 'widget_php': '{$widget->phpfile}', 'sid': '{$sid}' }, function (data) {
				$('#{$widget->id} .panel-body').html(data);
				if ($('[data-only="true"]').length <= 0)
					$('#{$widget->id}').parent().show();
			});
		}
	</script>
{/if}
