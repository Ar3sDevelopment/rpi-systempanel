<?php
	require_once('../framework/settings.inc.php');
	
	if (isset($_GET['sid']))
	{
		session_start();
		$sid = $_GET['sid'];
		$session_id = session_id($sid);
		session_destroy();
		$user = Settings::get_user_info($sid);
		Settings::update_sid(null, $_SERVER['REMOTE_ADDR'], $user->id);
	}
	
	header('Location: login.php');
?>