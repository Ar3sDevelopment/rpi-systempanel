<?php
	require_once('../panelwidgets/abstract.widget.php');

	class TempGraphWidget extends AbstractWidget
	{
		public $cpu_temperature;
		
		public function load()
		{	
			$this->cpu_temperature = round(exec("cat /sys/class/thermal/thermal_zone0/temp") / 1000, 1);
		}
	}
?>