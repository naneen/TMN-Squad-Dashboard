<?php
$servername = "localhost:3307";
$username = "root";
$password = "Welcome1";
$dbname = "qualitydashboard2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
};
$sql = "SELECT *
		FROM (
			SELECT *
			FROM TEST_VOLOCITY
			WHERE SQUAD_ID = 1
			ORDER BY SPRINT_NO DESC
			LIMIT 0,5
			) as TEST_VOLOCITY1
		order by SPRINT_NO;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$userJson1 = array();
$userJson2 = array();
$userJson3 = array();
$ans = array();
$asd = "AAAA";
    while($row = $result->fetch_assoc()) {
    	array_push($userJson1, (int)$row["SPRINT_NO"]);
    	array_push($userJson2, (int)$row["POINT_COMMIT"]);
    	array_push($userJson3, (int)$row["POINT_COMPLETE"]);
    }
    $ans['SPRINT_NO'] = $userJson1;
    $ans['POINT_COMMIT'] = $userJson2;
    $ans['POINT_COMPLETE'] = $userJson3;
} else {
    echo "0 results";
}
$conn->close();
?>