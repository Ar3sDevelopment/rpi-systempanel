<?php
	require_once('../panelwidgets/abstract.widget.php');

	class USB
	{
		public $bus;
		public $device;
		public $id;
		public $name;
		
		public function __construct($usbinfo)
		{
			list($busString ,$bus, $deviceString, $device, $idString, $id, $name) = preg_split("/\s+/", $usbinfo, 7);
			
			$this->bus = $bus;
			$this->device = str_replace(":", "", $device);
			$this->id = $id;
			$this->name = $name;
		}
	}
	
	class USBWidget extends AbstractWidget
	{
		public $devices;
		
		public function load()
		{
			$this->devices = array();
			
			exec("lsusb", $devicesinfo);
			foreach ($devicesinfo as $usbinfo)
			{	
				$this->devices[] = new USB($usbinfo);
			}
		}
		
		public function manage_post($post)
		{
			return 0;
		}
	}
?>