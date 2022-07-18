<?php
session_start();
require_once '../../../includes/conf.php';

$usuario = $_SESSION['username'];
$cant = $_POST['cant'];
$fecha = date('d/m/y');
$sql = "INSERT INTO tbl_inv (cantidad, movimiento, fecha2, user) VALUES ('$cant', 'INGRESO', '$fecha', '$usuario')";
if($con->query($sql)){
    return 1;
}else{
    return 0;
}
