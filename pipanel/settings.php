<?php
	session_start();

	if (!isset($_GET['sid']) && !isset($_POST['sid']))
		header('Location: login.php');

require_once('settings.inc.php');

	$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id) || Settings::get_user_info($sid) == null) header('Location: login.php');
	
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings($sid);
	
	function compare_position($w1, $w2)
	{
		if ($w1->position == $w2->position) return 0;
		
		return $w1->position < $w2->position ? -1 : 1;
	}
	
	if (isset($_POST['save']))
	{
		$username =  $_POST['username'];
		$hashmethod = $_POST['hashmethod'];
		$password = hash($hashmethod, $_POST['password']);
		
		$widgets = array();
		for ($c = 0; $c < count($settings->widgets); $c++)
		{
			$widget = new Widget();
			
			$widget->id = $_POST["widget-id"][$c];
			$widget->position = $_POST["widget-position"][$c];
			$widget->title = $_POST["widget-title"][$c];
			$widget->columns = $_POST["widget-columns"][$c];
			$widget->updatetime = $_POST["widget-updatetime"][$c];
			$widget->phpfile = $_POST["widget-phpfile"][$c];
			$widget->templatefile = $_POST["widget-templatefile"][$c];
			$widget->visible = isset($_POST["widget-visible"][$c]) ? 1 : 0;
			$widget->enabled = isset($_POST["widget-enabled"][$c]) ? 1 : 0;
			
			$widgets[] = $widget;
		}
		
		$settings->save($sid, $username, $password, $hashmethod, $widgets);
	}
	
	$smarty = new Smarty();
	
	$hashes = Settings::get_hash_methods($sid);
	$user_info = Settings::get_user_info($sid);
	
	$smarty->assign('sid', $sid);
	$smarty->assign('settings', $settings);
	$smarty->assign('user', $user_info);
	$smarty->assign('hashes', $hashes);
	$smarty->display('settings.tpl');
?>