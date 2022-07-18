<?php
include '../../../includes/conf.php';
session_start();

$iddeuda    = $_POST['iddeuda'];
$ahora      = $_POST['ahora'];
$deudor     = $_POST["deudor"];

$query = "UPDATE tbl_deuda SET monto='{$ahora}'
WHere 
id_deudor= '{$deudor}' and id_deuda='{$iddeuda}'";

if ($con->query($query)) {
    echo 1;
} else {
    echo 0;
}
