<form action="index.php" data-type="ajax" method="post" class="form-horizontal" data-success="widgetSaved" data-error="widgetError">
	<input type="hidden" name="sid" value="{$sid}" />
	<div class="row">
		<div class="col-xs-12">
		<input type="hidden" name="widget-id" value="{$widget->id}" />
			<div class="well">
				{include file="widget_fields.tpl" widget=$widget}
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<input type="hidden" name="widget_action" value="save" />
						<button type="submit" onclick="changeAction(this, 'save');" class="btn btn-primary">Save</button>
						<button type="submit" onclick="changeAction(this, 'delete');" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
