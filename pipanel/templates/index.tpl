<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>System Info Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
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
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:updateSingle();"><span class="glyphicon glyphicon-refresh"></span></a></li>
			</ul>
		</nav>
		{for $c = 0 to $widget_count - 1 step 2}
		<div class="row">
			{if !$widgets[$c]->visible}
			<div class="col-md-6" style="display: none;">
			{else}
			<div class="col-md-6">
			{/if}
				{include file="widget.tpl" widget=$widgets[$c]}
			</div>
			{if ($c + 1) < ($widget_count - 1)}
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
