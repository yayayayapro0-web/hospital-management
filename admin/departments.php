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
    mysqli_query($conn, "DELETE FROM departments WHERE id=$id");
    header("Location:departments.php");
    exit();
}

if(isset($_POST['add'])){
    $name = validate($_POST['name']);
    mysqli_query($conn, "INSERT INTO departments (name) VALUES ('$name')");
    header("Location:departments.php");
    exit();
}

if(isset($_POST['edit'])){
    $id = validate($_POST['id']);
    $name = validate($_POST['name']);
    mysqli_query($conn, "UPDATE departments SET name='$name' WHERE id=$id");
    header("Location:departments.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM departments");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الأقسام</title>
</head>
<body>

<h2>إدارة الأقسام</h2>
<a href="dashboard.php">رجوع للوحة التحكم</a><br><br>

<h3>إضافة قسم جديد</h3>
<form action="departments.php" method="POST">
    <label>اسم القسم:</label>
    <input type="text" name="name"><br><br>
    <input type="submit" name="add" value="إضافة">
</form>

<br>
<table border="1">
    <tr>
        <th>ID</th>
        <th>اسم القسم</th>
        <th>تعديل</th>
        <th>حذف</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td>
            <form action="departments.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                <input type="submit" name="edit" value="حفظ">
            </form>
        </td>
        <td><a href="departments.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>