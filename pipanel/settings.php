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
				$widgets = array();
				
				foreach ($json["widgets"] as $json_widget)
				{
					$widget = new Widget();
					
					$widget->id = $json_widget["id"];
					$widget->title = $json_widget["title"];
					
					if (isset($json_widget["updatetime"]))
						$widget->updatetime = $json_widget["updatetime"];
					
					if (isset($json_widget["enabled"]))
						$widget->enabled = $json_widget["enabled"];
					
					if (isset($json_widget["visible"]))
						$widget->visible = $json_widget["visible"];
						
					$widget->position = isset($json_widget["position"]) ? $json_widget["position"] : count($this->widgets);
					$widget->templatefile = $json_widget["templatefile"];	
					$widget->phpfile = $json_widget["phpfile"];
					
					$widgets[$widget->position] = $widget;
				}
				
				ksort($widgets);
				
				$this->widgets = array();
				foreach ($widgets as $widget)
				{
					$this->widgets[] = $widget;
				}
			}
		}
		
		public function check_auth($auth = false)
		{
			if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $this->user || hash("sha512", $_SERVER['PHP_AUTH_PW']) != $this->password)
			{
				if ($auth) header('WWW-Authenticate: Basic realm="Insert settings.json credentials"');
				header('HTTP/1.0 401 Unauthorized');
?>
				<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
				exit;
			}
		}
	}
?>