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
		
		if (empty($session_id) || Settings::get_user_info($sid) == null) header('Location: login.php');
		
		require_once('../framework/Smarty/Smarty.class.php');
		require_once('../framework/widget.inc.php');
		
		$settings = new Settings($sid);
		
		$smarty = new Smarty();
		
		$smarty->assign('widgets', $settings->user->widgets);
		$smarty->assign('sid', $sid);
		
		$smarty->display('index.tpl');	
	}
?>