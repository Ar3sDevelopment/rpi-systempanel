<?php
	if (!isset($_GET['sid']))
		header('Location: login.php');
	
	$sid = $_GET['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id)) session_start();
	
	require_once('settings.inc.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings($sid);
	
	$smarty = new Smarty();
	
	/*echo "<pre>";
	print_r($settings);
	echo "</pre>";*/
	$smarty->assign('widgets', $settings->widgets);
	$smarty->assign('sid', $sid);
	
	$smarty->display('index.tpl');
?>