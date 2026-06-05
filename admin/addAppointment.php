<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_POST['submit'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, date) VALUES ('$patient_id', '$doctor_id', '$date')";
    mysqli_query($conn, $sql);
    header("Location:appointments.php");
    exit();
}

$patients = mysqli_query($conn, "SELECT * FROM patients");
$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة موعد</title>
</head>
<body>

<h2>إضافة موعد جديد</h2>
<a href="appointments.php">رجوع</a><br><br>

<form action="addAppointment.php" method="POST">
    <label>المريض:</label><br>
    <select name="patient_id">
        <option value="">اختر المريض</option>
        <?php while($row = mysqli_fetch_assoc($patients)){ ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <label>الطبيب:</label><br>
    <select name="doctor_id">
        <option value="">اختر الطبيب</option>
        <?php while($row = mysqli_fetch_assoc($doctors)){ ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <label>التاريخ:</label><br>
    <input type="date" name="date"><br><br>
    <input type="submit" name="submit" value="إضافة">
</form>

</body>
</html>