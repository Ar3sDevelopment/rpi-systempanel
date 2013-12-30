<?php
	if (!file_exists("../framework/db.conf.inc.php"))
	{
		header('Location: install.php');
	}
	else
	{
		session_start();

		if (!isset($_GET['sid']))
			header('Location: login.php');
		
		require_once('../framework/settings.inc.php');
		
		$sid = $_GET['sid'];
		$session_id = session_id($sid);
		$settings = new Settings($sid);
		
		if (empty($session_id) || !$settings->logged) header('Location: login.php');
		
		require_once('../framework/Smarty/Smarty.class.php');
		require_once('../framework/widget.inc.php');
		
		$smarty = new Smarty();
		
		$smarty->assign('widgets', $settings->user->widgets);
		$smarty->assign('user', $settings->user);
		$smarty->assign('sid', $sid);
		
		$smarty->display('index.tpl');	
	}
?>