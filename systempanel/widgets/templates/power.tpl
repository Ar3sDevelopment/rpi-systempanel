<button type="button" id="btnPowerOff" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span></button>
<button type="button" id="btnPowerReset" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span></button>
<script type="text/javascript">
	$(document).ready(function () {
		$('#btnPowerOff').click(function () {
			$.post('widget_loader.php', { widget_php: 'power', po: true }, null);
		});
		
		$('#btnPowerReset').click(function () {
			$.post('widget_loader.php', { widget_php: 'power', pr: true }, null);
		});
	});
</script>
