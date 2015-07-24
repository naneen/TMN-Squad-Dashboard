<?php include 'php/connectdefect.php';?>

<script>
    function defectChart() {

    // Create the chart
    $('#defect').highcharts({
      chart: {
            type: 'column',
            backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#2a2a2b'],
            [1, '#3e3e40']
         ]
        },
         plotBorderColor: '#606063'
      },
        credits: {
            enabled: false
        },
        title: {
            style: {
                     color: 'white'
                   },
            text: 'Defects of TEST Squad'
        },
        xAxis: {
             title: {
                text: 'SPRINT',
                 margin: 0,
                style:{color: '#D2D7D3'},

            },
            categories: <?php echo $ans1?>,
            type: 'category',
            gridLineColor: '#707073',
            labels: {
                 style: {
                        color: '#E0E0E3'
                    },
                  lineColor: '#707073',
                  minorGridLineColor: '#505053',
                  tickColor: '#707073'
              }

        },
        yAxis: {
                    min: 0,
            title: {
                text: 'Total Defects ( Number of Error )',
                style:{color: '#D2D7D3'}
            },

            gridLineColor: '#707073',
            labels: {
                     style: {
                        color: '#E0E0E3'
                     }
                  }

        },
          lineColor: '#707073',
          minorGridLineColor: '#505053',
          tickColor: '#707073',
          tickWidth: 1,
           labels: {
                  style: {
                     color: '#707073'
                   }
           },
        legend: {
            enabled: false,
            itemStyle: {
                color: '#E0E0E3'
              },
            itemHoverStyle: {
                color: '#FFF'
              },
            itemHiddenStyle: {
                color: '#606063'
              }
           },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            },
            series: {
                dataLabels: {
                     color: '#B0B0B3'
                    },
                marker: {
                     lineColor: '#333'
                    }
               },
                boxplot: {
                     fillColor: '#505053'
               },
                candlestick: {
                     lineColor: 'white'
               },
                errorbar: {
                     color: 'white'
               }
        },

        exporting: {
                    buttons: [
                        {
                            enabled: false,
                            symbol: false
                        }
                    ]
                },

        tooltip: {
             backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
             },
             formatter: function () {
                return this.y + ' defects';
            }
        },

        series: [{
            data: <?php echo $ans2?>
        }],

    });
}

        </script>