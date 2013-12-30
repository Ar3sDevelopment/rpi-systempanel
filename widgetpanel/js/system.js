(function ($) {
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
