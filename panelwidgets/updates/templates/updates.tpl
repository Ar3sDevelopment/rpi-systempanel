<div class="updates_grid"></div>
<script type="text/javascript">
	$(document).ready(function () {
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'name' },
                { name: 'old_version' },
                { name: 'new_version' }
            ],
            id: 'id',
            url: 'widget_loader.php',
            root: 'updates',
            data: {
            	widget_id: {$user_widget_info->id},
            	sid: '{$sid}',
            	json: true,
            	featureClass: "P",
                style: "full",
                maxRows: 10
			},
			type: 'POST'
        };
        
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#{$user_widget_info->id_html} .updates_grid").jqxGrid(
        {
        	showdefaultloadelement: false,
        	autoshowloadelement: false,
            width: '100%',
            source: dataAdapter,
            theme: 'bootstrap',
            columnsresize: true,
            pageable: true,
            autoheight: true,
            columns: [
              { text: 'Package', dataField: 'name' },
              { text: 'Old Version', dataField: 'old_version' },
              { text: 'New Version', dataField: 'new_version' }
            ]
        });
        
        setTimeout(function () {
			updateGrid();
		}, {$widget_info->updatetime});
	});
	
	function updateGrid() {
		$("#{$user_widget_info->id_html} .updates_grid").jqxGrid('updatebounddata', 'cells');
		
		setTimeout(function () {
			updateGrid();
		}, {$widget_info->updatetime});
	}
</script>
{*{if count($widget->updates) > 0}
<div class="row">
	<div class="col-xs-12">
		<ul class="list-group">
			{for $i = 0 to count($widget->updates) - 1}
				{$update = $widget->updates[$i]}
				<li class="list-group-item">{$update}</li>
			{/for}
		</ul>
	</div>
</div>
{/if}
<script type="text/javascript">
	function callbackUpdatesFunc(data)
	{
		$('#{$user_widget_info->id_html} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml({$user_widget_info->id}, '{$sid}', callbackUpdatesFunc, null);
		}, {$widget_info->updatetime});
	});
</script>*}