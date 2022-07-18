<?php
require_once("../../../includes/conf.php");
$usuario = $_SESSION['username'];
$sql = "SELECT * from tbl_inv where";
$query = $con->query($sql);
$data = array();
while($r = $query->fetch_object()){
    $data[]=$r;
}
?>


