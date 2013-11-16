<?php
	require_once('widget.php');

	class Settings
	{
		private $path;
		public $widgets;
		
		public static function get_user_info($sid)
		{
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "SELECT * FROM users WHERE sid = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
			$stmt->execute();
			
			if ($result = $stmt->get_result())
			{	
				$obj = $result->fetch_object();

				$result->close();
				$stmt->close();
				$mysqli->close();
				return $obj;
			}
			
			return null;
		}
		
		public static function get_hash_methods($sid)
		{
			$hashes = array();
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "SELECT name, description, name = (SELECT id_hash FROM users WHERE sid = ?) selected FROM hash";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
			$stmt->execute();
			
			if ($result = $stmt->get_result())
			{	
				while ($obj = $result->fetch_object())
				{
					$hashes[] = $obj;
				}

				$result->close();
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $hashes;
		}
		
		public static function check_login($username, $password)
		{
			$uid = -1;
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "SELECT u.id, u.username, u.password, h.name hash FROM users u INNER JOIN hash h ON u.id_hash = h.name WHERE username = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $username);
			$stmt->execute();

			if ($result = $stmt->get_result())
			{
				while ($obj = $result->fetch_object())
				{
					if ($obj->password == hash($obj->hash, $password))
					{
						$uid = $obj->id;
					}
				}

				$result->close();
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $uid;
		}
		
		public static function update_sid($sid, $uid)
		{
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "UPDATE users SET sid = ? WHERE id = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ss", $sid, $uid); 
			$stmt->execute();
			$stmt->close();
			$mysqli->close();	
		}
		
		public function __construct($sid)
		{
			$this->load($sid);
		}
		
		private function load($sid)
		{
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "SELECT * FROM widget WHERE id_user = (SELECT u.id FROM users u INNER JOIN hash h ON u.id_hash = h.name WHERE sid = ?) ORDER BY position";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
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
		
		public function save($sid, $username, $password, $hash, $new_widgets)
		{
			$mysqli = new mysqli("localhost", "system", "#Sy57eM#", "system_panel");
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			$query = "UPDATE users SET username = ?, password = ?, id_hash = ? WHERE sid = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ssss", $username, $password, $hash, $sid); 
			$stmt->execute();
			$stmt->close();
			
			for ($c = 0; $c < count($this->widgets); $c++)
			{
				$widget = $this->widgets[$c];
				$new_widget = $new_widgets[$c];
				
				$query = "UPDATE widget SET position = ?, columns = ?, updatetime = ?, title = ?, id_html = ?, phpfile = ?, templatefile = ?, visible = ?, enabled = ? WHERE id_html = ?";
				$stmt = $mysqli->stmt_init();
				$stmt->prepare($query);
				$stmt->bind_param("iiissssiis", $new_widget->position,
												$new_widget->columns,
												$new_widget->updatetime,
												$new_widget->title,
												$new_widget->id,
												$new_widget->phpfile,
												$new_widget->templatefile,
												$new_widget->visible,
												$new_widget->enabled,
												$widget->id);

				$stmt->execute();
				$stmt->close();
			}
			
			$mysqli->close();

			$this->load($sid);
		}
	}
?>