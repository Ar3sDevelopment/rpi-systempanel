<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="assignModalLabel">New Widget</h4>
		</div>
		<form action="settings.php" data-type="ajax" method="post" class="form-horizontal">
			<div class="modal-body">
				<input type="hidden" name="sid" value="{$sid}" />
				<input type="hidden" name="assign_widget" value="1" />
				<div class="row">
					<div class="col-xs-12">
						{include file="userwidget_fields.tpl" widget=$widget}
						<div class="form-group">
							<label for="wid" class="col-sm-4 control-label">Position</label>
							<div class="col-sm-8">
								<select name="wid" class="form-control">
									{foreach $widget_list as $widget_item}
										<option value="{$widget_item->id}">{$widget_item->title}</option>
									{/foreach}
								</select>
							</div>
						</div>
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
<script type="text/javascript">
	$(document).ready(function () {
		initAjaxForms();
	});
</script>