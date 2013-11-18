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
		public $columns;
		
		public function __construct()
		{
			$this->visible = true;
			$this->enabled = true;
			$this->updatetime = 1000;
			$this->columns = 6;
		}
	}
?>