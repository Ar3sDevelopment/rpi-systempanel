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
			/*
Bus 001 Device 002: ID 0424:9512 Standard Microsystems Corp. 
Bus 001 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub
Bus 001 Device 003: ID 0424:ec00 Standard Microsystems Corp.
			 */
			
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
	}
?>