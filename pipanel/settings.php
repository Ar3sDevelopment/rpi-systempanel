<?php
	session_start();
	require_once('settings.inc.php');
	require_once('Smarty.class.php');
	require_once('widget.php');
	
	$settings = new Settings('settings.json');
	$settings->check_auth(true);
	
	function compare_position($w1, $w2)
	{
		if ($w1->position == $w2->position) return 0;
		
		return $w1->position < $w2->position ? -1 : 1;
	}
	
	if (isset($_POST['save']))
	{	
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
		
		for ($c = 0; $c < count($settings->widgets); $c++)
		{
			$widget = $settings->widgets[$c];
			
			$widget->id = $_POST["widget-id"][$c];
			$widget->position = $_POST["widget-position"][$c];
			$widget->title = $_POST["widget-title"][$c];
			$widget->columns = $_POST["widget-columns"][$c];
			$widget->updatetime = $_POST["widget-updatetime"][$c];
			$widget->phpfile = $_POST["widget-phpfile"][$c];
			$widget->templatefile = $_POST["widget-templatefile"][$c];
			$widget->visible = isset($_POST["widget-visible"][$c]) ? $_POST["widget-visible"][$c] : false;
			$widget->enabled = isset($_POST["widget-enabled"][$c]) ? $_POST["widget-enabled"][$c] : false;
		}
		
		usort($settings->widgets, "compare_position");
		$settings->save();
	}
	
	$smarty = new Smarty();
	
	$smarty->assign('settings', $settings);
	$smarty->display('settings.tpl');
?>