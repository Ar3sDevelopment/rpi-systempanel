<?php
	require_once('database.inc.php');
	require_once('widget.inc.php');

	class Settings
	{
		private $path;
		public $widgets;
		
		public static function get_widgets($sid)
		{
			$db = new Database();
			return $db->get_widgets($sid);
		}
		
		public static function save_widgets($widgets)
		{
			$db = new Database();
			return $db->save_widgets($widgets);
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
		
		public function toggleWidgetVisibility($sid, $widget_id, $visibility)
		{
			$db = new Database();
			return $db->toggleWidgetVisibility($sid, $widget_id, $visibility);
		}
		
		public function toggleWidgetState($sid, $widget_id, $enabled)
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
			$this->widgets = $db->load($sid);
		}
		
		public function save($sid, $username, $password, $hash, $new_widgets)
		{
			$db = new Database();
			return $db->save($sid, $username, $password, $hash, $new_widgets);
		}
	}
?>