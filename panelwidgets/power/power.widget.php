<?php
	require_once('../panelwidgets/abstract.widget.php');

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
		
		public function manage_post($post)
		{
			if (isset($post['po']) && $post['po'])
			{
				$widget->poweroff();
			}
			
			if (isset($post['pr']) && $post['pr'])
			{
				$widget->reboot();
			}
		}
	}
?>