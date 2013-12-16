<div class="row">
	<div class="col-xs-12 terminal-output">
		<pre>
		</pre>
	</div>
</div>
<div class="row">
	<div class="col-xs-10">
		<input type="text" class="form-control" name="cmd" />
	</div>
	<div class="col-xs-2">
		<button type="button" class="btn btn-success btnSendCmd"><span class="glyphicon glyphicon-play"></span></button>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#{$user_widget_info->id_html} .btnSendCmd').click(function () {
			$.post('widget_loader.php', { widget_id: {$user_widget_info->id}, sid: '{$sid}', cmd: $('#{$user_widget_info->id_html} input[name="cmd"]').val() }, function (data) {
				$('#{$user_widget_info->id_html} .terminal-output pre').text(data);
			});
		});
	});
</script>