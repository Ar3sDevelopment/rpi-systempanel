<?php
	function printr($obj)
	{
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

	printr($_SERVER);
	printr(get_browser($_SERVER['HTTP_USER_AGENT']));
?>