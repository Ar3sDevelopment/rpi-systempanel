<?php
	require_once('settings.php');
	require_once('widget.php');

	$settings = new Settings('settings.json');
	$settings->check_auth();

	header("Content-type: application/json");
	
	class SystemInfo
	{	
		public $general_info;
		public $memory;
		public $disks;
		public $nics;
		public $updates;
		
		public function __construct() {
			$this->general_info = new GeneralInfo();
			$this->general_info->load();
			
			$this->memory = new Memory();
			$this->memory->load();
			
			$this->disks();
			$this->network();
			$this->updates();
		}
	}
	
	$obj = new SystemInfo();
	
	echo $obj->json();
?>
