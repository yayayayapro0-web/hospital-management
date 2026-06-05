<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];

    if(empty($name)){
        header("Location:addDoctor.php?error=اسم الطبيب فارغ");
        exit();
    }

    $sql = "INSERT INTO doctors (name, department_id) VALUES ('$name', '$department_id')";
    mysqli_query($conn, $sql);
    header("Location:doctors.php");
    exit();
}

$departments = mysqli_query($conn, "SELECT * FROM departments");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة طبيب</title>
</head>
<body>

<h2>إضافة طبيب جديد</h2>
<a href="doctors.php">رجوع</a><br><br>

<?php if(isset($_GET['error'])){ echo "<p style='color:red'>".$_GET['error']."</p>"; } ?>

<form action="addDoctor.php" method="POST">
    <label>اسم الطبيب:</label><br>
    <input type="text" name="name"><br><br>
    <label>القسم:</label><br>
    <select name="department_id">
        <option value="">اختر القسم</option>
        <?php while($row = mysqli_fetch_assoc($departments)){ ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <input type="submit" name="submit" value="إضافة">
</form>

</body>
</html>