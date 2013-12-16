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
				$this->poweroff();
				
				return 1;
			}
			else if (isset($post['pr']) && $post['pr'])
			{
				$this->reboot();
				
				return 1;
			}
			
			return 0;
		}
	}
?>