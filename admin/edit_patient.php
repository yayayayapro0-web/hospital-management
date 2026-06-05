<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];
$patient = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM patients WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "UPDATE patients SET name='$name', age='$age', phone='$phone' WHERE id=$id");
    header("Location: patients.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل مريض</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام إدارة المستشفى</span>
        <a href="patients.php" class="btn btn-light btn-sm">رجوع</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5>تعديل بيانات المريض</h5>
            <form method="POST">
                <div class="mb-3">
                    <label>اسم المريض</label>
                    <input type="text" name="name" class="form-control" value="<?= $patient['name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>العمر</label>
                    <input type="number" name="age" class="form-control" value="<?= $patient['age'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="<?= $patient['phone'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>