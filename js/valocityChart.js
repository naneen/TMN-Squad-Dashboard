var json_old_valo = 0;
function valocityChart(SQUAD_ID){
    $.getJSON(
        'php/QueryValocity.php',{'SQUAD_ID':SQUAD_ID},function(json) {
            if(json_old_valo != JSON.stringify(json)){
                json_old_valo = JSON.stringify(json);
                $('#valocity').highcharts({
                colors: ['#FC751B', '#1abc9c'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Sprint Dashboard<br>Velocity commit / complete'
                },
                xAxis: {
                    title:{
                      text:'SPRINT'
                    },
                    categories: json.SPRINT_NO
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'POINT'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                legend: {
                    enabled:true,
                    align: 'right',
                    x: 0,
                    verticalAlign: 'top',
                    y: 45,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    formatter: function () {
                        return 'sprint : '+ this.x + '<br>' + this.series.name + ' : ' + this.y;
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            allowOverlap: true,
                            enabled: true
                        }
                    }
                },
                series: [{
                    name: 'COMMIT',
                    data: json.POINT_COMMIT
                },{
                    name: 'COMPLETE',
                    data: json.POINT_COMPLETE
                }],
                 credits: {
                    enabled: false
                },
                exporting: {
                    buttons: [
                        {
                            enabled: false,
                            symbol: false
                        }
                    ]
                }});
          }
          }
          );
}