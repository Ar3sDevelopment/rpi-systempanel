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
			echo $res;
		}
		
		public function manage_post($post)
		{
			if (isset($_POST['cmd'])) {
				$widget->execute($_POST['cmd']);
			}
		}
	}
?>