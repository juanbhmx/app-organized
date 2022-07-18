<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$con = new mysqli($servername, $username, $password, $database);

if ($con->connect_error) {
die("Conexión fallida: " . $con->connect_error);
}
