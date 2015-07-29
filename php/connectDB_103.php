<?php
    $servername = "192.168.78.103:3306";
    $username = "root";
    $password = "Welcome1";
    $dbname = "qualitydashboard";

    $con = new mysqli($servername, $username, $password, $dbname);
    $con->query("set names utf8");
    if ($con->connect_error) {
         die("Connection failed: " . $con->connect_error);
    };


?>
