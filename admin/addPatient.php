<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    if(empty($name)){
        header("Location:addPatient.php?error=الاسم فارغ");
        exit();
    }

    $sql = "INSERT INTO patients (name, age, phone) VALUES ('$name', '$age', '$phone')";
    mysqli_query($conn, $sql);
    header("Location:patients.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مريض</title>
</head>
<body>

<h2>إضافة مريض جديد</h2>
<a href="patients.php">رجوع</a><br><br>

<?php if(isset($_GET['error'])){ echo "<p style='color:red'>".$_GET['error']."</p>"; } ?>

<form action="addPatient.php" method="POST">
    <label>الاسم:</label><br>
    <input type="text" name="name"><br><br>
    <label>العمر:</label><br>
    <input type="number" name="age"><br><br>
    <label>الهاتف:</label><br>
    <input type="text" name="phone"><br><br>
    <input type="submit" name="submit" value="إضافة">
</form>

</body>
</html>