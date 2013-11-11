<?php
	require('Smarty.class.php');

	$smarty = new Smarty();
	$smarty->testInstall();

	function execute_test($cmd)
	{
		exec($cmd, $res);
		printr($res);
	}
	
	function execute_test_lsusb($cmd)
	{
		exec($cmd, $res);
		$newres = array();
		foreach ($res as $res_info)
		{
			$newres[] = preg_split("/\s+/", $res_info, 7);
		}
		printr($newres);
	}
	
	function printr($res)
	{
		echo "<pre>";
		print_r($res);
		echo "</pre>";
	}
	
	execute_test('ps aux');
	echo "<br />";
	execute_test_lsusb('lsusb');
	echo "<br />";
	execute_test('/sbin/ifconfig');
	
	exec("/sbin/ifconfig -s", $nics);
	printr($nics);
	unset($nics[0]);
	foreach ($nics as $nic)
	{
		$nicname = preg_split("/\s+/",$nic, 2);
		exec("/sbin/ifconfig $nicname[0]", $ifnic);
		echo preg_match("/Link encap:((\w+\s?)+)/", $ifnic[0], $matches) + "<br />";
		echo preg_match("/HWaddr\s((\w{2}:){5}\w{2})/", $ifnic[0], $matches) + "<br />";
		echo preg_match("/inet addr:((\d{1,3}\.){3}\d{1,3})/", $ifnic[1], $matches) + "<br />";
		echo preg_match_all("/[RT]X bytes:(\d+)/", $ifnic[6], $matches) + "<br />";
		printr($ifnic);
		printr($matches);
		unset($ifnic);
	}
	
	exec("/usr/bin/sudo /usr/bin/apt-get --just-print upgrade", $updates);
	
	$avail_updates = array();
	
	foreach ($updates as $update)
	{
		if (preg_match("/^Inst (.*)/", $update, $matches) > 0)
		{
			$avail_updates[] = $matches[1];
		}
	}
	
	printr($avail_updates);
	
	require('settings.php');
	
	$settings = new Settings('settings.json');
	
	printr($settings);
?>
