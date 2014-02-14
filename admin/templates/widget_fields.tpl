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