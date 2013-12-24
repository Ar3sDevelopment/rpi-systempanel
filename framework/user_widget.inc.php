<?php
	class UserWidget
	{
		public $id;
		public $id_widget;
		public $id_html;
		public $position;
		public $enabled;
		public $visible;
		
		public $widget;
		public $user;
		
		public function __construct()
		{
			$this->visible = true;
			$this->enabled = true;
		}
	}
?>