<?php
	require_once('../framework/Smarty/Smarty.class.php');

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
		public $requireadmin;
		public $version;
		public $folder;
		public $class_name;
		
		public function __construct()
		{
			$this->visible = true;
			$this->enabled = true;
			$this->updatetime = 1000;
			$this->columns = 6;
			$this->requireadmin = false;
		}
	}
?>