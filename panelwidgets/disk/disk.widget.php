<?php
	require_once('../panelwidgets/abstract.widget.php');

	class Disk
	{
		public $size;
		public $used;
		public $avail;
		public $mount;
		public $typex;
		public $percent;
		
		public function __construct($diskinfo)
		{
			list($drive, $typex, $size, $used, $avail, $percent, $mount) = preg_split("/\s+/", $diskinfo);
	
			$this->typex = $typex;
			$this->size = $size;
			$this->used = $used;
			$this->avail = $avail;
			$this->mount = $mount;
			$this->percent_used = str_replace( "%", "", $percent);
			$this->percent_avail = 100 - $this->percent_used;
		}
	}
	
	class DiskWidget extends AbstractWidget
	{
		public $disks;
		
		public function load() {
			$this->disks = array();
			
			exec("df -h -T -x tmpfs -x devtmpfs -x rootfs", $diskfree);
			unset($diskfree[0]);
			foreach ($diskfree as $diskinfo)
			{	
				$this->disks[] = new Disk($diskinfo);
			}
		}
		
		public function manage_post($post)
		{
			return 0;
		}
	}
?>