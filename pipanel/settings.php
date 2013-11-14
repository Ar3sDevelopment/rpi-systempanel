<?php
	session_start();
	require_once('settings.inc.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings('settings.json');
	$settings->check_auth(true);
	
	if (isset($_POST['save']))
	{
		if (isset($_POST['username']))
		{
			$settings->user = $_POST['username'];
		}
		
		if (isset($_POST['hashmethod']))
		{
			$settings->hash_method = $_POST['hashmethod'];
		}
		
		if (isset($_POST['password']))
		{
			$settings->passwordHashed = $settings->hash($_POST['password']);
		}
		
		$settings->save();
	}
	
	$smarty = new Smarty();
	
	$smarty->assign('settings', $settings);
	$smarty->display('settings.tpl');
?>