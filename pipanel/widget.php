<?php
	require_once('Smarty.class.php');

	class Widget
	{
		public $id;
		public $title;
		public $visible;
		public $enabled;
		public $phpfile;
		public $templatefile;
		public $updatetime;
		public $position;
		
		public function __construct()
		{
			$this->visible = true;
			$this->enabled = true;
			$this->updatetime = 1000;
		}
	}
?>