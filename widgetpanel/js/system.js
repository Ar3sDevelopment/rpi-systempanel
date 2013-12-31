(function ($) {
	$.initAjaxForms = function() {
		$('form[data-type="ajax"]').submit(function(event) {
		    event.preventDefault();
		
			var $this = $(this);
		    var values = $this.serialize();
		    var url = $this.prop('action');
		    var type = $this.prop('method');
		    var successCallback = (($this.data('success') || '').length > 0 ? function() { window[$this.data('success')]($this); } : function() { });
		    var errorCallback = (($this.data('error') || '').length > 0 ? function() { window[$this.data('error')]($this); } : function() { });
		
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
