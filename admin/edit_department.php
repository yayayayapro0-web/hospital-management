<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];
$dept = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM departments WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE departments SET name='$name' WHERE id=$id");
    header("Location: departments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل قسم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">نظام إدارة المستشفى</span>
        <a href="departments.php" class="btn btn-light btn-sm">رجوع</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5>تعديل القسم</h5>
            <form method="POST">
                <div class="mb-3">
                    <label>اسم القسم</label>
                    <input type="text" name="name" class="form-control" value="<?= $dept['name'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>