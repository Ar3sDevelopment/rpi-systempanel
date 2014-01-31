var updatingWidgets = []; ( function($) {
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

		$.initSocket = function(socket, url, port) {
			var sockurl = 'http://' + url + ':' + port;
			socket = io.connect(sockurl);

			socket.on('first_use_data', $.manageFirstUseData);
			socket.on('updated_data', $.manageUpdatedData);

			return socket;
		};

		$.manageFirstUseData = function(data) {
			if (data != null && data.statusCode == 200) {
				$('#' + data.user_widget.id_html + ' .panel-body').html(data.output);
				if ($('#' + data.user_widget.id_html + '[data-only="true"]').length <= 0)
					$('#' + data.user_widget.id_html).parent().show();
			}
		};

		$.manageUpdatedData = function(data) {
			if (data != null && data.statusCode == 200 && data.callback != null && ( typeof window[data.callback] == "function")) {
				window[data.callback](data.output);
			}
		};

		$.downloadWidget = function(socket, widget_id_html, widget_id, sid) {
			socket.emit('request_first_data', {
				json : false,
				sid : sid,
				widget_id : widget_id
			});
		};

		$.startUpdatingWidget = function(socket, widget_id, sid, callback, postData, mode) {
			if ($.inArray(widget_id, updatingWidgets) == -1) {
				updatingWidgets.push(widget_id);
				var defData = {
					json : (mode == 'json'),
					sid : sid,
					widget_id : widget_id
				};
				$.extend(defData, postData);
				socket.on('updated_data_' + widget_id, function(data) {
					if (data != null && data.statusCode == 200 && callback != null) {
						callback(data.output);
					}
				});
				socket.emit('request_updating', defData);
			} else {
			}
		};

		$.startUpdatingWidgetJson = function(socket, widget_id, sid, callback, postData) {
			$.startUpdatingWidget(socket, widget_id, sid, callback, postData, 'json');
		};

		$.startUpdatingWidgetHtml = function(socket, widget_id, sid, callback, postData) {
			$.startUpdatingWidget(socket, widget_id, sid, callback, postData, 'html');
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
