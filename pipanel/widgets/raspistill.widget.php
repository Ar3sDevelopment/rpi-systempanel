<?php
	require_once('abstract.widget.php');

	class RaspstillWidget extends AbstractWidget
	{
		public function load() {
			exec("cd /home/pi && /usr/bin/sudo /usr/bin/raspistill -o still.jpg -t 1 -rot 90");
			sleep(1);
		}
	}
	
	$widget = new RaspstillWidget();
?>