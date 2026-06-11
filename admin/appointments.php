<?php
session_start();
include '../includes/db.php';
include '../includes/validation.php';
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

if(isset($_POST['add'])){
    $patient_id = validate($_POST['patient_id']);
    $doctor_id = validate($_POST['doctor_id']);
    $date = validate($_POST['date']);
    mysqli_query($conn, "INSERT INTO appointments (patient_id, doctor_id, date) VALUES ('$patient_id', '$doctor_id', '$date')");
    header("Location:appointments.php");
    exit();
}

$result = mysqli_query($conn, "SELECT appointments.*, patients.name AS patient_name, doctors.name AS doctor_name FROM appointments LEFT JOIN patients ON appointments.patient_id = patients.id LEFT JOIN doctors ON appointments.doctor_id = doctors.id");
$patients = mysqli_query($conn, "SELECT * FROM patients");
$doctors = mysqli_query($conn, "SELECT * FROM doctors");
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

<h3>إضافة موعد جديد</h3>
<form action="appointments.php" method="POST">
    <label>المريض:</label>
    <select name="patient_id">
        <option value="">اختر المريض</option>
        <?php while($row = mysqli_fetch_assoc($patients)){ ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <label>الطبيب:</label>
    <select name="doctor_id">
        <option value="">اختر الطبيب</option>
        <?php while($row = mysqli_fetch_assoc($doctors)){ ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <label>التاريخ:</label>
    <input type="date" name="date"><br><br>
    <input type="submit" name="add" value="إضافة">
</form>

<br>
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