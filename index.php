<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - نظام المستشفى</title>
</head>
<body>

<h2>نظام إدارة المستشفى</h2>

<?php if(isset($_GET['error'])){ echo "<p style='color:red'>".$_GET['error']."</p>"; } ?>

<form action="validateLogin.php" method="POST">
    <label>اسم المستخدم:</label><br>
    <input type="text" name="username"><br><br>
    <label>كلمة المرور:</label><br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="دخول">
</form>

<br>
<a href="register.php">مستخدم جديد؟ سجّل هنا</a>

</body>
</html>