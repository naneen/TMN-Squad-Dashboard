<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/qualityreport.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/theme/united/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/gridster/jquery.gridster.css">
	<script type="text/javascript" src="../assets/js/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-blockUI/jquery.blockUI.js"></script>
	<script type="text/javascript" src="../assets/js/gridster/jquery.gridster.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/highcharts.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/highcharts-more.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/modules/solid-gauge.src.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/themes/dark-dosis.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/modules/exporting.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap/bootstrap.js"></script>
	<style type="text/css">
            
        .chathead-multiple1{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple2{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 150px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple3{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 300px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple4{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 450px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple5{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 600px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple6{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 750px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple7{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 900px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }
          .chathead-multiple8{
            width: 150px;
            height: 150px;
            border-radius: 75px;
            left: 1050px;
            border: 4px solid #FF0000;
            box-shadow: 1px 1px 5px rgba(0,0,0,.5);
            overflow: hidden;
            position: absolute;
            z-index: 10;
          }

          .chathead-multiple img:nth-child(-n+3) {
             width: 75px;
             height: 75px;
             display: inline-block;
             position: relative;
          }

          .chathead-multiple1 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple2 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple3 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple4 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple5 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple6 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple7 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }
          .chathead-multiple8 img:first-child {
             width: 150px;
             height: 150px;
             border-right: 1px solid #FFFFFF;
          }


          .chathead-multiple img:nth-child(2) {
             left: 75px;
             top:0;
             border-bottom: 1px solid #FFFFFF;
             border-left: 1px solid #FFFFFF;
             border-radius: 0 75px 0  0;
          }

          .chathead-multiple img:nth-child(3) {
             left: 75px;
             bottom:0;
             border-top: 1px solid #FFFFFF;
             border-left: 1px solid #FFFFFF;
             border-radius: 0 0 75px 0;
          }
                select{
                    background-color: #FDB095;
                }
                .adjust-border-radius {
                -webkit-border-radius: 0px;
                -moz-border-radius: 0px;
                border-radius: 0px;
                }
		.panel-inline {
			display: inline-block;
			width: 33%;
			height: 80%;
		}
                .panel{
                    border-color: black;
                    margin-bottom: 0;
                }
                .col-md-4{
                    margin: 0;
                    padding-left: 0;
                    padding-right: 0;
                }
                .col-md-12{
                    margin: 0;
                    padding-left: 0;
                    padding-right: 0;
                }
                .row{
                    margin: 0;
                }
                .red>a{
                    color:red !important;
                }
                .green>a{
                    color:green !important;
                }
                .yellow>a{
                    color:#FFCC00  !important;
                }
                .overflow{
                    overflow: auto;
                }
                .heightulbuild{
                    /* Firefox */
                    height: -moz-calc(100% - 62px);
                    /* WebKit */
                    height: -webkit-calc(100% - 62px);
                    /* Opera */
                    height: -o-calc(100% - 62px);
                    /* Standard */
                    height: calc(100% - 62px);
                }
                .panel-heading {
                    font-size:28;
                    height: 60px;
                }
                .panel-body {
                    font-size:28;
                    width: 100%;
                }
                .nav-pills>li.red.active>a, .nav-pills>li.red.active>a:hover, .nav-pills>li.red.active>a:focus {
                    background-color: #FDB095;
                }
                .nav-pills>li.green.active>a, .nav-pills>li.green.active>a:hover, .nav-pills>li.green.active>a:focus {
                    background-color: #91F1A1;
                }
	</style>
        <script type="text/javascript">
            var prefix = "";
            $(function(){
                var d = new Date();
                var year = d.getFullYear();
                console.log(year);
                refreshGraphChart();
                $.ajax({
                            type: "get",
                            url: prefix + "../core/service/GetCurrentweek.php",
                            dataType: "jsonp",
                            success: function(obj, textStatus, jqXHR) {
                                getWeekBuild(year,obj);
                                $('#btnlastbuild').click(function(e){
                                    $('#divdeploy').empty();
                                    $('#divtest').empty();
                                    getWeekBuild(year,obj);
                                })
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                    console.log(xhr.status);
                                    console.log(thrownError);
                            }
                });
                 $('#drop1').change(
                    function(){
                         var build = $('#ulbuild > .active').attr('id');
                         gettestbybuild(build);
                });
                $('#drop2').change(
                    function(){
                        var build =$('#ulbuild > .active').attr('id');
                         getdeploybybuild(build);
                });
            });
            function getcurrentbuild(){
                var obj2;
                $.ajax({
                            type: "get",
                            async: false,
                            url: prefix + "../core/service/GetMaxBuildService.php",
                            dataType: "jsonp",
                            success: function(obj, textStatus, jqXHR) {
                                obj2 = obj.build;
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                    console.log(xhr.status);
                                    console.log(thrownError);
                            }
                    });
                    return obj2;
            }
            function refreshGraphChart() {
				$('.build-graph').block();
				$.ajax({
					type: "get",
					url: prefix + "../core/service/GetQualityWeekReportService.php",
					dataType: "jsonp",
					success: function(obj, textStatus, jqXHR) {
						$('.build-graph').unblock();
						drawGraphChart('build-graph', obj);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.build-graph').unblock();
					}
				});
		}
                function getWeekBuild(year,week) {
                                $.ajax({
                                        type: "get",
                                        url: prefix + "../core/service/GetbuildbyweekService.php",
                                        dataType: "jsonp",
                                        data: {year:year,week:week},
                                        success: function(obj, textStatus, jqXHR) {
                                                appenBuildResult(obj);
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                                console.log(xhr.status);
                                                console.log(thrownError);
                                        }
                                });
                }
                function getdeploybybuild(build){
                    var order = $("#drop2").val();
                                $.ajax({
                                        type: "get",
                                        url: prefix + "../core/service/Getdeploybybuild.php",
                                        dataType: "jsonp",
                                        data: {build:build,order:order},
                                        success: function(obj, textStatus, jqXHR) {
                                                appendDeployResult(obj,build);
                                                $('#hdeploy').empty();
                                                $('#hdeploy').append("Deploy - "+build);
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                                console.log(xhr.status);
                                                console.log(thrownError);
                                        }
                                });
                }
                function gettestbybuild(build){
                    var order = $("#drop1").val();
                                $.ajax({
                                        type: "get",
                                        url: prefix + "../core/service/Gettestbybuild.php",
                                        dataType: "jsonp",
                                        data: {build:build,order:order},
                                        success: function(obj, textStatus, jqXHR) {
                                                appendTestResult(obj);
                                                $('#htest').empty();
                                                $('#htest').append("Test - "+build);
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                                console.log(xhr.status);
                                                console.log(thrownError);
                                        }
                                });
                }
                function appendDeployResult(jsonp,build){
                    $('#divdeploy').empty();
                    for(var i=0;i<jsonp.length;i++){
                        var test =  jsonp[i][0];
                        if(jsonp[i][1]==0){
                            var test2 = 'class=\"green\"';
                        }else{
                            var test2 = "class=\"red\"";
                        }
                        $('#divdeploy').append('<li '+test2+' id=\''+test+'\'>\n\
                        <a href=\"../core/service/DownloadWarService.php?name='+test+'&build='+build+'\">'+test+'</a>\n\
                        </li>');
                    }
                }
                function testFail(idgrouplead){
                    $('#imgblock').empty();
                    if(idgrouplead.lenght==0){
                    }else {
                        $.each(idgrouplead,function(index,value){
                            $.ajax({
                                            type: "get",
                                            url: prefix + "../core/service/GetGroupleadFilepath.php",
                                            dataType: "jsonp",
                                            data: {idgrouplead:value},
                                            success: function(obj, textStatus, jqXHR) {
                                                    $('#imgblock').append("<div class=\"chathead-multiple"+(index+1)+"\"> <img src=\"../assets/img/lead/"+obj+"\"></div>");
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                    console.log(xhr.status);
                                                    console.log(thrownError);
                                            }
                            });
                    });
                    }
                }
                function appendTestResult(jsonp){
                    console.log(jsonp);
                    var idgrouplead = new Array();
                    if(jsonp.length==0){
                        idgrouplead = [1,2,3,4,5,6,7];
                    }
                    $('#divtest').empty();
                    for(var i=0;i<jsonp.length;i++){
                        var test =  jsonp[i][0];
                        var testpass = jsonp[i][2];
                        var testfail = jsonp[i][3];
                        var testtotal = jsonp[i][2]+jsonp[i][3];
                        var testurl = 'filterfailurefrome2e.php?directory='+jsonp[i][4];
                        var idlead = jsonp[i][5];
                        var checkahref = '<a href="#" >';
                        var samevalue = 0;
                        if(jsonp[i][1]=="1"){
                            $.each(idgrouplead,function(index2,value2){
                                if(idlead==value2){
                                    samevalue = 1;
                                }
                            });
                            if(samevalue==0){
                            idgrouplead.push(idlead);
                            }
                            var test2 = "class=\"red\"";
                            checkahref = '<a href=/qualityreport/views/'+testurl+' target="new">';
                            
                        }else if(jsonp[i][1]=="0"){
                            var test2 = "class=\"green\"";
                        }else{
                            var test2 = "class=\"yellow\"";
                            checkahref = '<a href=/qualityreport/views/'+testurl+' target="new">';
                        }
                        $('#divtest').append('<li '+test2+' id=\''+test+'\'>\n\
                        '+checkahref+
                        '<div align="left" style="display: inline-block;width:77%">'+test+'</div ><div align="left" style="display: inline-block;width:23%">'+testpass+'/'+testfail+'</div></a>\n\
                        </li>');
                    }
                    testFail(idgrouplead);
                }
		function appenBuildResult(jsonp){
                    $('#ulbuild').empty();
                    for (var i=0;i<jsonp.length;i++) {
                        var test  = jsonp[i][0];
                        if(jsonp[i][1]=='0'&&jsonp[i][2]=='0'&&jsonp[i][1]!=null&&jsonp[i][2]!=null){
                            var test2 = 'class=\"green \"';
                        }else{
                            var test2 = "class=\"red \"";
                        }
                        $('#ulbuild').append('<li '+test2+' id=\''+test+'\'>\n\
                        <a href=\"#\">Build '+test+'</a>\n\
                        </li>');
                        if (i == 0) {
                            $('#'+test).addClass("active");
                            //var obj2 = getcurrentbuild();
                            getdeploybybuild(test);
                            gettestbybuild(test);
                        }
                        $('#'+test).click(function(e){
                            $("#ulbuild > li").removeClass("active");
                            $(this).addClass("active");
                            getdeploybybuild($(this).attr('id'));
                            gettestbybuild($(this).attr('id'));
                        })
                    }
                }
		function drawGraphChart(container, jsonp) {
                    console.log(jsonp)
			$('#build-graph').highcharts({
                            chart: {
                                renderTo: 'container',
                                type: 'column'
                            },
                            title: {
                                text: 'Alpha Statistics'
                            },
                            xAxis: {
                                categories:jsonp.categories,
                                labels: {
                                    formatter: function() {
                                        return this.value;
                                    }
                                }
                            },
                            
                            yAxis: {
                                min:0,
                                title: {
                                    text: ''
                                },
                                stackLabels: {
                                    enabled: false,
                                }
                            },
                            tooltip: {
                                shared: true,
                                enabled: true,
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    dataLabels: {
                                        enabled: true,
                                        style: {
                                            textShadow: '0 0 3px black, 0 0 3px black'
                                        }
                                    },
                                    cursor: 'pointer',
                                        point: {
                                            events: {
                                                click: function() {
                                                       $year = this.category.split("-w");
                                                       getWeekBuild($year[0],$year[1]);
                                                    }
                                            }
                                        },
                                },
                                series:{
                                  cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function() {
                                                 $year = this.category.split("-w");
                                                 getWeekBuild($year[0],$year[1]);
                                            }
                                        }
                                    }
                                },
                                spline: {
                                    marker: {
                                        radius: 4,
                                        lineColor: '#666666',
                                        lineWidth: 1
                                    }
                                },
                                line: {
                                        cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function() {
                                                    $year = this.category.split("-w");
                                                    getWeekBuild($year[0],$year[1]);
                                                }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },

                            series: jsonp.series,
                                        });
                            $('.highcharts-axis-labels text, .highcharts-axis-labels span').click(function () {
                            var str = this.textContent;
                            console.log(str);
                            $year = explode("-w",str);
                            getWeekBuild($year[0],$year[1]);
    });
                }
        </script>
</head>
<body>
    
<?php if (isset($_GET["msg"])) { ?>
<div class="alert alert-warning alert-dismissible" role="alert" style="margin-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Warning!</strong> <?php echo$_GET["msg"]; ?>
</div>
<?php } ?>

<div style="width:100%;height:100%;margin: 0 auto;">
    <div class="row" style="height:50%">
      <div class="col-md-12 container" id="container1" style="height:100%;display: table">
                    
          <div id="imgblock" style="display:block">
              
              </div> 
            <div class="build-graph" id="build-graph"style="height:100%">
               <!--graph here--> 
            </div>
      </div>
    </div>
    <div class="row" style="height:50%">
      <div class="col-md-4 adjust-border-radius" style="height:100%">
          <div class="panel panel-primary panel-inline adjust-border-radius" style="width:100%;height:100%">
                <div class="panel-heading adjust-border-radius">
                    Build
                    <div style="float:right">
                        <button id="btnlastbuild" type="button" class="btn" style="color: black">LastBuild</button>
                    </div>
                </div>
                <div align="center" class="panel-body heightulbuild overflow adjust-border-radius">
                    <ul class="nav nav-pills nav-stacked" id="ulbuild">
                    </ul>
                </div>

            </div>
      </div>
      <div class="col-md-4 adjust-border-radius " style="height:100%">
          <div  class="panel panel-primary panel-inline adjust-border-radius"style="width:100%;height:100%">
                            <div class="panel-heading adjust-border-radius">
                                <div style="float:left" id="htest">
                                </div>
                                    <div style="float:right">
                                        <select style="font-size:20px" id="drop1" >
                                            <option value="status" selected>Orderbystatus</option>
                                            <option value="name" >Orderbyname</option>
                                        </select>
                                    </div>
                                </div>
                                <div align="center" class="panel-body heightulbuild overflow">
                                    <ul class="nav nav-pills nav-stacked" id="divtest">
                                    </ul>
                                </div>
                    </div>
      </div>
      <div class="col-md-4 adjust-border-radius" style="height:100%">
          <div  class="panel panel-primary panel-inline adjust-border-radius"style="width:100%;height:100%">
                            <div class="panel-heading adjust-border-radius">
                                <div style="float:left" id="hdeploy">
                                </div>
                                    <div style="float:right">
                                        <select style="font-size:20px" id="drop2">
                                            <option value="status" selected>Orderbystatus</option>
                                            <option value="name" >Orderbyname</option>
                                        </select>
                                    </div>
                                </div>
                                <div align="left" class="panel-body heightulbuild overflow adjust-border-radius">
                                    <ul class="nav nav-pills nav-stacked" id="divdeploy">
                                    </ul>
                                </div>
                    </div>
      </div>
    </div>
    
</div>
</body>
</html>