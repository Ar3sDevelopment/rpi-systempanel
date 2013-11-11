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
		{for $c = 0 to count($widgets) - 1 step 2}
		<div class="row">
			{if !$widgets[$c]->visible}
			<div class="col-md-6" style="display: none;">
			{else}
			<div class="col-md-6">
			{/if}
				{include file="widget.tpl" widget=$widgets[$c]}
			</div>
			{if ($c + 1) < count($widgets)}
				{if !$widgets[$c + 1]->visible}
			<div class="col-md-6" style="display: none;">
				{else}
			<div class="col-md-6">
				{/if}
				{include file="widget.tpl" widget=$widgets[$c + 1]}
			</div>
			{/if}
		</div>
		{/for}
	</div>
</body>
</html>
