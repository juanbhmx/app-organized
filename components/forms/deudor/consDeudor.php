<?php
include '../../../includes/conf.php';

$sql = "SELECT * FROM tbl_deudor";
$res = $con->query($sql);
while($row = $res->fetch_assoc()){

    $arr[] = $row;
}
printf(json_encode(['result'=> $arr]));
