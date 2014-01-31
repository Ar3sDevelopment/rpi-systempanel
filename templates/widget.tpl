<div class="panel panel-success" id="{$widget->id_html}">
	<div class="panel-heading">
		<button type="button" class="btn btn-link" data-toggle="hide" data-target="#{$widget->id_html} .panel-body">{$widget->widget->title}</button>
		{if $widget->widget->updatetime > 0}
			<button type="button" class="btn btn-link pull-right refreshWidget"><span class="glyphicon glyphicon-refresh"></span></button>
		{/if}
		<button type="button" class="btn btn-link pull-right" data-toggle="collapse" data-target="#{$widget->id_html} .panel-body">
			<span class="glyphicon glyphicon-chevron-up"></span><span class="glyphicon glyphicon-chevron-down"></span>
		</button>
	</div>
	<div class="panel-body collapse in">
	</div>
</div>
{if $widget->widget->updatetime > 0}
	<script type="text/javascript">
		$(document).ready(function () {
			$.downloadWidget('{$widget->id_html}', {$widget->id}, '{$sid}');
			
			$('#{$widget->id_html} .panel-heading .refreshWidget').click(function () {
				$.downloadWidget('{$widget->id_html}', {$widget->id}, '{$sid}');
			});
		});
	</script>
{else}
	<script type="text/javascript">
		$(document).ready(function () {
			$.downloadWidget('{$widget->id_html}', {$widget->id}, '{$sid}');
		});
	</script>
{/if}
