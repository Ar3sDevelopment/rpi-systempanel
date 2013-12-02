<?php
	require_once('../framework/settings.inc.php');

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
			return json_encode($this);
		}
		
		public function html($smarty)
		{	
			$smarty->assign('widget', $this);
			
			$smarty->display($this->template_file);
		}
		
		abstract public function load();
		abstract public function manage_post($post);
	}
?>