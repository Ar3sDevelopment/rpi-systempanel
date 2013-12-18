<!DOCTYPE html>
<html lang="en">
<head>
	{include file="html_head.tpl" title="SIP Widgets"}
	<script type="text/javascript">
		$(document).ready(function () {
			$('form[data-type="ajax"]').submit(function(event) {
			    event.preventDefault();
			
				var $this = $(this);
			    var values = $this.serialize();
			
			    $.ajax({
			        url: $this.prop('action'),
			        type: $this.prop('method'),
			        data: values,
			        success: function() {
			        	alert('Done');
			        },
			        error:function() {
			            alert("Error");
			        }
			    });
			});
		});
	</script>
</head>
<body>
	<div class="container">
		{include file="menu.tpl" sid=$sid page="widgets"}
		{foreach $widgets as $widget}
		<form action="index.php" data-type="ajax" method="post" class="form-horizontal">
			<input type="hidden" name="sid" value="{$sid}" />
			<div class="form-group">
				<div class="row">
					<input type="hidden" name="widget-id" value="{$widget->id}" />
					<div class="col-xs-12">
						<div class="well">
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-title" placeholder="Title" value="{$widget->title}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Update Time</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-updatetime" placeholder="Update Time" value="{$widget->updatetime}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Columns</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-columns" placeholder="Columns" value="{$widget->columns}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">PHP File</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-phpfile" placeholder="PHP File" value="{$widget->phpfile}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Template File</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-templatefile" placeholder="Template File" value="{$widget->templatefile}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Folder</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-folder" placeholder="Folder" value="{$widget->folder}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Class Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-class-name" placeholder="Class Name" value="{$widget->class_name}" />
								</div>
							</div>
							<div class="form-group">
								<label for="widget-position" class="col-sm-4 control-label">Version</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="widget-version" placeholder="Version" value="{$widget->version}" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="widget-requireadmin" {if $widget->requireadmin}checked="checked"{/if}> Require Admin
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<input type="hidden" name="save_widget" value="1" />
									<button type="submit" name="save" id="save" class="btn btn-primary">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		{/foreach}
	</div>
</body>
</html>
