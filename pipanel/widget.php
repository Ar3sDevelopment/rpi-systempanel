<?php
	require_once('Smarty.class.php');

	class Widget
	{
		public $id;
		public $title;
		public $visible;
		
		public $templatefile;
		public $phpfile;
		
		public function __construct()
		{
			$this->visible = true;
			$this->templatefile = null;
		}
	}
?>