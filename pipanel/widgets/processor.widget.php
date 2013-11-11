<?php
	require_once('abstract.widget.php');

	class ProcessorWidget extends AbstractWidget
	{
		public $processor;
		public $frequency;
		public $cpuload;
		public $cpu_temperature;
		
		public function load()
		{
			$this->frequency = number_format(exec("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq") / 1000);
			$processorArr = explode(": ", exec("cat /proc/cpuinfo | grep Processor"));
			$this->processor = str_replace("-compatible processor", "", $processorArr[1]);
			$this->cpu_temperature = round(exec("cat /sys/class/thermal/thermal_zone0/temp") / 1000, 1);
			
			$output1 = null;
			$output2 = null;
			exec("cat /proc/stat", $output1);
			sleep(1);
			exec("cat /proc/stat", $output2);
			$this->cpuload = 0;
			for ($i = 0; $i < 1; $i++)
			{
				$cpu_stat_1 = explode(" ", $output1[$i+1]);
				$cpu_stat_2 = explode(" ", $output2[$i+1]);

				$info1 = array("user"=>$cpu_stat_1[1], "nice"=>$cpu_stat_1[2], "system"=>$cpu_stat_1[3], "idle"=>$cpu_stat_1[4]);
				$info2 = array("user"=>$cpu_stat_2[1], "nice"=>$cpu_stat_2[2], "system"=>$cpu_stat_2[3], "idle"=>$cpu_stat_2[4]);
				$idlesum = $info2["idle"] - $info1["idle"] + $info2["system"] - $info1["system"];
				$sum1 = array_sum($info1);
				$sum2 = array_sum($info2);

				$load = (1 - ($idlesum / ($sum2 - $sum1))) * 100;
				$this->cpuload += $load;
			}
			$this->cpuload = round($this->cpuload, 1);
		}
	}
	
	$widget = new ProcessorWidget();
?>