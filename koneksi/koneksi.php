<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "kasir";

$con = new mysqli ($server, $user, $password, $database);

if (!$con) {
    die("<script>alert('Tidak terhubung dengan database')</script>");
}


$con2 = new mysqli ($server, $user, $password, $database);

if (!$con2) {
    die("<script>alert('Tidak terhubung dengan database')</script>");
}
?>
