<?php
    require '../core/util/dbconnect.php';
    if(mysqli_connect_errno($con)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else {
        $sql = "SELECT pp.ProjectParentName,pp.idProjectParent,COUNT(CASE WHEN tr.testresult = 0 THEN 1 END) AS test_pass ";
        $sql .= ",COUNT(CASE WHEN tr.testresult = 2 THEN 1 END) AS test_warn ";
        $sql .= ",COUNT(CASE WHEN tr.testresult = 1 THEN 1 END) AS test_fail ";
        $sql .= "FROM systemtestresult tr,projectparent pp  ";
        $sql .= "WHERE WEEK(tr.systemtestdate) >= 25 ";
        $sql .= "AND tr.idsystemtestResult = (   ";
        $sql .= "SELECT MIN(idsystemtestResult)   ";
        $sql .= "FROM qualitydashboard.systemtestresult  ";
        $sql .= "WHERE idbuildsequence = tr.idbuildsequence  ";
        $sql .= "AND idProjectParent = tr.idProjectParent ) ";
        $sql .= "AND  pp.idProjectParent = tr.idProjectParent  ";
        $sql .= "GROUP BY pp.ProjectParentName,pp.idProjectParent ";
        $resultSQL = mysqli_query($con,$sql);
        $rowIndex = 0;
        while ($row = mysqli_fetch_array($resultSQL)) {
            $data[$rowIndex++] = array("name"=>$row['ProjectParentName'],"id"=>$row['idProjectParent'],"pass"=>$row['test_pass'],"warn"=>$row['test_warn'],"fail"=>$row['test_fail']);
        }
        echo "<div>
    <table class=\"table\">
      <thead>
        <tr>
          <th>#</th>
          <th>ProjectParentName</th>
          <th>Pass</th>
          <th>Warning</th>
          <th>Fail</th>
          <th>TestCase</th>
        </tr>
      </thead>
      

      <tbody>";
        $rowIndex2 = 1;
        foreach ($data as $value) {
            $sql2 = "SELECT testpass+testfail as testcase FROM systemtestresult WHERE idProjectParent = ".$value['id']." AND idbuildsequence = (SELECT MAX(idbuildsequence) FROM systemtestresult) 
 ";
            $resultSQL2 = mysqli_query($con,$sql2);
            $testcase = mysqli_fetch_array($resultSQL2);
            echo"<tr>";
            echo "<td>".$rowIndex2++."</td>";
            echo "<td>".$value['name']."</td>";
            echo "<td>".$value['pass']."</td>";
            echo "<td>".$value['warn']."</td>";
            echo "<td>".$value['fail']."</td>";
            echo "<td>".$testcase['testcase']."</td>";
            echo"</tr>";
        }
        echo "</tbody>
            </table>
            </div>";
    }
?>