<?php
include 'includes/db.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if(empty($username)){
        header("Location:register.php?error=اسم المستخدم فارغ");
        exit();
    }

    if($password != $confirm){
        header("Location:register.php?error=كلمة المرور غير متطابقة");
        exit();
    }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        header("Location:register.php?error=اسم المستخدم موجود مسبقاً");
        exit();
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed', 'user')";
    mysqli_query($conn, $sql);
    header("Location:index.php");
    exit();
}
?>