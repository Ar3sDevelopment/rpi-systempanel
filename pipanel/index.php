<?php
	session_start();

	if (!isset($_GET['sid']))
		header('Location: login.php');
	
	require_once('settings.inc.php');
	
	$sid = $_GET['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id) || Settings::get_user_info($sid) == null) header('Location: login.php');
	
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings($sid);
	
	$smarty = new Smarty();
	
	$smarty->assign('widgets', $settings->widgets);
	$smarty->assign('sid', $sid);
	
	$smarty->display('index.tpl');
?>