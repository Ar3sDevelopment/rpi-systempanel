<?php
	require_once('abstract.widget.php');

	class Nic
	{
		public $name;
		public $encap;
		public $mac;
		public $ip;
		public $tx;
		public $rx;
	}
	
	class NetworkWidget extends AbstractWidget
	{
		public $nics;
		
		private function human_bytes($bytes)
		{
			$strings = array('B', 'KB', 'MB', 'GB', 'TB');
			$idx = 0;
			while ($bytes > 1024) {
				$bytes /= 1024;
				$idx++;
			}
	
			return round($bytes, 2) . ' ' . $strings[$idx];
		}
		
		public function load() {
			exec("/sbin/ifconfig -s -a", $nics);
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
					$nicrecord->rx = $this->human_bytes($matches[1][0]);
					$nicrecord->tx = $this->human_bytes($matches[1][1]);
				}
				
				$this->nics[] = $nicrecord;
				
				unset($ifnic);
			}
		}
	}
	
	$widget = new NetworkWidget();
?>