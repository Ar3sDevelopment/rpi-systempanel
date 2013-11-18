<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Widgets"}
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="widgets"}
		<form action="settings.php" method="post" class="form-horizontal">
			<input type="hidden" name="sid" value="{$sid}" />
			<div class="form-group">
				{foreach $widgets as $widget}
					<div class="row">
						<input type="hidden" name="widget-id[{$c}]" value="{$widget->id}" />
						<div class="col-xs-12">
							<div class="well">
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-title[{$c}]" placeholder="Title" value="{$widget->title}" />
									</div>
								</div>
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">Update Time</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-updatetime[{$c}]" placeholder="Update Time" value="{$widget->updatetime}" />
									</div>
								</div>
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">Columns</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-columns[{$c}]" placeholder="Columns" value="{$widget->columns}" />
									</div>
								</div>
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">PHP File</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-phpfile[{$c}]" placeholder="PHP File" value="{$widget->phpfile}" />
									</div>
								</div>
								<div class="form-group">
									<label for="widget-position" class="col-sm-4 control-label">Template File</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="widget-templatefile[{$c}]" placeholder="Template File" value="{$widget->templatefile}" />
									</div>
								</div>
							</div>
						</div>
					</div>
				{/foreach}
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
