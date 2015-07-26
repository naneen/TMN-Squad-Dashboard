<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "Welcome1";
    $dbname = "qualitydashboard2";

    $con = new mysqli($servername, $username, $password, $dbname);
    $con->query("set names utf8");
    if ($con->connect_error) {
         die("Connection failed: " . $con->connect_error);
    };
?>