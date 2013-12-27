<div class="row">
	<div class="col-xs-12">
		<div class="well">
			<div class="form-group">
				<button class="btn btn-primary" data-toggle="modal" data-target="#createWidget">
					Create New Widget
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="createWidget" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="createModalLabel">New Widget</h4>
			</div>
			<form action="index.php" data-type="ajax" method="post" class="form-horizontal">
				<div class="modal-body">
					<input type="hidden" name="sid" value="{$sid}" />
					<input type="hidden" name="create_widget" value="1" />
					<div class="row">
						<div class="col-xs-12">
							{include file="widget_fields.tpl" widget=$widget}
						</div>
					</div>
				</div>								
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>