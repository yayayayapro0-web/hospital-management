<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// حذف مريض
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM patients WHERE id=$id");
    header("Location: patients.php");
    exit();
}

// إضافة مريض
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "INSERT INTO patients (name, age, phone) VALUES ('$name', '$age', '$phone')");
    header("Location: patients.php");
    exit();
}

$patients = mysqli_query($conn, "SELECT * FROM patients");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المرضى</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام إدارة المستشفى</span>
        <a href="dashboard.php" class="btn btn-light btn-sm">لوحة التحكم</a>
    </div>
</nav>

<div class="container mt-4">
    <h4>إدارة المرضى</h4>

    <!-- نموذج الإضافة -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>إضافة مريض جديد</h5>
            <form method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="اسم المريض" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="age" class="form-control" placeholder="العمر" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">إضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- جدول المرضى -->
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>العمر</th>
                <th>الهاتف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($patients)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td>
                    <a href="edit_patient.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                    <a href="patients.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>