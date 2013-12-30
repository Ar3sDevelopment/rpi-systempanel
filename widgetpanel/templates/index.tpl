<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Widgets"}
	<script type="text/javascript">
		$(document).ready(function () {
			initAjaxForms();
		});
		
		function changeAction(sender, action) {
			$(sender).parent().children('input[name="widget_action"]').val(action);
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
