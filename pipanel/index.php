<?php
	session_start();
	require_once('settings.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings('settings.json');
	$settings->check_auth(true);
	
	$smarty = new Smarty();
	
	$smarty->assign('widgets', $settings->widgets);
	
	$smarty->display('index.tpl');
?>