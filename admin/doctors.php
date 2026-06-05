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
    mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");
    header("Location:doctors.php");
    exit();
}

// إضافة
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    mysqli_query($conn, "INSERT INTO doctors (name, department_id) VALUES ('$name', '$department_id')");
    header("Location:doctors.php");
    exit();
}

// تعديل
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    mysqli_query($conn, "UPDATE doctors SET name='$name', department_id='$department_id' WHERE id=$id");
    header("Location:doctors.php");
    exit();
}

$result = mysqli_query($conn, "SELECT doctors.*, departments.name AS dept_name FROM doctors LEFT JOIN departments ON doctors.department_id = departments.id");
$departments = mysqli_query($conn, "SELECT * FROM departments");
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

<h3>إضافة طبيب جديد</h3>
<form action="doctors.php" method="POST">
    <label>الاسم:</label>
    <input type="text" name="name"><br><br>
    <label>القسم:</label>
    <select name="department_id">
        <option value="">اختر القسم</option>
        <?php 
        $dept_list = mysqli_query($conn, "SELECT * FROM departments");
        while($d = mysqli_fetch_assoc($dept_list)){ ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
        <?php } ?>
    </select><br><br>
    <input type="submit" name="add" value="إضافة">
</form>

<br>
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
        <td>
            <form action="doctors.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                <select name="department_id">
                    <?php 
                    $dept_list2 = mysqli_query($conn, "SELECT * FROM departments");
                    while($d = mysqli_fetch_assoc($dept_list2)){ ?>
                    <option value="<?php echo $d['id']; ?>" <?php if($d['id'] == $row['department_id']) echo 'selected'; ?>>
                        <?php echo $d['name']; ?>
                    </option>
                    <?php } ?>
                </select>
                <input type="submit" name="edit" value="حفظ">
            </form>
        </td>
        <td><a href="doctors.php?delete=<?php echo $row['id']; ?>">حذف</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>