<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Login"}
</head>
<body>
	<div class="container">
		<form method="post" action="login.php">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
			<button type="submit" name="login" class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
</html>
