var temp = JSON.stringify({});
function CoverageChart(SQUAD_ID){
    $.getJSON(
        'php/QueryCoverage.php',{ 'SQUAD_ID' :SQUAD_ID },function(json) {
			if(temp!=JSON.stringify(json)){
				temp = JSON.stringify(json);
				$('#coverage').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Percentage Test Coverage'
					},
					subtitle: {
						y:200,
						text: json[3]
					},
					xAxis: {
						categories: json[0],
						crosshair: true
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Test Coverage (%)'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
						footerFormat: '</table>',
						shared: true,
						useHTML: true
					},
	                legend: {
	                    enabled:false
	                },
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						},
						series:{
							color:'#19B5FE'
						}
					},
					 credits: {
               			 enabled: false
            		},
            		exporting: {
               			 enabled :false
            		},	
					series: [{
						name: json[2],
						data: json[1]
					}]
				});
			}
        }
    );
}
// setInterval(getAjax,100);
