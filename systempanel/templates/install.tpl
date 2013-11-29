<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Login"}
</head>
<body>
	<div class="container">
		<form method="post" action="install.php">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3>Database</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="db_host">Host</label>
							<input type="text" class="form-control" id="db_host" name="db_host" placeholder="Host">
						</div>
						<div class="form-group">
							<label for="db_username">Username</label>
							<input type="text" class="form-control" id="db_username" name="db_username" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="db_password">Password</label>
							<input type="password" class="form-control" id="db_password" name="db_password" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="db_name">Name</label>
							<input type="text" class="form-control" id="db_name" name="db_name" placeholder="Password">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3>Admin</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="admin_username">Username</label>
							<input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="admin_password">Password</label>
							<input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Password">
						</div>
						<button type="submit" name="login" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</body>
</html>
