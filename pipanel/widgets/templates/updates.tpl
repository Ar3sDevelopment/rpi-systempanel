<div class="row">
	<div class="col-xs-12">
		<ul class="list-group">
			{for $i = 0 to count($widget->updates) - 1}
				{update = $widget->updates[$i]}
				<li class="list-group-item">{$update}</li>
			{/for}
		</ul>
	</div>
</div>