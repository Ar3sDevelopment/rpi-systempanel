<?php
	class Widget
	{
		public $id;
		public $columns;
		public $updatetime;
		public $title;
		public $phpfile;
		public $templatefile;
		public $requireadmin;
		public $version;
		public $folder;
		public $class_name;
		
		public function __construct()
		{
			$this->updatetime = 1000;
			$this->columns = 6;
			$this->requireadmin = false;
		}
	}
?>