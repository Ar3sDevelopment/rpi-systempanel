<?php
	class Database
	{
		private $db_host;
		private $db_name;
		private $db_user;
		private $db_pass;
		
		public function __construct()
		{
			$db_host = "localhost";
			$db_name = "system_panel";
			$db_user = "system";
			$db_pass = "#Sy57eM#";
		}
		
		private function init_mysqli()
		{
			$mysqli = mysqli($db_host, $db_user, $db_pass, $db_name);
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			return $mysqli;
		}
		
		public function get_widgets()
		{
			$hashes = array();
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT * FROM widget";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->execute();
			
			if ($result = $stmt->get_result())
			{	
				while ($obj = $result->fetch_object())
				{
					$widgets[] = $obj;
				}

				$result->close();
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $widgets;
		}
		
		public static function save_widgets($widgets)
		{
			$mysqli = $this->init_mysqli();
			
			for ($c = 0; $c < count($widgets); $c++)
			{
				$widget = $widgets[$c];
				$new_widget = $new_widgets[$c];
				
				$query = "UPDATE widget SET columns = ?, updatettime = ?, title = ?, phpfile = ?, templatefile = ? WHERE id = ?";
				$stmt = $mysqli->stmt_init();
				$stmt->prepare($query);
				$stmt->bind_param("iisssi", $new_widget->columns,
												$new_widget->updatettime,
												$new_widget->title,
												$new_widget->phpfile,
												$new_widget->templatefile,
												$widget->id);

				$stmt->execute();
				$stmt->close();
			}
		}
		
		public static function get_user_info($sid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT u.* FROM user u INNER JOIN session s ON u.id = s.id_user WHERE s.sid = ? and expiredate >= now()";
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
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT name, description, name = (SELECT u.id_hash FROM user u INNER JOIN session s ON u.id = s.id_user WHERE s.sid = ? and expiredate >= now()) selected FROM hash";
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
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT u.id, u.username, u.password, h.name hash FROM user u INNER JOIN hash h ON u.id_hash = h.name WHERE username = ?";
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
		
		public static function update_sid($sid, $device, $uid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT COUNT(*) session_count FROM session WHERE sid = ? or device = ?";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ss", $sid, $device); 
			$stmt->execute();
			
			$insert = true;
			
			if ($result = $stmt->get_result())
			{
				$obj = $result->fetch_object();
				
				if ($obj->session_count) $insert = false;
			}
			
			$stmt->close();
			
			if ($insert)
			{
				$query = "INSERT INTO session (sid, expiredate, device, id_user) VALUES (?, ?, ?, ?)";
			}
			else
			{
				$query = "UPDATE session SET sid = ?, expiredate = ? where device = ? and id_user = ?";
			}
			
			$date = new DateTime();
			
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ssss", $sid, $date->add(new DateInterval('P7D'))->format(DateTime::ISO8601), $device, $uid); 
			$stmt->execute();
			$stmt->close();
			
			
			$mysqli->close();	
		}
		
		private function load($sid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "SELECT * FROM user_widget uw INNER JOIN widget w ON uw.id_widget = w.id WHERE uw.id_user = (SELECT u.id FROM user u INNER JOIN session s ON u.id = s.id_user WHERE s.sid = ? and expiredate >= now()) ORDER BY uw.position";
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
			$mysqli = $this->init_mysqli();
			
			$query = "UPDATE user SET username = ?, password = ?, id_hash = ? WHERE id = (SELECT s.id_user FROM session s WHERE sid = ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ssss", $username, $password, $hash, $sid); 
			$stmt->execute();
			$stmt->close();
			
			for ($c = 0; $c < count($this->widgets); $c++)
			{
				$widget = $this->widgets[$c];
				$new_widget = $new_widgets[$c];
				
				$query = "UPDATE user_widget SET position = ?, id_html = ?, visible = ?, enabled = ? WHERE id_html = ?";
				$stmt = $mysqli->stmt_init();
				$stmt->prepare($query);
				$stmt->bind_param("isiis", $new_widget->position,
												$new_widget->id,
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