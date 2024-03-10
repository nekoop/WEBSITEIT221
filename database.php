<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword ="";
$dbName = "users_db";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName );
If (!$conn) {
die("Something went wrong!");
}

?>