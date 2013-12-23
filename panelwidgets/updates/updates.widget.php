<?php
	require_once('../panelwidgets/abstract.widget.php');

	class Update
	{
		public $name;
		public $new_version;
		public $old_version;
	}

	class UpdatesWidget extends AbstractWidget
	{
		public $updates;
		
		public function load()
		{
			/*if (!apc_fetch('updates'))
			{*/
				$this->updates = array();
				
				exec("/usr/bin/sudo /usr/bin/apt-get --just-print upgrade", $updates);
				
				foreach ($updates as $update)
				{
					if (preg_match("/^Inst (.*) \[(.*)\] \(([^s]*)\s.*\)/", $update, $matches) > 0)
					{
						$update = new Update();
						list($regex, $update->name, $update->old_version, $update->new_version) = $matches;
						$this->updates[] = $update;
					}
				}
				
				apc_store('updates', $this->updates, 1 * 60 * 60);
			/*}
			else
			{
				$this->updates = apc_fetch('updates');
			}*/
		}
		
		public function manage_post($post)
		{
			return 0;
		}
	}
?>