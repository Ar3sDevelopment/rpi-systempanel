<?php
	session_start();
	require_once('settings.inc.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings('settings.json');
	$settings->check_auth(true);
	
	if (isset($_POST['save']))
	{
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		if (isset($_POST['username']))
		{
			$settings->user = $_POST['username'];
		}
		
		if (isset($_POST['hashmethod']))
		{
			$settings->hashmethod = $_POST['hashmethod'];
		}
		
		if (isset($_POST['password']))
		{
			$settings->passwordhashed = $settings->hash($_POST['password']);
		}
		
		$settings->save();
	}
	
	$smarty = new Smarty();
	
	$smarty->assign('settings', $settings);
	$smarty->display('settings.tpl');
?>