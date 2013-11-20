<?php
	function printr($obj)
	{
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}
	
	require('../framework/TransmissionRPC.class.php');

	$rpc = new TransmissionRPC();
	
	$result = $rpc->sstats();
	
	printr($result);

	$result = $rpc->get(array(), array("status"));
	
	printr($result);
?>