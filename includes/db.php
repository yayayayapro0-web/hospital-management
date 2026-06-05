<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}
?>