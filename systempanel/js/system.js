(function ($) {
	$.initPanelCollapse = function() {
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
		
		//TODO: Move it to $(document).ready in templates
		$('a').click(function () {
	        window.location = $(this).prop("href");
	        return false;
		});
	};
	
	$.downloadWidget = function(widget_id_html, widget_id, sid) {
		$.post('widget_loader.php', { 'widget_id': widget_id, 'sid': sid }, function (data) {
			$('#' + widget_id_html + ' .panel-body').html(data);
			if ($('#' + widget_id_html + '[data-only="true"]').length <= 0)
				$('#' + widget_id_html).parent().show();
		});
	};
	
	$.updateWidget = function(widget_id, sid, callback, postData, mode) {
		var defData = { 'widget_id': widget_id, 'sid': sid, 'json': (mode == 'json') };
		$.extend(defData, postData);
		$.post('widget_loader.php', defData, function (data) {
			callback(data);
		});
	};
	
	$.updateWidgetJson = function(widget_id, sid, callback, postData) {
		$.updateWidget(widget_id, sid, callback, postData, 'json');
	};
	
	$.updateWidgetHtml = function(widget_id, sid, callback, postData) {
		$.updateWidget(widget_id, sid, callback, postData, 'html');
	};
	
	//TODO: Think about making AJAX Form jQuery plugin
	$.initAjaxForms = function() {
		$('form[data-type="ajax"]').submit(function(event) {
		    event.preventDefault();
		
			var $this = $(this);
		    var values = $this.serialize();
		    var url = $this.prop('action');
		    var type = $this.prop('method');
		    var successCallback = $this.data('success') || function() { };
		    var errorCallback = $this.data('error') || function() { };
		
		    $.ajax({
		        url: url,
		        type: type,
		        data: values,
		        success: successCallback,
		        error: errorCallback
		    });
		});
	};
}(jQuery));