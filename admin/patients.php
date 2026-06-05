<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION['logged'])){
    header("Location:../index.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM patients WHERE id=$id");
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
<a href="addPatient.php">إضافة مريض جديد</a><br><br>

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
        <td><a href="editPatient.php?id=<?php echo $row['id']; ?>">تعديل</a></td>
        <td><a href="patients.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>