<?php
	require_once('widget.php');

	class Settings
	{
		private $path;
		public $user;
		public $passwordhashed;
		public $widgets;
		public $hashmethod;
		
		public function __construct($path)
		{
			$this->loadFile($path);
		}
		
		public function hash($password)
		{
			return hash($this->hashmethod, $password);
		}
		
		public function save()
		{
			file_put_contents($this->path, json_encode($this));
		}
		
		public function loadFile($path)
		{
			if (file_exists($path))
			{
				$this->path = $path;
				$string = file_get_contents($path);
				$this = json_decode($string);
				/*$json = json_decode($string);
				$this->user = $json->user;
				$this->hashmethod = isset($json->hashmethod) ? $json->hashmethod : "sha512";
				$this->passwordhashed = isset($json->passwordhashed) ? $json->passwordhashed : $this->hash($json->password);
				$widgets = array();
				
				foreach ($json->widgets as $json_widget)
				{
					$widget = new Widget();
					
					$widget->id = $json_widget->id;
					$widget->title = $json_widget->title;
					
					if (isset($json_widget->updatetime))
						$widget->updatetime = $json_widget->updatetime;
					
					if (isset($json_widget->enabled))
						$widget->enabled = $json_widget->enabled;
					
					if (isset($json_widget->visible))
						$widget->visible = $json_widget->visible;
					
					if (isset($json_widget->columns))
						$widget->columns = $json_widget->columns;
					
					$widget->position = isset($json_widget->position) ? $json_widget->position : count($this->widgets);
					$widget->templatefile = $json_widget->templatefile;
					$widget->phpfile = $json_widget->phpfile;
					
					$widgets[$widget->position] = $widget;
				}*/
				
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
			/*if (apc_fetch('USER'))
			{
				if (apc_fetch('USER') != $this->user || apc_fetch('PASSWORD') != $this->password)
				{
					apc_delete('USER');
				}
			}
			
			if (!apc_fetch('USER'))
			{*/
				if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $this->user || hash("sha512", $_SERVER['PHP_AUTH_PW']) != $this->passwordhashed)
				{
					if ($auth) header('WWW-Authenticate: Basic realm="Insert settings.json credentials"');
					header('HTTP/1.0 401 Unauthorized');
?>
					<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
					exit;
				}
				
			/*	apc_store('USER', $this->user, 15 * 60);
				apc_store('PASSWORD', $this->password, 15 * 60);
			}*/
		}
	}
?>