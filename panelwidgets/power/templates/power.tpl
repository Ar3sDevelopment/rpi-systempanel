<button type="button" id="btnPowerOff" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span></button>
<button type="button" id="btnPowerReset" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span></button>
<script type="text/javascript">
	$(document).ready(function () {
		$('#btnPowerOff').click(function () {
			if (confirm('Are you sure you want to shutdown?'))
				$.post('widget_loader.php', { widget_id: {$user_widget_info->id}, sid: '{$sid}', po: true }, null);
		});
		
		$('#btnPowerReset').click(function () {
			if (confirm('Are you sure you want to reboot?'))
				$.post('widget_loader.php', { widget_id: {$user_widget_info->id}, sid: '{$sid}', pr: true }, null);
		});
	});
</script>
