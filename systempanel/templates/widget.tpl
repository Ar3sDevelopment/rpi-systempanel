<div class="panel panel-success" id="{$widget->id}">
	<div class="panel-heading">
		<button type="button" class="btn btn-link" data-toggle="hide" data-target="#{$widget->id} .panel-body">{$widget->title}</button>
		{if $widget->updatetime > 0}
			<button type="button" class="btn btn-link pull-right refreshWidget"><span class="glyphicon glyphicon-refresh"></span></button>
		{/if}
		<button type="button" class="btn btn-link pull-right" data-toggle="collapse" data-target="#{$widget->id} .panel-body">
			<span class="glyphicon glyphicon-chevron-up"></span><span class="glyphicon glyphicon-chevron-down"></span>
		</button>
	</div>
	<div class="panel-body collapse in">
	</div>
</div>
{if $widget->updatetime > 0}
	<script type="text/javascript">
		$(document).ready(function () {
			downloadWidget('{$widget->id}', '{$widget->phpfile}', '{$sid}');
			
			$('#{$widget->id} .panel-heading .refreshWidget').click(function () {
				downloadWidget('{$widget->id}', '{$widget->phpfile}', '{$sid}');
			});
		});
	</script>
{else}
	<script type="text/javascript">
		$(document).ready(function () {
			downloadWidget('{$widget->id}', '{$widget->phpfile}', '{$sid}');
		});
	</script>
{/if}
