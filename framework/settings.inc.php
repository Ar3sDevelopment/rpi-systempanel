<?php
	require_once('database.inc.php');
	require_once('widget.inc.php');
	require_once('user_widget.inc.php');
	require_once('user.inc.php');

	class Settings
	{
		public $user;
		private $path;
		
		public static function get_widgets($sid)
		{
			$db = new Database();
			return $db->get_widgets($sid);
		}
		
		public static function get_widget_list($sid)
		{
			$db = new Database();
			return $db->get_widget_list($sid);
		}
		
		public static function save_widget($sid, $widget)
		{
			$db = new Database();
			return $db->save_widget($sid, $widget);
		}
		
		public static function create_widget($sid, $widget)
		{
			$db = new Database();
			return $db->create_widget($sid, $widget);
		}
		
		public static function get_user_info($sid)
		{
			$db = new Database();
			return $db->get_user_info($sid);
		}
		
		public static function get_hash_methods($sid)
		{
			$db = new Database();
			return $db->get_hash_methods($sid);
		}
		
		public static function check_login($username, $password)
		{
			$db = new Database();
			return $db->check_login($username, $password);
		}
		
		public static function update_sid($sid, $device, $uid)
		{
			$db = new Database();
			return $db->update_sid($sid, $device, $uid);
		}
		
		public static function toggleWidgetVisibility($sid, $widget_id, $visibility)
		{
			$db = new Database();
			return $db->toggleWidgetVisibility($sid, $widget_id, $visibility);
		}
		
		public static function toggleWidgetState($sid, $widget_id, $enabled)
		{
			$db = new Database();
			return $db->toggleWidgetState($sid, $widget_id, $enabled);
		}
		
		public function __construct($sid)
		{
			$this->load($sid);
		}
		
		private function load($sid)
		{
			$db = new Database();
			$this->user = new User();
			$this->user->widgets = $db->load($sid);
		}
		
		public static function save_user($sid, $username, $password, $hash)
		{
			$db = new Database();
			return $db->save_user($sid, $username, $password, $hash);
		}
		
		public static function save_user_widget($sid, $widget)
		{
			$db = new Database();
			return $db->save_user_widget($sid, $widget);
		}
		
		public static function create_user_widget($sid, $widget, $wid)
		{
			$db = new Database();
			return $db->create_user_widget($sid, $widget, $wid);
		}
		
		public static function get_widget_from_user_widget($sid, $uwid)
		{
			$db = new Database();
			return get_widget_from_user_widget($sid, $uwid);
		}
		
		public static function insert_widget($sid, $title, $folder, $phpfile, $classname, $templatefile, $columns, $updatetime, $requireadmin, $version)
		{
			$db = new Database();
			return insert_widget($sid, $title, $folder, $phpfile, $classname, $templatefile, $columns, $updatetime, $requireadmin, $version);
		}
	}
?>