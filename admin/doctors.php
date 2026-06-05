<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");
    header("Location:doctors.php");
    exit();
}

$result = mysqli_query($conn, "SELECT doctors.*, departments.name AS dept_name FROM doctors LEFT JOIN departments ON doctors.department_id = departments.id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الأطباء</title>
</head>
<body>

<h2>إدارة الأطباء</h2>
<a href="dashboard.php">رجوع للوحة التحكم</a><br><br>
<a href="addDoctor.php">إضافة طبيب جديد</a><br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>الاسم</th>
        <th>القسم</th>
        <th>تعديل</th>
        <th>حذف</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['dept_name']; ?></td>
        <td><a href="editDoctor.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
        <td><a href="doctors.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>