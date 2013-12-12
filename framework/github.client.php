<?php
	class GitHubClient
	{
		public function __construct()
		{
		}
		
		public function GetPanelVersion()
		{
			$json = file_get_contents('https://api.github.com/repos/Ar3s/rpi-systempanel/tags');
			$versions = json_decode($json);
			$latest = $versions[0];
			
			return $latest->name;
		}
	}
?>