$(document).ready(function () {
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
});
