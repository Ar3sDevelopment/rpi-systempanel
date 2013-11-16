<?php
	require_once('settings.inc.php');

	$settings = new Settings($sid);

	abstract class AbstractWidget
	{
		public $template_file;
		
		public function __construct()
		{
			$this->load();
		}
		
		public function json()
		{
			json_encode($this);
		}
		
		public function html($smarty)
		{	
			$smarty->assign('widget', $this);
			
			$smarty->display($this->template_file);
		}
		
		abstract public function load();
	}
	
	$widget = null;
?>