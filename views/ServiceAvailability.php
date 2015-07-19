<?php
    require '../core/util/dbconnect.php';
    if(mysqli_connect_errno($con)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else {
        $sql = "SELECT ProjectParentName ";
        $sql .= ", SUM(SEC) AS TOTAL_TIME ";
        $sql .= ", SUM(CASE WHEN (z.testresult IN ('2','0')) THEN SEC END) AS PASS_TIME ";
        $sql .= ", SUM(CASE WHEN (z.testresult IN ('1')) THEN SEC END) AS FAIL_TIME ";
        $sql .= "FROM  ( ";
        $sql .= "SELECT p.ProjectParentName ,b.idProjectParent, ";
        $sql .= "b.testresult, SUM(TIMESTAMPDIFF(SECOND, b.systemtestdate, a.systemtestdate)) SEC ";
        $sql .= "FROM systemtestresult a,systemtestresult b,projectparent p ";
        $sql .= "WHERE a.idProjectParent = b.idProjectParent ";
        $sql .= "AND b.idProjectParent = p.idProjectParent ";
        $sql .= "AND b.systemtestdate = ( ";
        $sql .= "SELECT MAX(systemtestdate) ";
        $sql .= "FROM systemtestresult x ";
        $sql .= "WHERE x.idProjectParent = a.idProjectParent ";
        $sql .= "AND x.systemtestdate < a.systemtestdate) ";
        $sql .= "GROUP BY p.ProjectParentName, b.idProjectParent, b.testresult ";
        $sql .= "ORDER BY p.ProjectParentName, b.testresult ";
        $sql .= ") z ";
        $sql .= "GROUP BY ProjectParentName ";
        $sql .= "ORDER BY FAIL_TIME DESC ";
        
        $resultSQL = mysqli_query($con,$sql) or die(mysqli_error($con));;
        $rowIndex = 0;
        $data = array();
        while ($row = mysqli_fetch_array($resultSQL)) {
            $data[$rowIndex++] = array("name"=>$row['ProjectParentName'],"total"=>$row['TOTAL_TIME'],"pass"=>$row['PASS_TIME'],"fail"=>$row['FAIL_TIME']);
        }
        echo "<div>
    <table class=\"table\">
      <thead>
        <tr>
          <th>ProjectParentName</th>
          <th>total(hr)</th>
          <th>pass(hr)</th>
          <th>fail(hr)</th>
        </tr>
      </thead>
      <tbody>";
        $rowIndex2 = 1;
        foreach ($data as $value) {
            echo"<tr>";
            echo "<td>".$value['name']."</td>";
            echo "<td>".number_format(($value['total']/3600),2,'.','')."</td>";
            echo "<td>".number_format(($value['pass']/3600),2,'.','')."</td>";
            echo "<td>".number_format(($value['fail']/3600),2,'.','')."</td>";
            echo"</tr>";
        }
        echo "</tbody>
            </table>
            </div>";
    }
?>