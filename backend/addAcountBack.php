<?php
session_start();
include "../includes/conf.pdo.php";
$db = new Database();

$usuario = $_SESSION['username'];
$url = $_POST['url'];
$cuenta = $_POST['acount'];
$pass = $_POST['pass'];

// var_dump($url, $cuenta, $pass);

$stmt = $db->connect()->prepare("INSERT INTO tbl_acounts (url, user, password, usuario) VALUES ('$url', '$cuenta', '$pass', '$usuario');");
$stmt->execute();
echo 0;
