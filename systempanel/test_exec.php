<?php
	require('../framework/TransmissionRPC.class.php');

	function printr($obj)
	{
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

	$rpc = new TransmissionRPC();
	
	$result = $rpc->sstats();
	
	printr($result);
	
	$result = $rpc->get();
	
	foreach ($result->arguments->torrents as $item)
	{
		$item->statusString = $rpc->getStatusString($item->status);
	}
	
	printr($result);
	
	exec("cd /home/pi && /usr/bin/sudo /usr/bin/raspistill -o still.jpg -t 1 -w 640 -h 480 -ev 10 -rot 90 -ISO 800", $result);
	
	printr($result);
?>