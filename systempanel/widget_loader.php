<?php
	require_once('../framework/settings.inc.php');
	require_once('smarty_widget.php');
	
	$sid = $_POST['sid'];
	$json = isset($_POST['json']) ? $_POST['json'] : false;
	
	$settings = new Settings($sid);
	
	if (isset($_POST['widget_php']))
	{	
		$selWidget;
		
		foreach ($settings->widgets as $widget_info)
		{
			if ($widget_info->phpfile == $_POST['widget_php'])
			{
				$selWidget = $widget_info;
			}
		}
		
		require_once('../panelwidgets/' . $selWidget->folder . '/' . $selWidget->phpfile . '.widget.php');
		
		$full_class_name = $selWidget->class_name . 'Widget';
		$widget = new $full_class_name;
		$widget->template_file = $selWidget->templatefile;
		
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