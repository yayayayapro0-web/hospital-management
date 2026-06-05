<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM appointments WHERE id=$id");
    header("Location: appointments.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    mysqli_query($conn, "INSERT INTO appointments (patient_id, doctor_id, date) VALUES ('$patient_id', '$doctor_id', '$date')");
    header("Location: appointments.php");
    exit();
}

$appointments = mysqli_query($conn, "
    SELECT appointments.*, patients.name AS patient_name, doctors.name AS doctor_name 
    FROM appointments 
    LEFT JOIN patients ON appointments.patient_id = patients.id
    LEFT JOIN doctors ON appointments.doctor_id = doctors.id
");
$patients = mysqli_query($conn, "SELECT * FROM patients");
$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المواعيد</title>
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
    <h4>إدارة المواعيد</h4>

    <div class="card mb-4">
        <div class="card-body">
            <h5>إضافة موعد جديد</h5>
            <form method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <select name="patient_id" class="form-control" required>
                            <option value="">اختر المريض</option>
                            <?php while ($p = mysqli_fetch_assoc($patients)): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="doctor_id" class="form-control" required>
                            <option value="">اختر الطبيب</option>
                            <?php while ($d = mysqli_fetch_assoc($doctors)): ?>
                            <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date" class="form-control" required>
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
                <th>المريض</th>
                <th>الطبيب</th>
                <th>التاريخ</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($appointments)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['patient_name'] ?></td>
                <td><?= $row['doctor_name'] ?></td>
                <td><?= $row['date'] ?></td>
                <td>
                    <a href="appointments.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>