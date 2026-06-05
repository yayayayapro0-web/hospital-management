<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];

    if(empty($name)){
        header("Location:addDepartment.php?error=اسم القسم فارغ");
        exit();
    }

    $sql = "INSERT INTO departments (name) VALUES ('$name')";
    mysqli_query($conn, $sql);
    header("Location:departments.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة قسم</title>
</head>
<body>

<h2>إضافة قسم جديد</h2>
<a href="departments.php">رجوع</a><br><br>

<?php if(isset($_GET['error'])){ echo "<p style='color:red'>".$_GET['error']."</p>"; } ?>

<form action="addDepartment.php" method="POST">
    <label>اسم القسم:</label><br>
    <input type="text" name="name"><br><br>
    <input type="submit" name="submit" value="إضافة">
</form>

</body>
</html>