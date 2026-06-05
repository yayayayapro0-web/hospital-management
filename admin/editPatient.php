<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM patients WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "UPDATE patients SET name='$name', age='$age', phone='$phone' WHERE id=$id");
    header("Location:patients.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل مريض</title>
</head>
<body>

<h2>تعديل بيانات المريض</h2>
<a href="patients.php">رجوع</a><br><br>

<form action="editPatient.php?id=<?php echo $id; ?>" method="POST">
    <label>الاسم:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    <label>العمر:</label><br>
    <input type="number" name="age" value="<?php echo $row['age']; ?>"><br><br>
    <label>الهاتف:</label><br>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
    <input type="submit" name="submit" value="حفظ">
</form>

</body>
</html>