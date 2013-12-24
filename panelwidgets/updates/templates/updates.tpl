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
			updateUpdatesGrid();
		}, {$widget_info->updatetime});
	});
	
	function updateUpdatesGrid() {
		$("#{$user_widget_info->id_html} .updates_grid").jqxGrid('updatebounddata', 'cells');
		
		setTimeout(function () {
			updateUpdatesGrid();
		}, {$widget_info->updatetime});
	}
</script>