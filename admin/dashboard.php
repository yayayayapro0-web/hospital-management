<?php
session_start();
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
</head>
<body>

<h2>مرحباً <?php echo $_SESSION['username']; ?> - لوحة التحكم</h2>

<ul>
    <li><a href="patients.php">إدارة المرضى</a></li>
    <li><a href="doctors.php">إدارة الأطباء</a></li>
    <li><a href="appointments.php">إدارة المواعيد</a></li>
    <li><a href="departments.php">إدارة الأقسام</a></li>
    <li><a href="../logout.php">تسجيل الخروج</a></li>
</ul>

</body>
</html>