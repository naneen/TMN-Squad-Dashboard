var temp = 0;
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
                    xAxis: {
                        categories: json[0],
                        title: {
                            text: 'PROJECT NAME'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'TEST COVERAGE (%)'
                        }
                    },
                    tooltip: {
                        shared: true,
                        formatter: function () {
                            return this.x + '<br>' + this.y + '%';
                        }
                    },
                    legend: {
                        enabled:false
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                            dataLabels: {
                                allowOverlap: true,
                                enabled: true,
                                formatter: function () {
                                    return this.y + '%';
                                }
                            }
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
