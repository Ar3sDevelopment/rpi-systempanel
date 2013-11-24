<?php
	require_once('../framework/settings.inc.php');
	require_once('smarty_widget.php');
	
	$sid = $_POST['sid'];
	$json = isset($_POST['json']) ? $_POST['json'] : false;
	
	$settings = new Settings($sid);
	
	if (isset($_POST['widget_php']))
	{
		require_once('widgets/' . $_POST['widget_php'] . '.widget.php');
		
		$selWidget;
		
		foreach ($settings->widgets as $widget_info)
		{
			if ($widget_info->phpfile == $_POST['widget_php'])
			{
				$selWidget = $widget_info;
				$widget->template_file = $widget_info->templatefile;
			}
		}
		
		$smarty = new Smarty_Widget();
		
		$smarty->assign('widget_info', $selWidget);
		$smarty->assign('sid', $sid);
		
		if ($json)
		{
			header('Content-Type: application/json; charset=utf-8');
			echo $widget->json();
		}
		else
		{
			$widget->html($smarty);
		}
	}
?>