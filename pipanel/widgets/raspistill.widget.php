<?php
	require_once('abstract.widget.php');

	class RaspstillWidget extends AbstractWidget
	{
		public function load() {
			exec("/usr/bin/sudo /usr/bin/raspistill -t 0 -o /var/www/system/tmp/still.jpg");
			sleep(1);
		}
	}
	
	$widget = new RaspstillWidget();
?>