<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="js/jquery.min.map"></script>
        <script src="js/highcharts.js"></script>
        <script src="js/exporting.js"></script>
        <script src="js/dark-unica.js"></script>
        <script src="js/time.js"></script>
        <script src="js/valocityChart.js"></script>
        <script src="js/retro.js"></script>
        <script src="js/DeployChart.js"></script>
        <script src="js/CoverageChart.js"></script>
        <script src="js/defectchart.js"></script>
        <?php include 'php/QuerySquadName.php'; ?>
        <?php include 'php/QueryCountCard.php'; ?>

        <link rel="stylesheet" type="text/css" href="css/reset.css">

        <script type="text/javascript">
            $SQUAD_ID = <?php echo $_POST['SQUAD_ID']?>;
            var pageRetro = 0;
            var countPage = 1;
            function setButtonPage(){
                var count = <?php echo $count?>;
                countPage = Math.ceil(count/4.0);
                for(var i = 0;i<countPage;i++){
                    var button = document.createElement("div");
                    button.setAttribute("class","pagination__dot" + ((i==0)? " pagination__dot--active":""));
                    button.setAttribute("onclick", "setPageRetro(this,"+i+")");
                    var pagination = document.getElementsByClassName("pagination");
                    pagination[0].appendChild(button);
                }
            }

            function autoRefresh(){
                $.ajax({
                    success: function() {
                        if(getCorrectTime() == "00:00:00"){
                            $("#year").html(getYear());
                            DeployChart($SQUAD_ID);
                            CoverageChart($SQUAD_ID);
                        }
                        valocityChart($SQUAD_ID);
                        // CoverageChart($SQUAD_ID);
                        retrospective($SQUAD_ID,pageRetro);
                        defectChart($SQUAD_ID);
                        // var xxx = Math.ceil(<?php
                        // include 'php/QueryCountCard.php';
                        //  echo $count;
                        //  ?>/4.0);
                        // alert(xxx);
                        // if(countPage < xxx){
                        //     alert("AAA");
                        //     for(var i = countPage;i<xxx;i++){
                        //         var button = document.createElement("div");
                        //         button.setAttribute("class","pagination__dot" + ((i==0)? " pagination__dot--active":""));
                        //         button.setAttribute("onclick", "setPageRetro(this,"+i+")");
                        //         var pagination = document.getElementsByClassName("pagination");
                        //         pagination[0].appendChild(button);
                        //     }
                        //     countPage = xxx;
                        // }
                  }
                });
            }
            setInterval(autoRefresh,100);

            window.onload =  function(){
                $("#year").html(getYear());
                retrospective($SQUAD_ID,pageRetro);
                valocityChart($SQUAD_ID);
                DeployChart($SQUAD_ID);
                CoverageChart($SQUAD_ID);
                defectChart($SQUAD_ID);
                setButtonPage();
                autoRefresh();
            }

            function setPageRetro(element,page_number){
                // alert(page_number);
              pageRetro = page_number;
              $(".pagination div").removeClass("pagination__dot--active");
              $(element).addClass("pagination__dot--active");
            }
          </script>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/SprintDashboard.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:history.back()">Sprint Dashboard : Team <?php echo $squad_name?> (<span id = "year"></span>)</a>
            </div>
        </nav>

        <div id="allContents">

            <div id="leftContent">
                <div id="" class="well">
                  <div id="valocity"></div>
                </div>

                <div id="" class="well">
                    <div id="defect"></div>
                </div>

                <div id="" class="well">
                  <div id="coverage"></div>
                </div>

                <div id="" class="well">
                  <div id="Deploy"></div>
                </div>
            </div>

            <div id="rightContent">
                <div id="retro" class="well">
                    <p class="text">Retrospective</p>
                    <div id="positive" class="feeling">
                        <p>Positive</p>
                    </div>
                    <div id="neutral" class="feeling">
                        <p>Neutral</p>
                    </div>
                    <div id="stressful" class="feeling">
                        <p>Stressful</p>
                    </div>

                    <div id="retroCard"></div>
                </div>
                <div class="pagination">

              </div>
            </div>
        </div>
    </body>
</html>



