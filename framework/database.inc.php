<?php
	require_once("db.conf.inc.php");
	class Database
	{
		private $host;
		private $name;
		private $user;
		private $pass;
		
		public function __construct()
		{
			global $db_host, $db_name, $db_user, $db_pass;
			
			$this->host = $db_host;
			$this->name = $db_name;
			$this->user = $db_user;
			$this->pass = $db_pass;
		}
		
		private function init_mysqli()
		{
			$mysqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
			
			if ($mysqli->connect_errno)
			{
				die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
			}
			
			return $mysqli;
		}
		
		public function get_widgets($sid)
		{
			$hashes = array();
			$mysqli = $this->init_mysqli();
			
			$query = "CALL GetWidgets(?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
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
		
		public function get_widget_list($sid)
		{
			$hashes = array();
			$mysqli = $this->init_mysqli();
			
			$query = "CALL GetWidgetList(?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
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
		
		public function save_widget($sid, $widget)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL SaveWidget(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("iisssssiii", $widget->columns,
										$widget->updatettime,
										$widget->title,
										$widget->phpfile,
										$widget->templatefile,
										$widget->folder,
										$widget->class_name,
										$widget->version,
										$widget->requireadmin,
										$widget->id);

			$stmt->execute();
			$stmt->close();
		}
		
		public function create_widget($sid, $widget)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL CreateWidget(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("iisssssii", $widget->columns,
										$widget->updatetime,
										$widget->title,
										$widget->phpfile,
										$widget->templatefile,
										$widget->folder,
										$widget->class_name,
										$widget->version,
										$widget->requireadmin);

			print_r($stmt);

			$stmt->execute();
			$stmt->close();
			
			if (!file_exists("../panelwidgets/$widget->folder"))
			{
				mkdir("../panelwidgets/$widget->folder");
			}
			
			if (!file_exists("../panelwidgets/$widget->folder/$widget->phpfile.widget.php"))
			{
				file_put_contents("../panelwidgets/$widget->folder/$widget->phpfile.widget.php", "<?php
	require_once('../panelwidgets/abstract.widget.php');

	class $widget->class_name extends AbstractWidget
	{	
		public function load() {
			//TODO: Load widget here
		}
		
		public function manage_post(\$post)
		{
			//TODO: Manage \$_POST here, return 0 for OK
			return 0;
		}
	}
?>");
			}

			if (!file_exists("../panelwidgets/$widget->folder/templates"))
			{
				mkdir("../panelwidgets/$widget->folder/templates");
			}
			
			if (!file_exists("../panelwidgets/$widget->folder/templates"))
			{
				file_put_contents("", "../panelwidgets/$widget->folder/templates/$widget->templatefile");
			}
		}
		
		public function get_user_info($sid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL GetUserInfo(?)";
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
		
		public function get_hash_methods($sid)
		{
			$hashes = array();
			$mysqli = $this->init_mysqli();
			
			$query = "CALL GetHashes(?)";
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
		
		public function check_login($username, $password)
		{
			$uid = -1;
			$mysqli = $this->init_mysqli();
			
			$query = "CALL CheckLogin(?)";
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
		
		public function update_sid($sid, $device, $uid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL UpdateSid(?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ssi", $sid, $device, $uid);
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();	
		}
		
		public function toggleWidgetVisibility($sid, $widget_id, $visibility)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL ToggleWidgetVisibility(?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("isi", $visibility, $sid, $widget_id); 
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function toggleWidgetState($sid, $widget_id, $enabled)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL ToggleWidgetState(?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("isi", $enabled, $sid, $widget_id);
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function load($sid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL LoadSettings(?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
			$stmt->execute();

			$widgets = array();

			if ($result = $stmt->get_result())
			{				
				while ($obj = $result->fetch_object())
				{
					$user_widget = new UserWidget();
					$user_widget->widget = new Widget();
				
					$user_widget->id = $obj->uwid;
					$user_widget->id_widget = $obj->wid;
					$user_widget->id_html = $obj->id_html;
					$user_widget->enabled = $obj->enabled;
					$user_widget->visible = $obj->visible;
					$user_widget->position = $obj->position;
					$user_widget->widget->id = $obj->wid;
					$user_widget->widget->title = $obj->title;
					$user_widget->widget->updatetime = $obj->updatetime;
					$user_widget->widget->columns = $obj->columns;
					$user_widget->widget->templatefile = $obj->templatefile;
					$user_widget->widget->phpfile = $obj->phpfile;
					$user_widget->widget->folder = $obj->folder;
					$user_widget->widget->class_name = $obj->class_name;
					
					$widgets[] = $user_widget;
				}
				
				$result->close();
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $widgets;
		}
		
		public function save_user($sid, $username, $password, $hash)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL SaveUser(?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("ssss", $username, $password, $hash, $sid); 
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function save_user_widget($sid, $widget)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL SaveUserWidget(?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("isis", $widget->position,
											$widget->id_html,
											$widget->id,
											$sid);

			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function delete_user_widget($sid, $widget)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL DeleteUserWidget(?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("is", $widget->id, $sid);

			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
			
			$mysqli->close();
		}
		
		public function create_user_widget($sid, $widget, $wid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL CreateUserWidget(?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("isis", $widget->position,
											$widget->id_html,
											$wid,
											$sid);

			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function get_widget_from_user_widget($sid, $uwid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL GetWidgetFromUserWidget(?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("is", $uwid, $sid);
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
		
		public function insert_widget($sid, $title, $folder, $phpfile, $classname, $templatefile, $columns, $updatetime, $requireadmin, $version)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL InsertWidget(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("sssssiiiis", $title, $folder, $phpfile, $classname, $templatefile, $columns, $updatetime, $requireadmin, $version, $sid);
			$stmt->execute();
			$stmt->close();
			
			$mysqli->close();
		}
	}
?>
