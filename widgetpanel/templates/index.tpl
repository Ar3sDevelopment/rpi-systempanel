<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Widgets"}
	<script type="text/javascript">
		$(document).ready(function () {
			$.initAjaxForms();
		});
		
		function changeAction(sender, action) {
			$(sender).parent().children('input[name="widget_action"]').val(action);
		}
		
		function widgetSaved(caller) {
			caller.prepend('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Widget Saved</strong></div>');
			setTimeout(function () {
				caller.children('.alert').alert('close');
			}, 2000);
		}
		
		function widgetError(caller) {
			caller.prepend('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Error Saving Widget</strong></div>');
			setTimeout(function () {
				caller.children('.alert').alert('close');
			}, 2000);
		}
	</script>
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="admin" admin=$user->admin}
		<div class="row">
			<div class="col-xs-12">
				<div class="well">
					<div class="form-group">
						<button class="btn btn-primary" data-toggle="modal" data-target="#createWidget" href="widget_create.php?sid={$sid}">
							Create New Widget
						</button>
						<div class="modal fade" id="createWidget" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
						</div>
					</div>
				</div>
			</div>
		</div>
		{foreach $widgets as $widget}
			{include file="widget_edit.tpl" sid=$sid widget=$widget}
		{/foreach}
	</div>
</body>
</html>
