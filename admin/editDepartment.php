<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM departments WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE departments SET name='$name' WHERE id=$id");
    header("Location:departments.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل قسم</title>
</head>
<body>

<h2>تعديل القسم</h2>
<a href="departments.php">رجوع</a><br><br>

<form action="editDepartment.php?id=<?php echo $id; ?>" method="POST">
    <label>اسم القسم:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    <input type="submit" name="submit" value="حفظ">
</form>

</body>
</html>