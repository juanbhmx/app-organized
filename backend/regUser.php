<?php
include_once '../includes/conf.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fechanac = $_POST['fechanac'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$hash = password_hash($pass, PASSWORD_BCRYPT);

$ipaddress = '';
if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
else
    $ipaddress = 'UNKNOWN';
if (strpos($ipaddress, ",") !== false) :
    $ipaddress = strtok($ipaddress, ",");
endif;
echo $ipaddress;

$sql = "INSERT INTO `tbl_user` (`nombre`, `apellidos`, `fechanacimiento`, username, contrasena, dirip)
    VALUES ('$nombre', '$apellidos','$fechanac', '$user', '$hash', '$ipaddress');";
if (mysqli_query($con, $sql)) {
    echo 1;
} else {
    echo 0;
}
