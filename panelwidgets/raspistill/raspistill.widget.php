<?php
	require_once('../panelwidgets/abstract.widget.php');

	class RaspistillWidget extends AbstractWidget
	{
		public $result;
		
		public function load() {
			exec("cd /home/pi && /usr/bin/sudo /usr/bin/raspistill -o still.jpg -t 1 -w 640 -h 480 -ev 10 -ISO 800 -n -ex auto -q 100", $this->result);
			sleep(1);
		}
		
		public function manage_post($post)
		{
			return 0;
		}
	}
?>