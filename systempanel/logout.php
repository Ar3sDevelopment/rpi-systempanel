<?php
	require_once('../framework/settings.inc.php');
	session_destroy();
	
	if (isset($_GET['sid']))
	{
		$sid = $_GET['sid'];
		$user = Settings::get_user_info($sid);
		Settings::update_sid(null, $_SERVER['REMOTE_ADDR'], $user->id);
	}
	
	header('Location: login.php');
?>