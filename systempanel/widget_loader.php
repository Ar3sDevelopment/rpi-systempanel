<?php
	require_once('../framework/settings.inc.php');
	require_once('smarty_widget.php');
	
	$sid = $_POST['sid'];
	$json = isset($_POST['json']) ? $_POST['json'] == 'true' : false;
	
	$settings = new Settings($sid);
	
	if (isset($_POST['widget_id']))
	{
		$selUserWidget = null;	
		$selWidget = null;
		
		foreach ($settings->user->widgets as $widget_info)
		{
			if ($widget_info->id == $_POST['widget_id'])
			{
				$selUserWidget = $widget_info;
				break;
			}
		}
		
		if ($selUserWidget != null)
		{
			require_once('../panelwidgets/' . $selUserWidget->widget->folder . '/' . $selUserWidget->widget->phpfile . '.widget.php');
			
			$full_class_name = $selUserWidget->widget->class_name . 'Widget';
			$widget = new $full_class_name;
			$widget->template_file = $selUserWidget->widget->templatefile;
	
			if ($widget->manage_post($_POST) == 0)
			{			
				if ($json)
				{
					header('Content-Type: application/json; charset=utf-8');
					echo $widget->json();
				}
				else
				{
					$smarty = new Smarty_Widget($selUserWidget->widget->folder);
				
					$smarty->assign('user_widget_info', $selUserWidget);
					$smarty->assign('widget_info', $selUserWidget->widget);
					$smarty->assign('sid', $sid);
					
					$widget->html($smarty);
				}
			}
		}
	}
?>