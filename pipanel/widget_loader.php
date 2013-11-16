<?php
	require_once('settings.inc.php');
	require_once('smarty_widget.php');
	
	$sid = $_POST['sid'];
	
	$settings = new Settings($sid);
	
	if (isset($_POST['widget_php']))
	{
		require_once('widgets/' . $_POST['widget_php'] . '.widget.php');
		
		foreach ($settings->widgets as $widget_info)
		{
			if ($widget_info->phpfile == $_POST['widget_php'])
			{
				$widget->template_file = $widget_info->templatefile;
			}
		}
		
		$smarty = new Smarty_Widget();
		
		//$widget->load();
		echo $widget->html($smarty);
	}
?>