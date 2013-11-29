<?php
	session_start();
	
	require_once('../framework/settings.inc.php');
	require_once('../framework/Smarty.class.php');

	if (isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$uid = Settings::check_login($username, $password);
		if ($uid != -1)
		{
			session_regenerate_id(true);
			
			$sid = session_id();
			Settings::update_sid($sid, $_SERVER['REMOTE_ADDR'], $uid);
			
			header("Location: index.php?sid=$sid");
		}
	}
	
	$smarty = new Smarty();
	
	$smarty->display('login.tpl');
?>