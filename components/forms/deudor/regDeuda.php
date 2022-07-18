<?php

require_once '../../../includes/conf.php';
session_start();
$usuario = $_SESSION['username'];
$monto = $_POST['monto'];
$concepto = $_POST['concepto'];
$deudor = $_POST['deudor'];

$sql = "INSERT INTO tbl_deuda (monto,concepto, id_deudor, user) 
VALUES ('$monto','$concepto', $deudor, '$usuario')";
if($con->query($sql)){
    return 1;
}else{
    return 0;
}
