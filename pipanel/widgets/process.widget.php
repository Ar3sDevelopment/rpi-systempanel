<?php
	require_once('abstract.widget.php');

	class Process
	{
		public $user;
		public $pid;
		public $cpu_percent;
		public $mem_percent;
		public $start_date;
		public $command;
		
		public function __construct($procinfo)
		{
			/*
			USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
root         1  0.0  0.1   2140   608 ?        Ss   nov02   0:30 init [2]  
root         2  0.0  0.0      0     0 ?        S    nov02   0:00 [kthreadd]
			 */
			
			$split = preg_split("/\s+/", $procinfo, 12);
			if (count($split) > 11)
				list($user, $pid, $cpu_percent, $mem_percent, $vsz, $rss, $tty, $stat,  $start, $time, $command, $args) = $split;
			else
				list($user, $pid, $cpu_percent, $mem_percent, $vsz, $rss, $tty, $stat,  $start, $time, $command) = $split;
			
			$this->user = $user;
			$this->pid = $pid;
			$this->cpu_percent = $cpu_percent;
			$this->mem_percent = $mem_percent;
			$this->start_date = $time;
			$this->command = $command;
		}
	}
	
	class ProcessWidget extends AbstractWidget
	{
		public $procs;
		
		public function load()
		{
			$this->procs = array();
			
			exec("ps aux", $procsinfo);
			unset($procsinfo[0]);
			foreach ($procsinfo as $procinfo)
			{	
				$this->procs[] = new Process($procinfo);
			}
		}
	}
	
	$widget = new ProcessWidget();
?>