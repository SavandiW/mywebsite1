<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "forms";



$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>