<?php
require(dirname(dirname(__FILE__)).'/core/util/autoload.php');
use core\util\PropertiesConfig as PropertiesConfig;

$thw = PropertiesConfig::get("chart.limitgauge");
if (is_null($thw) || $thw == '') {
        $thw = 7;
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/gridster/jquery.gridster.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/sexydashboard.css">
	<script type="text/javascript" src="../assets/js/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-blockUI/jquery.blockUI.js"></script>
	<script type="text/javascript" src="../assets/js/gridster/jquery.gridster.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/highcharts.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/highcharts-more.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/modules/solid-gauge.src.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/themes/dark-dosis.js"></script>
	<script type="text/javascript" src="../assets/js/highcharts/modules/exporting.js"></script>
	<script type="text/javascript">
		var limitlastbuild = <?php echo $thw; ?>;
		var gridster;
		var testchart;
		var lastbuild = limitlastbuild;
		var interval = 30000; /* 30 Seconds */
		//var prefix = "http://truemoneydev.dyndns.org/sexydashboard/";
		//var prefix = "http://10.221.8.101/sexydashboard/";
		var prefix = "sexydashboard-";
		var build;
		function refreshBuild(async) {
			$(function(){
				if (async == null) async = true;
				$('.build').block();
				$.ajax({
					type: "get",
                                        url: "../core/service/GetMaxBuildService.php",
					//data: {name:"test",age:"31"},
					dataType: "jsonp",
					async: async,
					success: function(obj, textStatus, jqXHR) {
						build = obj.build
						$(".build-content1").text(obj.build);
						$(".build").removeClass('success');
						$(".build").removeClass('fail');
						$(".build").removeClass('warning');
						$(".build").addClass(obj.color);
						$(".build-content2").empty();
						for (var i = 0; i < obj.details.length; i++) {
							$(".build-content2").append(obj.details[i] + "<br/>");
						};
						$('.build').unblock();
						refreshTimeout(refreshBuild);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.build').unblock();
						refreshTimeout(refreshBuild);
					}
				});
			});
		}
		function refreshDeploy() {
			$(function(){
				$('.deploy').block();
				$.ajax({
					type: "get",
					url: prefix + "ajax/deploy.php",
					dataType: "jsonp",
					success: function(obj, textStatus, jqXHR) {
						var tbody;
						for (var i = 0; i < obj.length; i++) {
							var trclass = "defaultText";
							var tdtext = "";
							if (obj[i].status == "0") {
								trclass = "passText";
								tdtext = "Pass";
							} else if (obj[i].status == "1") {
								trclass = "failText";
								tdtext = "Fail";
							} else if (obj[i].status == "3") {
								trclass = "defaultText";
								tdtext = "<img src='../assets/img/loading.gif' width='28px' height='28px'/>";
							} else {
								trclass = "failText";
								tdtext = obj[i].status;
							}
							tbody += "<tr class='" + trclass + "'>";
							tbody += "<td class='left'>" + obj[i].name + "</td>";
							tbody += "<td class='center'>" + tdtext + "</td>";
							tbody += "</tr>";
						};
						$(".deploy-table tbody").empty();
						$(".deploy-table tbody").html(tbody);
						$('.deploy').unblock();
						refreshTimeout(refreshDeploy);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.deploy').unblock();
						refreshTimeout(refreshDeploy);
					}
				});
			});
		}
		
		function refreshTest() {
			$(function(){$('.test').block();
				$.ajax({
					type: "get",
					url: prefix + "ajax/test.php",
					dataType: "jsonp",
					success: function(obj, textStatus, jqXHR) {
						var tbody;
						for (var i = 0; i < obj.length; i++) {
							var trclass = "defaultText";
							var tdtext = "";
							if (obj[i].status == "0") {
								trclass = "passText";
								tdtext = obj[i].result;
							} else if (obj[i].status == "1") {
								trclass = "failText";
								tdtext = obj[i].result;
							} else if (obj[i].status == "2") {
								trclass = "warningText";
								tdtext = obj[i].result;
							} else if (obj[i].status == "3") {
								trclass = "defaultText";
								tdtext = "<img src='img/loading.gif' width='24px' height='24px'/>";
							}
							tbody += "<tr class='" + trclass + "'>";
							tbody += "<td class='left'>" + obj[i].name + "</td>";
							tbody += "<td class='center'>" + tdtext + "</td>";
							tbody += "</tr>";
						};
						$(".test-table tbody").empty();
						$(".test-table tbody").html(tbody);
						$('.test').unblock();
						refreshTimeout(refreshTest);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.test').unblock();
						refreshTimeout(refreshTest);
					}
				});
			});
		}
		
		function refreshTestChart() {
			$(function(){
				$('.test-chart').block();
				$.ajax({
					type: "get",
					url: prefix + "ajax/querytestcal.php",
					dataType: "jsonp",
					data: {build:build},
					success: function(obj, textStatus, jqXHR) {
						$('.test-chart').unblock();
						drawTestChart('test-chart', obj);
						refreshTimeout(refreshTestChart);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.test-chart').unblock();
					}
				});
			});
		}
		
		function refreshTimeout(refreshFn, param1, param2, param3) {
			setTimeout(
				function(){
					refreshFn(param1, param2, param3);
				}
				, interval
			);
		}
		
		function drawTestChart(container, jsonp) {
			testchart = new Highcharts.Chart({
				chart: {
					renderTo: container,
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'E2E - Total Test',
					style: { "fontSize": "32px" },
					y: +30
				},
				tooltip: {
					pointFormat: '{series.name} : <b>{point.y}</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
							format: '<b>{point.name}</b>: {point.y}',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							},
							distance: 10
						},
						showInLegend: true
					}
				},
				series: [{
					type: "pie",
					name: 'Total Test',
					animation: false,
					data: jsonp
				}]
			});
		}
		
		function refreshGaugeChart() {
			$(function(){
				$('.build-gauge').block();
				$.ajax({
					type: "get",
					url: prefix + "ajax/build10last.php",
					dataType: "jsonp",
					data: {lastbuild:lastbuild},
					success: function(obj, textStatus, jqXHR) {
						$('.build-gauge').unblock();
						drawGaugeChart('build-gauge', obj);
						refreshTimeout(refreshGaugeChart);
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.status);
						console.log(thrownError);
						$('.build-gauge').unblock();
					}
				});
			});
		}
		
		function drawGaugeChart(container, jsonp) {
			$('#build-gauge').highcharts({
				chart: {
					type: 'solidgauge',
					backgroundColor: '#888888'
				},
				title: {
					text : 'Last '+lastbuild + ' Build Results.',
					style: { "fontSize": "40px","color":'black'},
					y: +30
				},
				pane: {
					center: ['50%', '85%'],
					size: '140%',
					startAngle: -90,
					endAngle: 90,
					background: {
						backgroundColor:  '#EEE',
						innerRadius: '60%',
						outerRadius: '100%',
						shape: 'arc'
					}
				},
				tooltip: {
					enabled: false
				},
				yAxis: {
					min: 0,
					max: lastbuild,
					stops: [
						[0.1, '#DF5353'], // green
						[0.5, '#DDDF0D'], // yellow
						[0.9, '#55BF3B'] // red
					],
					lineWidth: 0,
					minorTickInterval: 1,
					tickPixelInterval: 400,
					tickWidth: 0,
					labels: ''
				},
				plotOptions: {
					solidgauge: {
						dataLabels: {
							y: 5,
							borderWidth: 0,
							useHTML: true,
						}
					}
				},
				series: [{
					name: 'build',
					data: [jsonp],
					dataLabels: {
					formatter: function(){
						return '<div style="text-align:center"><span style="font-size:45px;color:' + 
						('red') + '">' + (lastbuild-this.y) + ' Fail</span><br/>' +
						'<span style="font-size:20px;color:#ADFF2F">  '+this.y+' Pass </span></div>';
					}
					},
					tooltip: {
						valueSuffix: ' revolutions/min'
					}
				}]
			});
		}
		
		$(function(){
			/*console.log($(window).width());
			console.log($(document).width());
			console.log(window.screen.availWidth);
			console.log((window.screen.availWidth - 100) / 8);
			console.log((window.screen.availWidth - 100) / 8);*/
			var margin = 10;
			var cols = 8;
			var rows = 4;
			var w = ($(window).width() - (cols * margin * 2)) / cols;
			var h = ($(window).height() - (rows * margin * 2)) / rows;
			
			var log = document.getElementById('log');
			gridster = $(".gridster > ul").gridster({
				widget_base_dimensions: [w, h],
				widget_margins: [margin, margin],
				min_cols: cols,
				max_cols: cols,
				min_rows: rows,
				max_rows: rows,
				resize: {
					enabled: true,
					max_size: [4, 4],
					min_size: [1, 1]
				}
			}).data('gridster');
		});
		$(function(){
			$.blockUI.defaults = {
				message: 'Loading...',
				centerY: false,
				centerX: false,
				showOverlay: false,
				css: {
					width: '80px',
					top: '',
					left: '',
					right: '5px',
					bottom: '5px',
					border: 'none',
					backgroundColor: '#000',
					opacity: .8,
					color: '#fff',
					'font-size': '10px'
				},
				fadeIn: 200,
				fadeOut: 1000
			};
		});
		$(function(){
			refreshBuild(false);
			refreshDeploy();
			refreshTest();
			refreshTestChart();
			refreshGaugeChart();
		});
	</script>
