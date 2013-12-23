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