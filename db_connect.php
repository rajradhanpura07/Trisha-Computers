<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "project_trisha_computers";
// $dbname = "client_details";


$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>
