<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Settings"}
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="settings"}
		<form action="settings.php" method="post" class="form-horizontal">
			<input type="hidden" name="sid" value="{$sid}" />
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{$user->username}" />
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
						{foreach $hashes as $hash}
							<option value="{$hash->name}"{if $hash->selected} selected="selected" {/if}>{$hash->description}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Widgets</label>
				<div class="col-sm-10">
					{$c = 0}
					{$columns = 0}
					<div class="row">
					{while $c < count($settings->widgets)}
						{$widget=$settings->widgets[$c]}
						<div class="col-md-{$widget->columns}">
							<div class="well">
								<div class="form-group">
									<label for="widget-id" class="col-sm-4 control-label">ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-id[{$c}]" placeholder="ID" value="{$widget->id}" />
									</div>
								</div>
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">Position</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-position[{$c}]" placeholder="Position" value="{$widget->position}" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="widget-visible[{$c}]" {if $widget->visible}checked="checked"{/if}> Visible
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="widget-enabled[{$c}]" {if $widget->enabled}checked="checked"{/if}> Enabled
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						{$columns = $columns + {$widget->columns}}
						{if $columns == 12}
							{$columns = 0}
							</div>
							<div class="row">
						{/if}
						{$c = $c + 1}
					{/while}
					</div>
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
