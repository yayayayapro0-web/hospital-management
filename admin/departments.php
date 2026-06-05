<?php
session_start();
include '../includes/db.php';
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
<a href="addDepartment.php">إضافة قسم جديد</a><br><br>

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
        <td><a href="editDepartment.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
        <td><a href="departments.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>