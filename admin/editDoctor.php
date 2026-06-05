<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM doctors WHERE id=$id");
$row = mysqli_fetch_assoc($result);
$departments = mysqli_query($conn, "SELECT * FROM departments");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    mysqli_query($conn, "UPDATE doctors SET name='$name', department_id='$department_id' WHERE id=$id");
    header("Location:doctors.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل طبيب</title>
</head>
<body>

<h2>تعديل بيانات الطبيب</h2>
<a href="doctors.php">رجوع</a><br><br>

<form action="editDoctor.php?id=<?php echo $id; ?>" method="POST">
    <label>اسم الطبيب:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    <label>القسم:</label><br>
    <select name="department_id">
        <?php while($dept = mysqli_fetch_assoc($departments)){ ?>
        <option value="<?php echo $dept['id']; ?>" <?php if($dept['id'] == $row['department_id']) echo 'selected'; ?>>
            <?php echo $dept['name']; ?>
        </option>
        <?php } ?>
    </select><br><br>
    <input type="submit" name="submit" value="حفظ">
</form>

</body>
</html>