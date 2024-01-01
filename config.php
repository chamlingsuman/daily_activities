<?php 
$sname = "localhost";
$u_name = "root";
$password = "";
$db_name = "daily_activities";

$conn = mysqli_connect($sname, $u_name, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
?>