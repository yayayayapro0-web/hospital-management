<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM appointments WHERE id=$id");
    header("Location:appointments.php");
    exit();
}

$result = mysqli_query($conn, "SELECT appointments.*, patients.name AS patient_name, doctors.name AS doctor_name FROM appointments LEFT JOIN patients ON appointments.patient_id = patients.id LEFT JOIN doctors ON appointments.doctor_id = doctors.id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المواعيد</title>
</head>
<body>

<h2>إدارة المواعيد</h2>
<a href="dashboard.php">رجوع للوحة التحكم</a><br><br>
<a href="addAppointment.php">إضافة موعد جديد</a><br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>المريض</th>
        <th>الطبيب</th>
        <th>التاريخ</th>
        <th>حذف</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['patient_name']; ?></td>
        <td><?php echo $row['doctor_name']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><a href="appointments.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>