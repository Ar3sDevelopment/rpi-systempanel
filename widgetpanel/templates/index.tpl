<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Widgets"}
	<script type="text/javascript">
		$(document).ready(function () {
			initAjaxForms();
		});
	</script>
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="admin"}
		{include file="widget_create.tpl" widget=$default_widget sid=$sid}
		{foreach $widgets as $widget}
			{include file="widget_edit.tpl" sid=$sid widget=$widget}
		{/foreach}
	</div>
</body>
</html>
