<?php
	require_once('../framework/settings.inc.php');
	require_once('smarty_widget.php');
	
	$sid = $_POST['sid'];
	$json = isset($_POST['json']) ? $_POST['json'] : false;
	
	$settings = new Settings($sid);
	
	if (isset($_POST['widget_id']))
	{	
		$selWidget;
		
		foreach ($settings->user->widgets as $widget_info)
		{	
			if ($widget_info->id == $_POST['widget_id'])
			{
				$selWidget = $widget_info->widget;
				break;
			}
		}
		
		require_once('../panelwidgets/' . $selWidget->folder . '/' . $selWidget->phpfile . '.widget.php');
		
		$full_class_name = $selWidget->class_name . 'Widget';
		$widget = new $full_class_name;
		$widget->template_file = $selWidget->templatefile;
		$widget->manage_post($_POST);
		
		$smarty = new Smarty_Widget($selWidget->folder);
		
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