$json_old2 = 0;
function DeployChart(SQUAD_ID){
    $.getJSON('php/QueryDeploy.php',{'SQUAD_ID':SQUAD_ID},function(json) {
        if($json_old2 != JSON.stringify(json)){
        $json_old2 = JSON.stringify(json);
        var time="";
        var series = [];
        var legendTx=true;
        for (var i = 0; i < json.name.length; i++) {
            var datas=[];
            for (var j = 0; j < json.date.length; j++) {
                time=" ( "+json.start[i][j]+" - "+json.end[i][j]+" ) ";
                datas.push({
                    name: time,
                    y:json.data[i][j],
                });
            };
            series.push({
                name: json.name[i],
                data:datas,
                stack: json.name[i],          
            });
        };
        if(json.name.length==0){
            var series = [];
            var subtext= " No Deployment ";
            legendTx=false;
            series.push({});
        };
        $('#Deploy').highcharts({
            colors: [ "#2574A9","#049372", "#1BA39C", "#2ECC71","#2ABB9B","#4B77BE","#26A65B",
                    "#5C97BF","#2ECC71","#36D7B7", "#87D37C"],
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },
            title: {
                x:15,
                text: 'DEPLOYMENT DURATION',
                margin:50   
            },
            subtitle: {
                x:15,
                text: subtext ,
                y:200     
            }, 
            xAxis: {
                min:null,
                categories: json.date,
                title: {
                    text: 'DATE',
                    margin:10
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Hours'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'normal',
                        fontSize:15,
                        color: 'white',
                        textShadow: '0 0 0px contrast'   
                    },
                    x:3,
                    y:-40,
                    rotation: -90,
                    formatter: function () {
                        var digits=[];
                        var output = "";
                        var num=this.total;
                        digits = (""+num).split(".");
                        if(digits[0]==0&&digits.length>1){
                                output=digits[1]+" MIN";

                        }
                        if(digits[0]!=0&&digits.length>1){
                                output=digits[0]+" HR  "+digits[1]+" MIN";

                        }
                        if(digits[0]!=0&&digits.length==1){
                         output=this.total+" HR"; 
                        }
                        return  output;       
                    } 
                }
            },
            legend: {
                enabled:legendTx,
                x:17,
                y:30,
                verticalAlign: 'top',
                // backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                // borderColor: '#CCC',
                // borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function () {
                     var digits=[];
                        var output = "";
                        var num=this.y;
                        digits = (""+num).split(".");
                        if(digits[0]==0&&digits.length>1){
                                output=digits[1]+" MINUTEs";

                        }
                        if(digits[0]!=0&&digits.length>1){
                                output=digits[0]+" hours  "+digits[1]+" MINUTEs";

                        }
                        if(digits[0]!=0&&digits.length==1){
                         output=this.total+" hours"; 
                        }
                    return '<b>' + this.x + '</b>  '+this.point.name+'<br/>' +
                    this.series.name + ' : ' + output ;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal'                
                }
            },
            exporting: {
                enabled :false
            },
            series: series
        });  
        }
    });
}