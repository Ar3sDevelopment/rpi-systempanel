<div class="panel panel-primary">
	<div class="panel-heading">
		<button type="button" class="btn btn-link" data-toggle="hide" data-target="#{$widget->id}">{$widget->title}</button>
		<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#{$widget->id}">Collapse</button>
	</div>
	<div class="panel-body collapse in" id="{$widget->id}">
		{if $widget->templatefile|default:FALSE}
			{include file="widgets/templates/"|cat:$widget->templatefile}
		{/if}
	</div>
</div>