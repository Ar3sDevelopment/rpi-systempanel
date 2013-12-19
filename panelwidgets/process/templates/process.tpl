<div class="process_grid"></div>
<script type="text/javascript">
	$(document).ready(function () {
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'pid', type: 'int' },
                { name: 'command' },
                { name: 'user'},
                { name: 'cpu_percent', type: 'float' },
                { name: 'mem_percent', type: 'float' }
            ],
            id: 'id',
            url: 'widget_loader.php',
            root: 'procs',
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
            var html = '<div class="row" style="margin-top: 4px; margin-right: 3px;"><div class="col-xs-4">' + value + '%</div><div class="col-xs-8"><div class="progress" style="margin-top: -2px;">\n';
            html += '<div style="width: ' + value + '%;" aria-valuenow="' + value + '" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n';
            html += '</div></div>';
            return html;
        };
        
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#{$user_widget_info->id_html} .process_grid").jqxGrid(
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
              { text: 'PID', dataField: 'pid', cellsalign: 'right', width: 50 },
              { text: 'Command', dataField: 'command' },
              { text: 'User', dataField: 'user' },
              { text: 'CPU Percent', dataField: 'cpu_percent', cellsalign: 'right', cellsformat: 'f2', cellsrenderer: percentagerenderer },
              { text: 'RAM Percent', dataField: 'mem_percent', cellsalign: 'right', cellsformat: 'f2', cellsrenderer: percentagerenderer }
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