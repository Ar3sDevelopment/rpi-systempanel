<div class="disks_grid"></div>
<script type="text/javascript">
	$(document).ready(function () {
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'mount' },
                { name: 'typex' },
                { name: 'size'},
                { name: 'avail' },
                { name: 'used' },
                { name: 'percent_avail', type: 'float' },
                { name: 'percent_used', type: 'float' }
            ],
            id: 'id',
            url: 'widget_loader.php',
            root: 'disks',
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
        
        var percentagerenderer = function (row, column, value) {
        	var progress_type = 'danger';
        	
        	if (column == 'percent_used') {
        		progress_type = 'danger';
        	} else if (column == 'percent_avail') {
        		progress_type = 'success';
        	}
        	
            var html = '<div class="row" style="margin-top: 4px; margin-right: 3px;"><div class="col-xs-4">' + value + '%</div><div class="col-xs-8"><div class="progress" style="margin-top: -2px;">\n';
            html += '<div style="width: ' + value + '%;" aria-valuenow="' + value + '" class="progress-bar progress-bar-' + progress_type + '" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n';
            html += '</div></div>';
            return html;
        };
        
        var sizerenderer = function (row, column, value) {
        	return '<div style="overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; text-align: left; margin-right: 2px; margin-left: 4px; margin-top: 4px;">' + value + 'B</div>';
        };
        
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#{$user_widget_info->id_html} .disks_grid").jqxGrid(
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
              { text: 'Mount', dataField: 'mount' },
              { text: 'Type', dataField: 'typex', width: 35 },
              { text: 'Size', dataField: 'size', cellsrenderer: sizerenderer, width: 45 },
              { text: 'Available', dataField: 'avail', cellsrenderer: sizerenderer, width: 60 },
              { text: 'Available %', dataField: 'percent_avail', cellsalign: 'right', cellsformat: 'f2', cellsrenderer: percentagerenderer, width: 120 },
              { text: 'Used', dataField: 'used', cellsrenderer: sizerenderer, width: 50 },
              { text: 'Used %', dataField: 'percent_used', cellsalign: 'right', cellsformat: 'f2', cellsrenderer: percentagerenderer, width: 120 }
            ]
        });
        
        setTimeout(function () {
			updateGrid();
		}, {$widget_info->updatetime});
	});
	
	function updateGrid() {
		$("#{$user_widget_info->id_html} .process_grid").jqxGrid('updatebounddata', 'cells');
		
		setTimeout(function () {
			updateGrid();
		}, {$widget_info->updatetime});
	}
</script>