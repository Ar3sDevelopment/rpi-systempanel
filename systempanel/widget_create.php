<?php
	session_start();
	
	if (!isset($_GET['sid']) && !isset($_POST['sid']))
		header('Location: login.php');
	
	require_once ('../framework/settings.inc.php');
	
	$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id) || Settings::get_user_info($sid) == null)
		header('Location: login.php');
	
	require_once ('../framework/Smarty/Smarty.class.php');
	require_once ('../framework/widget.inc.php');
	
	$settings = new Settings($sid);
	$smarty = new Smarty();
	$widget_list = Settings::get_widget_list($sid);
	$smarty->assign('sid', $sid);
	$smarty->assign('widget_list', $widget_list);
	$smarty->assign('widget', new UserWidget());
	$smarty->display('widget_create.tpl');
?>