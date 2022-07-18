<?php

include_once '../includes/conf.pdo.php';
session_start();

if (isset($_GET['cerrar_sesion'])) {
	session_unset();
	session_destroy();
}

// if (isset($_POST['username']) && isset($_POST['contrasena'])) {
$username = $_POST['username'];
$password = $_POST['pass'];

$db = new Database();
$query = $db->connect()->prepare('SELECT * FROM tbl_user WHERE username = :username');
$query->execute(['username' => $username]);
$row = $query->fetch(PDO::FETCH_NUM);


if ($row == true) {
	if (password_verify($password, $row[6])) {
		$rol = $row[6];
		$user = $row[5];
		$_SESSION['username'] = $user;
		echo 1;
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
		$fecha = date('d/m/y');

		$query = $db->connect()->prepare("INSERT INTO tbl_session (username, ip, fecha) VALUE ('$user', '$ipaddress', '$fecha')");
		$query->execute();
	} else {
		echo 0;
	}
}


// }
