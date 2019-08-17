<?php
$host = "localhost";
$username = "dbuser";
$password = "Rpg0H5DA9o]>M?%=";
$dbname = "ogiri_sns_php";

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
  error_log($mysqli->connect_error);
  exit;
}

?>
