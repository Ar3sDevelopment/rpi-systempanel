( function($) {
		$.initPanelCollapse = function() {
			$('.panel-heading .btn-link[data-toggle="hide"]').click(function() {
				if (!$(this).data('only') || ($(this).data('only') == false)) {
					$('.panel').parent().hide();
					$($(this).data('target')).parent().parent().show();
					$(this).data('only', true);
				} else {
					$('.panel').parent().show();
					$(this).data('only', false);
				}
			});

			//TODO: Move it to $(document).ready in templates
			$('a').click(function() {
				window.location = $(this).prop("href");
				return false;
			});
		};

		$.downloadWidget = function(widget_id_html, widget_id, sid) {
			var socket = io.connect('http://192.168.0.254:1337');
			socket.on('first_use_data', function(statusCode, contentType, data) {
				if (statusCode == 200) {
					$('#' + widget_id_html + ' .panel-body').html(data);
					if ($('#' + widget_id_html + '[data-only="true"]').length <= 0)
						$('#' + widget_id_html).parent().show();
				}
			});
			socket.emit('request_first_data', {
				json : false,
				sid : sid,
				widget_id : widget_id
			});
		};

		$.updateWidget = function(widget_id, sid, callback, postData, mode) {
			var socket = io.connect('http://192.168.0.254:1337');
			socket.on('updated_data', function(statusCode, contentType, data) {
				if (statusCode == 200) {
					callback(data);
				}
			});
			var defData = {
				json : (mode == 'json'),
				sid : sid,
				widget_id : widget_id
			};
			$.extend(defData, postData);
			socket.emit('request_new_data', defData);
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
				var successCallback = (($this.data('success') || '').length > 0 ? function() {
					window[$this.data('success')]($this);
				} : function() {
				});
				var errorCallback = (($this.data('error') || '').length > 0 ? function() {
					window[$this.data('error')]($this);
				} : function() {
				});

				$.ajax({
					url : url,
					type : type,
					data : values,
					success : successCallback,
					error : errorCallback
				});
			});
		};
	}(jQuery));
