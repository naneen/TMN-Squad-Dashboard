var json_old_def = 0;
function defectChart(SQUAD_ID){
    $.getJSON(
        'php/connectdefect.php',{'SQUAD_ID':SQUAD_ID},function(json) {
            if(json_old_def != JSON.stringify(json)){
                json_old_def = JSON.stringify(json);
                $('#defect').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Defects of TEST Squad'
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
                        text: 'TOTAL DEFECTS ( NNUMBER OF ERROR )'
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
                    shared : true,
                    formatter: function () {
                        return 'DEFECT : ' + this.y;
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
                legend: {
                    enabled:false
                },
                series: [{
                    data: json.DEFECT_NO
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