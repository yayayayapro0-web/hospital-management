<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];
$doctor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM doctors WHERE id=$id"));
$departments = mysqli_query($conn, "SELECT * FROM departments");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    mysqli_query($conn, "UPDATE doctors SET name='$name', department_id='$department_id' WHERE id=$id");
    header("Location: doctors.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل طبيب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام إدارة المستشفى</span>
        <a href="doctors.php" class="btn btn-light btn-sm">رجوع</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5>تعديل بيانات الطبيب</h5>
            <form method="POST">
                <div class="mb-3">
                    <label>اسم الطبيب</label>
                    <input type="text" name="name" class="form-control" value="<?= $doctor['name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>القسم</label>
                    <select name="department_id" class="form-control" required>
                        <?php while ($dept = mysqli_fetch_assoc($departments)): ?>
                        <option value="<?= $dept['id'] ?>" <?= $dept['id'] == $doctor['department_id'] ? 'selected' : '' ?>>
                            <?= $dept['name'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>