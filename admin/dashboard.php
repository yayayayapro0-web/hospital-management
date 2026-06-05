<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام إدارة المستشفى</span>
        <a href="../logout.php" class="btn btn-light btn-sm">تسجيل الخروج</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>مرحباً بك في لوحة التحكم</h3>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-success text-center p-3">
                <h5>المرضى</h5>
                <a href="patients.php" class="btn btn-light btn-sm mt-2">إدارة المرضى</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info text-center p-3">
                <h5>الأطباء</h5>
                <a href="doctors.php" class="btn btn-light btn-sm mt-2">إدارة الأطباء</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning text-center p-3">
                <h5>المواعيد</h5>
                <a href="appointments.php" class="btn btn-light btn-sm mt-2">إدارة المواعيد</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger text-center p-3">
                <h5>الأقسام</h5>
                <a href="departments.php" class="btn btn-light btn-sm mt-2">إدارة الأقسام</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>