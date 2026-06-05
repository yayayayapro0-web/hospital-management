<?php
$conn = mysqli_connect("localhost", "root", "");

$sql = file_get_contents("database/hospital.sql");
mysqli_multi_query($conn, $sql);

echo "تم إنشاء قاعدة البيانات بنجاح!";
?>