<?php
	require_once('../panelwidgets/abstract.widget.php');
	require('TransmissionRPC.class.php');

	class TransmissionWidget extends AbstractWidget
	{
		public $total_torrents;
		public $active_torrents;
		public $seeding_torrents;
		public $downloading_torrents;
		
		public function load()
		{
			$rpc = new TransmissionRPC();
	
			$result = $rpc->sstats();
			
			$this->total_torrents = isset($result->arguments->torrentCount) ? $result->arguments->torrentCount : 0;
			$this->active_torrents = isset($result->arguments->activeTorrentCount) ? $result->arguments->activeTorrentCount : 0;
	
			$result = $rpc->get();
			$torrents = isset($result->arguments->torrents) ? $result->arguments->torrents : array();
			$statuses = array();
			
			if ($torrents != null && count($torrents) > 0)
			{
				foreach ($torrents as $item)
				{
					if (isset($item->status))
						$statuses[] = $rpc->getStatusString($item->status);
				}
				
			}
			
			$counts = array_count_values($statuses);
			
			$this->seeding_torrents = isset($counts["Seeding"]) ? $counts["Seeding"] : 0;
			$this->downloading_torrents = isset($counts["Downloading"]) ? $counts["Downloading"] : 0;
		}
		
		public function stop()
		{
			$rpc = new TransmissionRPC();
			
			$rpc->stop(array());
		}
		
		public function start()
		{
			$rpc = new TransmissionRPC();
			
			$rpc->start(array());
		}
		
		public function manage_post($post)
		{
			if (isset($_POST['sta'])) {
				$this->start();
				
				return 1;
			} else if (isset($_POST['sto'])) {
				$this->stop();
				
				return 1;
			}
			
			return 0;
		}
	}
?>