var json_old_cover = 0;
function CoverageChart(SQUAD_ID){
    $.getJSON(
        'php/QueryCoverage.php',{'SQUAD_ID':SQUAD_ID},function(json) {
            if(json_old_cover != JSON.stringify(json)){
                json_old_cover = JSON.stringify(json);
                $('#coverage').highcharts({
                colors: ['#19B5FE'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Percentage Test Coverage'
                },
                xAxis: {
                    title:{
                        text: 'PROJECT NAME'
                    },
                    categories: json.ProjectName
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    title: {
                        text: 'TEST COVERAGE (%)'
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
                        return this.x + '<br>' + this.y + '%';
                    }
                },
                legend: {
                    enabled:false
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            allowOverlap: true,
                            enabled: true,
                           formatter: function () {
                                return this.y + '%';
                            }
                        }
                    }
                },
                series: [{
                    data: json.PERCENT
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