<?php
	require_once('../framework/settings.inc.php');
	session_destroy();
	Settings::update_sid($sid, null);
	header('Location: login.php');
?>