</head>
<body>
	<div class="main">
		<section class="dashboard">
			<div class="gridster">
				<ul>
					<li data-row="1" data-col="1" data-sizex="4" data-sizey="2">
						<div class="build pass">
							<i class="inliner"></i>
							<div class="build-content1 content">BUILD</div>
							<div class="build-content2 content"></div>
						</div>
					</li>
					<li data-row="3" data-col="1" data-sizex="4" data-sizey="2">
						<div class="build-gauge" id="build-gauge">
						</div>
					</li>
					<li data-row="1" data-col="5" data-sizex="2" data-sizey="2">
						<div class="test">
							<div class="header">TEST</div>
							<table class="test-table">
								<colgroup>
									<col width="70%">
									<col width="30%">
								</colgroup>
								<tbody>
								</tbody>
							</table>
						</div>
					</li>
					<li data-row="3" data-col="5" data-sizex="2" data-sizey="2" class="no-resize">
						<div class="test-chart" id="test-chart">
						</div>
					</li>
					<li data-row="1" data-col="7" data-sizex="2" data-sizey="4">
						<div class="deploy">
							<div class="header">DEPLOY</div>
							<table class="deploy-table">
								<colgroup>
									<col width="75%">
									<col width="25%">
								</colgroup>
								<tbody>
								</tbody>
							</table>
						</div>
					</li>
				</ul>
			</div>
		<section>
	</div>
</body>

</html>