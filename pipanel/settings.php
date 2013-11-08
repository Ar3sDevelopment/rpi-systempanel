<?php
	require_once('widget.php');

	class Settings
	{
		public $user;
		public $password;
		public $widgets;
		
		public function __construct($path)
		{
			$this->loadFile($path);
		}
		
		public function loadFile($path)
		{
			if (file_exists($path))
			{
				$string = file_get_contents($path);
				$json = json_decode($string,true);
				$this->user = $json['user'];
				$this->password = hash("sha512", $json['password']);
				$this->widgets = array();
				
				foreach ($json["widgets"] as $json_widget)
				{
					$widget = new Widget();
					
					$widget->id = $json_widget["id"];
					$widget->title = $json_widget["title"];
					
					if (isset($json_widget["visible"]))
						$widget->visible = $json_widget["visible"];
						
					if (isset($json_widget["templatefile"]))
						$widget->templatefile = $json_widget["templatefile"];
						
					$widget->phpfile = $json_widget["phpfile"];
					
					$this->widgets[] = $widget;
				}
			}
		}
	}
?>