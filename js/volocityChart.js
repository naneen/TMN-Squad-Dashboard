var json_old = 0;
function volocityChart(){
    $.getJSON(
        'php/QueryVolocity.php', function(json) {
            if(json_old != JSON.stringify(json)){
                json_old = JSON.stringify(json);
                $('#volocity').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Sprint Dashboard<br>Volocity commit / complete'
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
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    formatter: function () {
                        return 'spring : '+ this.x + '<br>' + this.series.name + ' : ' + this.y;
                    }
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '200%'
                            }
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