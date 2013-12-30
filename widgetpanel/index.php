<?php
	session_start();

	if (!isset($_GET['sid']) && !isset($_POST['sid']))
		header('Location: login.php');

	require_once('../framework/settings.inc.php');

	$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];
	$session_id = session_id($sid);
	$settings = new Settings($sid);
	
	if (empty($session_id) || !$settings->logged) header('Location: login.php');
	
	require_once('../framework/Smarty/Smarty.class.php');
	require_once('../framework/widget.inc.php');
	
	$widgets = Settings::get_widgets($sid);
	
	if (isset($_POST['create_widget']))
	{
		$widget = new Widget();
		$widget->title = $_POST["widget-title"];
		$widget->columns = $_POST["widget-columns"];
		$widget->updatetime = $_POST["widget-updatetime"];
		$widget->phpfile = $_POST["widget-phpfile"];
		$widget->templatefile = $_POST["widget-templatefile"];
		$widget->folder = $_POST["widget-folder"];
		$widget->class_name = $_POST["widget-class-name"];
		$widget->templatefile = $_POST["widget-templatefile"];
		$widget->version = $_POST["widget-version"];
		$widget->requireadmin = (isset($_POST["widget-requireadmin"]) ? 1 : 0);
		
		Settings::create_widget($sid, $widget);
	}
	else if (isset($_POST['widget_action']))
	{
		$widget = new Widget();
		$widget->id = $_POST["widget-id"];
		$widget->title = $_POST["widget-title"];
		$widget->columns = $_POST["widget-columns"];
		$widget->updatetime = $_POST["widget-updatetime"];
		$widget->phpfile = $_POST["widget-phpfile"];
		$widget->templatefile = $_POST["widget-templatefile"];
		$widget->folder = $_POST["widget-folder"];
		$widget->class_name = $_POST["widget-class-name"];
		$widget->templatefile = $_POST["widget-templatefile"];
		$widget->version = $_POST["widget-version"];
		$widget->requireadmin = (isset($_POST["widget-requireadmin"]) ? 1 : 0);
		
		if ($_POST['widget_action'] == 'save') {
			Settings::save_widget($sid, $widget);
		} else if ($_POST['widget_action'] == 'delete') {
			Settings::delete_widget($sid, $widget);
		}
	}
	else
	{
		$smarty = new Smarty();
		
		$smarty->assign('sid', $sid);
		$smarty->assign('user', $settings->user);
		$smarty->assign('widgets', $widgets);
		
		$smarty->display('index.tpl');	
	}
?>