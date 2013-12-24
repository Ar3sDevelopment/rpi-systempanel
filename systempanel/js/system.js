function initPanelCollapse() {
	$('.panel-heading .btn-link[data-toggle="hide"]').click(function () {
		if (!$(this).data('only') || ($(this).data('only') == false))
		{
			$('.panel').parent().hide();
			$($(this).data('target')).parent().parent().show();
			$(this).data('only', true);
		}
		else
		{
			$('.panel').parent().show();
			$(this).data('only', false);
		}
	});
	
	$('a').click(function () {
        window.location = $(this).prop("href");
        return false;
	});
}

function downloadWidget(widget_id_html, widget_id, sid) {
	$.post('widget_loader.php', { 'widget_id': widget_id, 'sid': sid }, function (data) {
		$('#' + widget_id_html + ' .panel-body').html(data);
		if ($('#' + widget_id_html + '[data-only="true"]').length <= 0)
			$('#' + widget_id_html).parent().show();
	});
}

function updateWidgetJson(widget_id, sid, callback, postData) {
	var defData = { 'widget_id': widget_id, 'sid': sid, 'json': true };
	$.extend(defData, postData);
	$.post('widget_loader.php', defData, function (data) {
		callback(data);
	});
}

function updateWidgetHtml(widget_id, sid, callback, postData) {
	var defData = { 'widget_id': widget_id, 'sid': sid };
	$.extend(defData, postData);
	$.post('widget_loader.php', defData, function (data) {
		callback(data);
	});
}

//TODO: Think about making AJAX Form jQuery plugin
function initAjaxForms() {
	$('form[data-type="ajax"]').submit(function(event) {
	    event.preventDefault();
	
		var $this = $(this);
	    var values = $this.serialize();
	
	    $.ajax({
	        url: $this.prop('action'),
	        type: $this.prop('method'),
	        data: values,
	        success: function() {
	        	alert('Done');
	        },
	        error:function() {
	            alert("Error");
	        }
	    });
	});
}
