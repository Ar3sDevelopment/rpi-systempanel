function initPanelCollapse()
{
	$('.panel-heading .btn-link[data-toggle="hide"]').click(function () {
		if (!$(this).prop('data-only') || ($(this).prop('data-only') == 'false'))
		{
			$('.panel').parent().hide();
			$($(this).prop('data-target')).parent().parent().show();
			$(this).prop({ 'data-only': true });
		}
		else
		{
			$('.panel').parent().parent().show();
			$(this).prop({ 'data-only': false });
		}
	});
	
	$('a').click(function () {
        window.location = $(this).prop("href");
        return false;
	});
}

function downloadWidget(widget_id, widget_phpfile, sid)
{
	$.post('widget_loader.php', { 'widget_php': widget_phpfile, 'sid': sid }, function (data) {
		$('#' + widget_id + ' .panel-body').html(data);
		if ($('#' + widget_id + '[data-only="true"]').length <= 0)
			$('#' + widget_id).parent().show();
	});
}

function updateWidgetJson(widget_id, widget_phpfile, sid, callback, postData)
{
	var defData = { 'widget_php': widget_phpfile, 'sid': sid, 'json': true };
	$.extend(defData, postData);
	$.post('widget_loader.php', defData, function (data) {
		callback(data);
	});
}

function updateWidgetHtml(widget_id, widget_phpfile, sid, callback, postData)
{
	var defData = { 'widget_php': widget_phpfile, 'sid': sid };
	$.extend(defData, postData);
	$.post('widget_loader.php', defData, function (data) {
		callback(data);
	});
}
