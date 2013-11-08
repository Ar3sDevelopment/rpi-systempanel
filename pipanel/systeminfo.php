<?php
	require_once('settings.php');
	require_once('widget.php');

	$settings = new Settings('settings.json');

	if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $settings->user || hash("sha512", $_SERVER['PHP_AUTH_PW']) != $settings->password)
	{
		header('HTTP/1.0 401 Unauthorized');
?>
		<h1>HTTP/1.0 401 Unauthorized</h1>
<?php
		exit;
	}

	header('Content-type: application/json');

	function NumberWithCommas($in)
	{
		return number_format($in);
	}
	function  WriteToStdOut($text)
	{
		$stdout = fopen('php://stdout','w') or die($php_errormsg);
		fputs($stdout, "\n" . $text);
	}
	
	class Disk
	{
		public $size;
		public $used;
		public $avail;
		public $mount;
		public $typex;
		public $percent;
		public $percent_part;
		
		public function __construct($diskinfo)
		{
			list($drive, $typex, $size, $used, $avail, $percent, $mount) = preg_split("/\s+/", $diskinfo);
	
			$this->typex = $typex;
			$this->size = $size;
			$this->used = $used;
			$this->avail = $avail;
			$this->percent = $percent;
			$this->mount = $mount;
			$this->percent_part = str_replace( "%", "", $this->percent);
		}
	}
	
	class Nic
	{
		public $name;
		public $encap;
		public $mac;
		public $ip;
		public $tx;
		public $rx;
	}
	
	class GeneralInfo
	{
		public $host;
		public $current_time;
		public $system;
		public $kernel;
		public $processor;
		public $frequency;
		public $cpuload;
		public $cpu_temperature;
		public $uptime;
		
		public function load()
		{
			$this->current_time = exec("date +'%d %b %Y<br />%T %Z'");
			$this->frequency = NumberWithCommas(exec("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq") / 1000);
			$processorArr = explode(': ', exec('cat /proc/cpuinfo | grep Processor'));
			$this->processor = str_replace('-compatible processor', '', $processorArr[1]);
			$this->cpu_temperature = round(exec("cat /sys/class/thermal/thermal_zone0/temp ") / 1000, 1);
			
			list($this->system, $this->host, $this->kernel) = preg_split("/\s/", exec("uname -a"), 4);
			
			$uptime_array = explode(" ", exec("cat /proc/uptime"));
			$seconds = round($uptime_array[0], 0);
			$minutes = $seconds / 60;
			$hours = $minutes / 60;
			$days = floor($hours / 24);
			$hours = sprintf('%02d', floor($hours - ($days * 24)));
			$minutes = sprintf('%02d', floor($minutes - ($days * 24 * 60) - ($hours * 60)));
			if ($days == 0)
			{
				$this->uptime = $hours . "h " .  $minutes . "m";
			}
			else
			{
				$this->uptime = $days . "d " .  $hours . "h " .  $minutes . "m";
			}
			
			$output1 = null;
			$output2 = null;
			exec("cat /proc/stat", $output1);
			sleep(1);
			exec("cat /proc/stat", $output2);
			$this->cpuload = 0;
			for ($i=0; $i < 1; $i++)
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
	
	class Memory
	{
		public $total_mem;
		public $used_mem;
		public $free_mem;
		public $buffer_mem;
		public $cache_mem;
		public $total_swap;
		public $used_swap;
		public $free_swap;
		
		public $percent_used;
		public $percent_free;
		public $percent_buff;
		public $percent_cach;
		public $percent_swap;
		public $percent_swap_free;
		
		public function load()
		{
			$meminfo = file("/proc/meminfo");
			for ($i = 0; $i < count($meminfo); $i++)
			{
				list($item, $data) = preg_split("/:/", $meminfo[$i], 2);
				$item = trim(chop($item));
				$data = intval(preg_replace("/[^0-9]/", "", trim(chop($data))));
				switch($item)
				{
					case "MemTotal": $this->total_mem = $data; break;
					case "MemFree": $this->free_mem = $data; break;
					case "SwapTotal": $this->total_swap = $data; break;
					case "SwapFree": $this->free_swap = $data; break;
					case "Buffers": $this->buffer_mem = $data; break;
					case "Cached": $this->cache_mem = $data; break;
					default: break;
				}
			}
			$this->used_mem = $this->total_mem - $this->free_mem;
			$this->used_swap = $this->total_swap - $this->free_swap;
			$this->percent_free = round(($this->free_mem / $this->total_mem) * 100);
			$this->percent_used = round(($this->used_mem / $this->total_mem) * 100);
			$this->percent_swap = round((($this->total_swap - $this->free_swap ) / $this->total_swap) * 100);
			$this->percent_swap_free = round(($this->free_swap / $this->total_swap) * 100);
			$this->percent_buff = round(($this->buffer_mem / $this->total_mem) * 100);
			$this->percent_cach = round(($this->cache_mem / $this->total_mem) * 100);
			$this->used_mem = NumberWithCommas($this->used_mem);
			$this->used_swap = NumberWithCommas($this->used_swap);
			$this->total_mem = NumberWithCommas($this->total_mem);
			$this->free_mem = NumberWithCommas($this->free_mem);
			$this->total_swap = NumberWithCommas($this->total_swap);
			$this->free_swap = NumberWithCommas($this->free_swap);
			$this->buffer_mem = NumberWithCommas($this->buffer_mem);
			$this->cache_mem = NumberWithCommas($this->cache_mem);
		}
	}
	
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
		
		public function json()
		{
			return json_encode($this);
		}
		
		private function disks() {
			$this->disks = array();
			
			exec("df -h -T -x tmpfs -x devtmpfs -x rootfs", $diskfree);
			unset($diskfree[0]);
			foreach ($diskfree as $diskinfo)
			{	
				$this->disks[] = new Disk($diskinfo);
			}
		}
		
		private function network() {
			exec("/sbin/ifconfig -s", $nics);
			unset($nics[0]);
			foreach ($nics as $nic)
			{
				$nicname = preg_split("/\s+/",$nic, 2);
				$nicrecord = new Nic();
				$nicrecord->name = $nicname[0];
				exec("/sbin/ifconfig $nicrecord->name", $ifnic);
				
				if (preg_match("/Link encap:((\w+\s?)+)/", $ifnic[0], $matches) > 0)
				{
					$nicrecord->encap = $matches[1];
				}
				
				if (preg_match("/HWaddr\s((\w{2}:){5}\w{2})/", $ifnic[0], $matches) > 0)
				{
					$nicrecord->mac = $matches[1];
				}
				
				if (preg_match("/inet addr:((\d{1,3}\.){3}\d{1,3})/", $ifnic[1], $matches) > 0)
				{
					$nicrecord->ip = $matches[1];
				}
				
				if (preg_match_all("/[RT]X bytes:(\d+)/", $ifnic[6], $matches) > 0)
				{
					$nicrecord->rx = $matches[1][0];
					$nicrecord->tx = $matches[1][1];
				}
				
				$this->nics[] = $nicrecord;
				
				unset($ifnic);
			}
		}
		
		private function updates() {
			if (!apc_fetch('updates'))
			{
				$this->updates = array();
				
				exec("/usr/bin/sudo /usr/bin/apt-get --just-print upgrade", $updates);
		
				foreach ($updates as $update)
				{
					if (preg_match("/^Inst (.*)/", $update, $matches) > 0)
					{
						$this->updates[] = $matches[1];
					}
				}
				
				apc_store('updates', $this->updates, 1 * 60 * 60);
			}
			else
			{
				$this->updates = apc_fetch('updates');
			}
		}
	}
	
	$obj = new SystemInfo();
	
	echo $obj->json();
?>
