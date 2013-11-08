<?php
	require_once('settings.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings('settings.json');
	
	if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $settings->user || hash("sha512", $_SERVER['PHP_AUTH_PW']) != $settings->password)
	{
		header('WWW-Authenticate: Basic realm="Il mio realm"');
		header('HTTP/1.0 401 Unauthorized');
?>
		<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
		exit;
	}
	
	$smarty = new Smarty();
	
	$smarty->assign('widgets', $settings->widgets);
	$smarty->assign('widget_count', count($settings->widgets));
	
	$smarty->display('index.tpl');
?>