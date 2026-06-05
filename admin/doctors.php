<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");
    header("Location: doctors.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    mysqli_query($conn, "INSERT INTO doctors (name, department_id) VALUES ('$name', '$department_id')");
    header("Location: doctors.php");
    exit();
}

$doctors = mysqli_query($conn, "SELECT doctors.*, departments.name AS dept_name FROM doctors LEFT JOIN departments ON doctors.department_id = departments.id");
$departments = mysqli_query($conn, "SELECT * FROM departments");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الأطباء</title>
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
    <h4>إدارة الأطباء</h4>

    <div class="card mb-4">
        <div class="card-body">
            <h5>إضافة طبيب جديد</h5>
            <form method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="اسم الطبيب" required>
                    </div>
                    <div class="col-md-5">
                        <select name="department_id" class="form-control" required>
                            <option value="">اختر القسم</option>
                            <?php while ($dept = mysqli_fetch_assoc($departments)): ?>
                            <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">إضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>القسم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($doctors)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['dept_name'] ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                    <a href="doctors.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>