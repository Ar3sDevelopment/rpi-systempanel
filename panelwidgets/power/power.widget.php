<?php
	require_once('../abstract.widget.php');

	class PowerWidget extends AbstractWidget
	{
		public function load()
		{
		}
		
		public function poweroff()
		{
			exec('/usr/bin/sudo poweroff');
		}
		
		public function reboot()
		{
			exec('/usr/bin/sudo reboot');
		}
	}
	
	$widget = new PowerWidget();
	
	if (isset($_POST['po']) && $_POST['po'])
	{
		$widget->poweroff();
	}
	
	if (isset($_POST['pr']) && $_POST['pr'])
	{
		$widget->reboot();
	}
?>