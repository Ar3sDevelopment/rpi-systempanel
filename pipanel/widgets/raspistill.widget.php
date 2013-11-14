<?php
	require_once('abstract.widget.php');

	class RaspstillWidget extends AbstractWidget
	{
		public function load() {
			exec("cd /home/pi && /usr/bin/sudo /usr/bin/raspistill -o still.jpg -w 640 -h 480 -t 1");
			sleep(1);
		}
	}
	
	$widget = new RaspstillWidget();
?>