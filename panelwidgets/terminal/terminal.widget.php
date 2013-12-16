<?php
	require_once('../panelwidgets/abstract.widget.php');

	class TerminalWidget extends AbstractWidget
	{
		public function load()
		{
		}
		
		public function execute($cmd)
		{
			exec($cmd, $res);
			foreach ($res as $line)
			{
				echo $line . "\n";
			}
		}
		
		public function manage_post($post)
		{	
			if (isset($_POST['cmd'])) {
				$this->execute($_POST['cmd']);
				
				return 1;
			}
			
			return 0;
		}
	}
?>