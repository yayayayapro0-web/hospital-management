<?php
include 'includes/db.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        header("Location:index.php?error=اسم المستخدم فارغ");
        exit();
    }

    if(empty($password)){
        header("Location:index.php?error=كلمة المرور فارغة");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
       if($password == $row["password"]){
            $_SESSION['username'] = $row["username"];
            $_SESSION['role'] = $row["role"];
            $_SESSION['id'] = $row["id"];
            $_SESSION['logged'] = TRUE;
            header("Location:admin/dashboard.php");
            exit();
        } else {
            header("Location:index.php?error=كلمة المرور خاطئة");
            exit();
        }
    } else {
        header("Location:index.php?error=المستخدم غير موجود");
        exit();
    }
}
?>