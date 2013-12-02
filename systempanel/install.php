<?php
	session_start();
	
	if (isset($_POST) && !empty($_POST))
	{
		$data = 
		'<?php
			$db_host = "' . $_POST['db_host'] . '";
			$db_name = "' . $_POST['db_name'] . '";
			$db_user = "' . $_POST['db_username'] . '";
			$db_pass = "' . $_POST['db_password'] . '";
		?>';
		
		file_put_contents('../framework/db.conf.inc.php', $data);
		
		exec("/usr/bin/sudo chmod 775 ../framework/db.conf.inc.php");
		
		sleep(1);
		
		require_once('../framework/db.conf.inc.php');
		
		$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
		
		if ($mysqli->connect_errno)
		{
			die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}
		
		$queries = array(
		"CREATE TABLE `hash` (
		  `name` varchar(10) NOT NULL,
		  `description` varchar(250) NOT NULL,
		  PRIMARY KEY (`name`)
		)",
		"CREATE TABLE `session` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `id_user` int(11) NOT NULL,
		  `sid` varchar(100) NULL,
		  `expiredate` datetime DEFAULT NULL,
		  `device` varchar(100) NOT NULL,
		  PRIMARY KEY (`id`),
		)",
		"CREATE TABLE `user` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `id_hash` varchar(10) NOT NULL,
		  `username` varchar(100) NOT NULL,
		  `password` varchar(200) NOT NULL,
		  `admin` bit(1) NOT NULL DEFAULT b'0',
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `username` (`username`)
		)",
		"CREATE TABLE `user_widget` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `id_user` int(11) NOT NULL,
		  `id_widget` int(11) NOT NULL,
		  `id_html` varchar(250) NOT NULL,
		  `position` int(11) NOT NULL,
		  `enabled` bit(1) NOT NULL DEFAULT b'1',
		  `visible` bit(1) NOT NULL DEFAULT b'1',
		  `version` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		)",
		"CREATE TABLE `widget` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `columns` int(11) NOT NULL DEFAULT '6',
		  `updatetime` int(11) NOT NULL DEFAULT '1000',
		  `title` varchar(100) NOT NULL,
		  `phpfile` varchar(250) NOT NULL,
		  `templatefile` varchar(250) NOT NULL,
		  `requireadmin` bit(1) NOT NULL DEFAULT b'0',
		  `version` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		)",
		"INSERT INTO `hash` (`name`, `description`) VALUES
			('md5', 'MD5'),
			('sha1', 'SHA 1'),
			('sha256', 'SHA 256'),
			('sha512', 'SHA 512')",
		"INSERT INTO `user` (`id`, `id_hash`, `username`, `password`, `admin`) VALUES
			(1, 'sha512', ?, ?, b'1')",
		"INSERT INTO `user_widget` (`id`, `id_user`, `id_widget`, `id_html`, `position`, `enabled`, `visible`, `version`) VALUES
			(1, 1, 1, 'sys_info', 0, b'1', b'1', 1),
			(2, 1, 2, 'cpu_info', 1, b'1', b'1', 1),
			(3, 1, 4, 'usb_info', 2, b'1', b'0', 1),
			(4, 1, 5, 'network', 3, b'1', b'0', 1),
			(5, 1, 6, 'memory_info', 4, b'1', b'1'),
			(6, 1, 7, 'updates', 10, b'1', b'0', 1),
			(7, 1, 8, 'disks', 11, b'1', b'0', 1),
			(8, 1, 9, 'processes', 12, b'1', b'0', 1),
			(9, 1, 12, 'cpu_graph', 5, b'1', b'1', 1),
			(10, 1, 13, 'temp_graph', 6, b'1', b'1', 1),
			(11, 1, 11, 'transmission', 7, b'1', b'1', 1),
			(12, 1, 10, 'power', 8, b'1', b'1', 1),
			(13, 1, 3, 'camera', 9, b'1', b'1', 1)",
		"INSERT INTO `widget` (`id`, `columns`, `updatetime`, `title`, `phpfile`, `templatefile`, `requireadmin`, `version`) VALUES
			(1, 4, 1000, 'System Info', 'system', 'general_info.tpl', b'0', 1),
			(2, 4, 1000, 'CPU Info', 'processor', 'cpu_info.tpl', b'0', 1),
			(3, 4, 300000, 'Camera Image', 'raspistill', 'raspistill.tpl', b'1', 1),
			(4, 4, 3600000, 'USB Info', 'usb', 'usb.tpl', b'0', 1),
			(5, 4, 1000, 'Network Usage', 'network', 'network.tpl', b'0', 1),
			(6, 4, 1000, 'Memory Usage', 'memory', 'memory.tpl', b'0', 1),
			(7, 6, 3600000, 'Updates', 'updates', 'updates.tpl', b'1', 1),
			(8, 6, 60000, 'Disk Usage', 'disk', 'disks.tpl', b'0', 1),
			(9, 6, 1000, 'Processes', 'process', 'process.tpl', b'0', 1),
			(10, 2, 0, 'Power', 'power', 'power.tpl', b'1', 1),
			(11, 4, 1000, 'Transmission', 'transmission', 'transmission.tpl', b'0', 1),
			(12, 4, 1000, 'CPU Load', 'cpu_graph', 'cpu_graph.tpl', b'0', 1),
			(13, 2, 1000, 'Temperature', 'temp_graph', 'temp_graph.tpl', b'0', 1)"
		);
		
		foreach ($queries as $query)
		{
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			
			if ($stmt->param_count > 0) $stmt->bind_param("ss", $_POST['admin_username'], hash('sha512', $_POST['admin_password'])); 
			
			$stmt->execute();
			$stmt->close();
		}
		
		$mysqli->close();
		
		header('Location: index.php');
	}
	else
	{
		require_once('../framework/Smarty/Smarty.class.php');
		
		$smarty = new Smarty();
		
		$smarty->display('install.tpl');
	}
?>