<?php
	require_once('widget.php');

	class Settings
	{
		private $path;
		private $id_user;
		public $user;
		public $passwordhashed;
		public $widgets;
		public $hashmethod;
		
		public function __construct($auth = false)
		{
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
				
			if (!isset($_SERVER['PHP_AUTH_USER']))
			{
				if ($auth) header('WWW-Authenticate: Basic realm="Insert settings.json credentials"');
				header('HTTP/1.0 401 Unauthorized');
?>
				<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
				exit;
			}
			
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			$query = "SELECT u.id, u.username, u.password, h.name hash FROM users u INNER JOIN hash h ON u.id_hash = h.id WHERE username = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $_SERVER['PHP_AUTH_USER']); 
			$stmt->execute();

			if ($result = $stmt->get_result())
			{
				while ($obj = $result->fetch_object())
				{
					if ($obj->password == hash($obj->hash, $_SERVER['PHP_AUTH_PW']))
					{
						$this->id_user = $obj->id;
						$this->user = $obj->username;
						$this->passwordHashed = $obj->password;
						$this->hashMethod = $obj->hash;
					}
					else
					{
						$this->id_user = -1;
						
						if ($auth) header('WWW-Authenticate: Basic realm="Insert settings.json credentials"');
						header('HTTP/1.0 401 Unauthorized');
?>
						<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
						exit;
					}
				}

				$result->close();
			}
			else
			{
				$this->id_user = -1;
				
				if ($auth) header('WWW-Authenticate: Basic realm="Insert settings.json credentials"');
				header('HTTP/1.0 401 Unauthorized');
?>
				<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
				exit;
			}
			
			$stmt->close();
			
			if ($this->id_user != -1)
			{		
				$query = "SELECT * FROM widget WHERE id_user = ? ORDER BY position";
				$stmt = $mysqli->stmt_init();
				$stmt->prepare($query);
				$stmt->bind_param("i", $this->id_user); 
				$stmt->execute();
	
				if ($result = $stmt->get_result())
				{
					$this->widgets = array();		
					
					while ($obj = $result->fetch_object())
					{
						$widget = new Widget();
					
						$widget->id = $obj->id_html;
						$widget->title = $obj->title;
						$widget->updatetime = $obj->updatetime;
						$widget->enabled = $obj->enabled;
						$widget->visible = $obj->visible;
						$widget->columns = $obj->columns;
						$widget->position = $obj->position;
						$widget->templatefile = $obj->templatefile;
						$widget->phpfile = $obj->phpfile;
						
						$this->widgets[] = $widget;
					}
					
					$result->close();
				}
				
				$stmt->close();
				$mysqli->close();
			}
			
			/*$this->loadFile($path);*/
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
				$json = json_decode($string);
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
			if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $this->user || hash("sha512", $_SERVER['PHP_AUTH_PW']) != $this->passwordhashed)
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