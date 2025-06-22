<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$basename = "projektni_zadatak";

$dbc = mysqli_connect($servername, $username, $password, $basename)
  or die('Greška pri povezivanju s bazom: ' . mysqli_connect_error());

mysqli_set_charset($dbc, "utf8");
?>
