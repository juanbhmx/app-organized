<?php

require_once '../../../includes/conf.php';
session_start();
$usuario = $_SESSION['username'];
$name = $_POST['name'];

$sql = "INSERT INTO tbl_deudor (nombre,user) VALUES ('$name', '$usuario')";
if($con->query($sql)){
    return 1;
}else{
    return 0;
}
