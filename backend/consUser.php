<?php
require_once("../includes/conf.pdo.php");

if ($_POST) {
    $db = new Database();
    $username     = strip_tags($_POST['user']);

    $stmt = $db->connect()->prepare("SELECT username FROM tbl_user WHERE username=:username");
    $stmt->execute(array(':username' => $username));
    $count = $stmt->rowCount();

    if ($count > 0) {
        echo 1;
    } else {
        echo 0;
    }
}
