$(document).ready(function () {
	$('.panel-heading .btn-link[data-toggle="hide"]').click(function () {
		if (!$(this).attr('data-only') || ($(this).attr('data-only') == 'false'))
		{
			$('.panel').parent().hide();
			$($(this).attr('data-target')).parent().parent().show();
			$(this).attr({ 'data-only': true });
		}
		else
		{
			$('.panel').parent().parent().show();
			$(this).attr({ 'data-only': false });
		}
	});
});
