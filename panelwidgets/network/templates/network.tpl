<div class="network_grid"></div>
<script type="text/javascript">
	$(document).ready(function () {
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'name' },
                { name: 'encap' },
                { name: 'mac'},
                { name: 'ip' },
                { name: 'rx' },
                { name: 'tx' }
            ],
            id: 'id',
            url: 'widget_loader.php',
            root: 'nics',
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
        $("#{$user_widget_info->id_html} .network_grid").jqxGrid(
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
              { text: 'Name', dataField: 'name', width: 50 },
              { text: 'Full Name', dataField: 'encap' },
              { text: 'MAC', dataField: 'mac', width: 120 },
              { text: 'IP', dataField: 'ip', width: 100 },
              { text: 'RX', dataField: 'rx', width: 70 },
              { text: 'TX', dataField: 'tx', width: 70 }
            ]
        });
        
        setTimeout(function () {
			updateNetworkGrid();
		}, {$widget_info->updatetime});
	});
	
	function updateNetworkGrid() {
		$("#{$user_widget_info->id_html} .network_grid").jqxGrid('updatebounddata', 'cells');
		
		setTimeout(function () {
			updateNetworkGrid();
		}, {$widget_info->updatetime});
	}
</script>
{*{for $i = 0 to count($widget->nics) - 1}
	{$nic = $widget->nics[$i]}
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-6">
					Interface {$nic->name}
				</div>
				<div class="col-xs-6">
					{$nic->encap}
				</div>
			</div>
			{if $nic->mac != null && $nic->mac|count_characters > 0}
				<div class="row">
					<div class="col-xs-6">
						MAC Address
					</div>
					<div class="col-xs-6">
						{$nic->mac}
					</div>
				</div>
			{/if}
			<div class="row">
				<div class="col-xs-6">
					IP Address
				</div>
				<div class="col-xs-6">
					{$nic->ip}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					Received
				</div>
				<div class="col-xs-6">
					{$nic->rx}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					Transmitted
				</div>
				<div class="col-xs-6">
					{$nic->tx}
				</div>
			</div>
			{if ($i < count($widget->nics) - 1)}
				<div class="row">
					<div class="col-xs-12">
						&nbsp;
					</div>
				</div>
			{/if}
		</div>
	</div>
{/for}
<script type="text/javascript">
	function callbackNetworkFunc(data)
	{
		$('#{$widget_info->id} .panel-body').html(data);
	}

	$(document).ready(function () {
		setTimeout(function () {
			updateWidgetHtml({$user_widget_info->id}, '{$sid}', callbackNetworkFunc, null);
		}, {$widget_info->updatetime});
	});
</script>*}
