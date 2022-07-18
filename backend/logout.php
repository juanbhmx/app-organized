<?php  
include_once '../includes/conf.php';
session_start();

// session_unset();
session_destroy();

header("location: ../");
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
exit();
?>