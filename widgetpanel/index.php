<?php
	session_start();

	if (!isset($_GET['sid']) && !isset($_POST['sid']))
		header('Location: login.php');

	require_once('../framework/settings.inc.php');

	$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id) || Settings::get_user_info($sid) == null) header('Location: login.php');
	
	require_once('../framework/Smarty.class.php');
	require_once('../framework/widget.inc.php');
	
	$settings = new Settings($sid);
	
	$widgets = Settings::get_widgets();
	
	if (isset($_POST['save']))
	{
		for ($c = 0; $c < count($widgets); $c++)
		{
			$widget = $widgets[$c];
			
			$widget->id = $_POST["widget-id"][$c];
			$widget->title = $_POST["widget-title"][$c];
			$widget->columns = $_POST["widget-columns"][$c];
			$widget->updatetime = $_POST["widget-updatetime"][$c];
			$widget->phpfile = $_POST["widget-phpfile"][$c];
			$widget->templatefile = $_POST["widget-templatefile"][$c];
		}
		
		Settings::save_widgets($widgets);
	}
	
	$smarty = new Smarty();
	
	$smarty->assign('sid', $sid);
	$smarty->assign('widgets', $widgets);
	$smarty->display('index.tpl');
?>