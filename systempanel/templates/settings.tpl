<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Settings"}
	<script type="text/javascript">
		$(document).ready(function () {
			$('[name="visibility"]').click(function () {
				$this = $(this);
				var postData = { sid: '{$sid}', 'visibility': $this.data('val'), 'widget-id': $this.data('widget-id') };
				$.post('settings.php', postData, function (data) {
					console.log(data);
					$this.data('val', data.visible ? 0 : 1);
					if (data.visible) {
						$this.text('Hide');
					} else {
						$this.text('Show');
					}
				});
			});
			
			$('[name="enable"]').click(function () {
				$this = $(this);
				var postData = { sid: '{$sid}', 'enable': $this.data('val'), 'widget-id': $this.data('widget-id') };
				$.post('settings.php', postData, function (data) {
					console.log(data);
					$this.data('val', data.enabled ? 0 : 1);
					if (data.enabled) {
						$this.text('Disable');
					} else {
						$this.text('Enable');
					}
				});
			});
		});
	</script>
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="settings"}
		<form action="settings.php" method="post" class="form-horizontal">
			<input type="hidden" name="sid" value="{$sid}" />
			<div class="row">
				<div class="well">
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
				</div>
			</div>
			<div class="form-group">
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
								<div class="col-sm-offset-4 col-sm-8 text-right">
									<button type="button" name="visibility" data-widget-id="{$widget->id}" data-val="{if $widget->visible}0{else}1{/if}" class="btn btn-default">
										{if $widget->visible}
											Hide
										{else}
											Show
										{/if}
									</button>
									<button type="button" name="enable" data-widget-id="{$widget->id}" data-val="{if $widget->enabled}0{else}1{/if}" class="btn btn-default">
										{if $widget->enabled}
											Disable
										{else}
											Enable
										{/if}
									</button>
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
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="save" id="save" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
