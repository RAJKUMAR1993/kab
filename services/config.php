<?php
error_reporting(0);
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "vmeet_2020";
$servername = "localhost";
$username = "dbvMeet";
$password = "1_17Txha";
$dbname = "vmeet_2020";
date_default_timezone_set("Asia/Calcutta");
$cdate = date("Y-m-d H:i:s", time());
$cdate1 = date("d-m-Y", time());
$cdate2 = date("Y-m-d", time());
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>