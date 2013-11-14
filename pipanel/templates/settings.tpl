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
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="settings.php">Settings</a></li>
				</ul>
			</div>
		</nav>
		<form action="settings.php" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="username" name="username" placeholder="Username" value="{$settings->user}" />
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
				</div>
			</div>
			<div class="form-group">
				<label for="hashmethod" class="col-sm-2 control-label">Hash Method</label>
				<div class="col-sm-10">
					<select class="form-control" id="hashmethod" name="hashmethod">
						<option value="md5" {if $settings->hash_method == "md5"} selected="selected" {/if}>MD5</option>
						<option value="sha1" {if $settings->hash_method == "sha1"} selected="selected" {/if}>SHA 1</option>
						<option value="sha256" {if $settings->hash_method == "sha256"} selected="selected" {/if}>SHA 256</option>
						<option value="sha512" {if $settings->hash_method == "sha512"} selected="selected" {/if}>SHA 512</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="save" id="save" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
