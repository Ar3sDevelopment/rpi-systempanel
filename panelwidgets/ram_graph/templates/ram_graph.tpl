<div class="row">
	<div class="col-xs-12">
		<div id="ram_load_pie" style="width: 100%; height: 350px;"></div>
	</div>
</div>
<script type="text/javascript">
	
	var source = [];
    $(document).ready(function () {
        var settings = {
            title: "Ram Usage",
            description: "",
            enableAnimations: true,
            showLegend: false,
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: source,
            colorScheme: 'scheme02',
            seriesGroups: [
                {
                    type: 'pie',
                    showLabels: true,
                    series: [
                        { 
                            dataField: 'ram_percent',
                            displayText: 'ram_description',
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
        
        setTimeout(function () {
			updateRamPie();
		}, 1000);
	});
	
	function updateRamPie() {
		var data = {
        	sid: 'uhcnvs3v2778obv701rv260376',
        	json: true,
        	widget_id: 30
		};
		
		$.ajax({
			url: 'widget_loader.php',
	        type: 'POST',
	        data: data,
	        success: function (data) {
	        	if (source.length <= 0) {
	        		source.push(data.ram_usages[0]);
	        		source.push(data.ram_usages[1]);
	        	} else {
	        		if (source[0].ram_percent != data.ram_usages[0].ram_percent) {
		        		source[0].ram_percent = data.ram_usages[0].ram_percent;
		        		source[1].ram_percent = data.ram_usages[1].ram_percent;
	        		}
	        	}
	        	
	        	$("#ram_load_pie").jqxChart('update');
	        },
	        complete: function () {
	        	setTimeout(function () {
					updateRamPie();
				}, 1000);
	        }
		});
	}
</script>