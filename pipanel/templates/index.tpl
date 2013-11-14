<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>System Info Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" href="images/icon60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/icon76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/icon60@2x.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/icon76@2x.png">
	<link rel="apple-touch-startup-image" href="images/startup.jpg">
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/system.js"></script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="menu-navbar-collapse" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="settings.php">Settings</a></li>
				</ul>
			</div>
		</nav>
		{$c = 0}
		{$columns = 0}
		<div class="row">
		{while $c < count($widgets)}
			{if $widgets[$c]->enabled}
				{if !$widgets[$c]->visible}
					<div class="col-md-{$widgets[$c]->columns}" style="display: none;">
				{else}
					<div class="col-md-{$widgets[$c]->columns}">
				{/if}
				{include file="widget.tpl" widget=$widgets[$c]}
				</div>
				{$columns = $columns + {$widgets[$c]->columns}}
				{if $columns == 12}
					{$columns = 0}
					</div>
					<div class="row">
				{/if}
			{/if}
			{$c = $c + 1}
		{/while}
		</div>
	</div>
</body>
</html>
