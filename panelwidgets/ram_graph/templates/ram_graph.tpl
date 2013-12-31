<div class="row">
	<div class="col-xs-12">
		<div id="ram_load_pie"></div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'ram_percent', type: 'float' }
            ],
            id: 'id',
            url: 'widget_loader.php',
            root: 'ram_usages',
            data: {
            	widget_id: {$user_widget_info->id},
            	sid: '{$sid}',
            	json: true,
            	featureClass: "P",
                style: "full"
			},
			type: 'POST'
        };
        
        var dataAdapter = new $.jqx.dataAdapter(source);
        var settings = {
            title: "Ram Usage",
            enableAnimations: true,
            showLegend: false,
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: dataAdapter,
            colorScheme: 'scheme02',
            seriesGroups:
            	[
                    {
                        type: 'pie',
                        showLabels: true,
                        series:
                            [
                                { 
                                    dataField: 'ram_percent',
                                    displayText: 'ram_percent',
                                    labelRadius: 100,
                                    initialAngle: 15,
                                    radius: 130,
                                    centerOffset: 0,
                                    formatSettings: { sufix: '%', decimalPlaces: 1 }
                                }
                            ]
                    }
                ]
        };
        
        $('#ram_load_pie').jqxChart(settings);
        
	    setTimeout(timeoutRAMGraphFunc, {$widget_info->updatetime});
	});
	
	function callbackRAMGraphFunc(data)
	{
		$('#cpu_load_gauge').jqxGauge('setValue', data.cpuload);
		setTimeout(timeoutRAMGraphFunc, {$widget_info->updatetime});
	}
	
	function timeoutRAMGraphFunc()
	{
		$.updateWidgetJson({$user_widget_info->id}, '{$sid}', callbackRAMGraphFunc, null);
	}
</script>