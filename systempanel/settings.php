<?php
	session_start();

	if (!isset($_GET['sid']) && !isset($_POST['sid']))
		header('Location: login.php');

	require_once('../framework/settings.inc.php');

	$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];
	$session_id = session_id($sid);
	
	if (empty($session_id) || Settings::get_user_info($sid) == null) header('Location: login.php');
	
	require_once('../framework/Smarty/Smarty.class.php');
	require_once('../framework/widget.inc.php');
	
	$settings = new Settings($sid);
	
	function compare_position($w1, $w2)
	{
		if ($w1->position == $w2->position) return 0;
		
		return $w1->position < $w2->position ? -1 : 1;
	}
	
	if (isset($_POST['visibility']))
	{				
		$widget_id = $_POST["widget-id"];
		
		$settings->toggleWidgetVisibility($sid, $widget_id, $_POST['visibility']);
		
		header('Content-Type: application/json; charset=utf-8');
		
		echo json_encode((object) array('visible' => (bool)$_POST['visibility']));
		return;
	}
	
	if (isset($_POST['enable']))
	{
		$widget_id = $_POST["widget-id"];
		
		$settings->toggleWidgetState($sid, $widget_id, $_POST['enable']);
		
		header('Content-Type: application/json; charset=utf-8');
		
		echo json_encode((object) array('enabled' => (bool)$_POST['enable']));
		return;
	}
	
	if (isset($_POST['save_user']))
	{
		$username =  $_POST['username'];
		$hashmethod = $_POST['hashmethod'];
		$password = hash($hashmethod, $_POST['password']);
		
		$settings->save_user($sid, $username, $password, $hashmethod);
	}
	
	if (isset($_POST['save_widget']))
	{
		$widget = new UserWidget();
				
		$widget->id = $_POST["widget_id"];	
		$widget->id_html = $_POST["widget_id_html"];
		$widget->position = $_POST["widget_position"];
			
		$settings->save_user_widget($sid, $widget);
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
