<?php
	require_once('../panelwidgets/abstract.widget.php');

	class UpdatesWidget extends AbstractWidget
	{
		public function load()
		{
			if (!apc_fetch('updates'))
			{
				$this->updates = array();
				
				exec("/usr/bin/sudo /usr/bin/apt-get --just-print upgrade", $updates);
		
				foreach ($updates as $update)
				{
					if (preg_match("/^Inst (.*)/", $update, $matches) > 0)
					{
						$this->updates[] = $matches[1];
					}
				}
				
				apc_store('updates', $this->updates, 1 * 60 * 60);
			}
			else
			{
				$this->updates = apc_fetch('updates');
			}
		}
		
		public function manage_post($post)
		{
			return 0;
		}
	}
?>