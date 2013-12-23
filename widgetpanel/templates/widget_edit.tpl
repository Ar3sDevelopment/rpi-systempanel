<form action="index.php" data-type="ajax" method="post" class="form-horizontal">
	<input type="hidden" name="sid" value="{$sid}" />
	<div class="form-group">
		<div class="row">
			<input type="hidden" name="widget-id" value="{$widget->id}" />
			<div class="col-xs-12">
				<div class="well">
					{include file="widget_fields.tpl" widget=$widget}
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<input type="hidden" name="save_widget" value="1" />
							<button type="submit" name="save" class="btn btn-primary">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
