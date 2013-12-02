<?php
	require_once('../panelwidgets/abstract.widget.php');

	class CpuGraphWidget extends AbstractWidget
	{
		public $cpuload;
		
		public function load()
		{	
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
		
		public function manage_post($post)
		{
		}
	}
?>