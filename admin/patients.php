<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

// حذف
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM patients WHERE id=$id");
    header("Location:patients.php");
    exit();
}

// إضافة
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "INSERT INTO patients (name, age, phone) VALUES ('$name', '$age', '$phone')");
    header("Location:patients.php");
    exit();
}

// تعديل
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    mysqli_query($conn, "UPDATE patients SET name='$name', age='$age', phone='$phone' WHERE id=$id");
    header("Location:patients.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM patients");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المرضى</title>
</head>
<body>

<h2>إدارة المرضى</h2>
<a href="dashboard.php">رجوع للوحة التحكم</a><br><br>

<h3>إضافة مريض جديد</h3>
<form action="patients.php" method="POST">
    <label>الاسم:</label>
    <input type="text" name="name"><br><br>
    <label>العمر:</label>
    <input type="number" name="age"><br><br>
    <label>الهاتف:</label>
    <input type="text" name="phone"><br><br>
    <input type="submit" name="add" value="إضافة">
</form>

<br>
<table border="1">
    <tr>
        <th>ID</th>
        <th>الاسم</th>
        <th>العمر</th>
        <th>الهاتف</th>
        <th>تعديل</th>
        <th>حذف</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td>
            <form action="patients.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                <input type="number" name="age" value="<?php echo $row['age']; ?>">
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
                <input type="submit" name="edit" value="حفظ">
            </form>
        </td>
        <td><a href="patients.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>