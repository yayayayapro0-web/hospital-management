<?php
include 'includes/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مستخدم جديد</title>
</head>
<body>

<h2>تسجيل مستخدم جديد</h2>

<?php if(isset($_GET['error'])){ echo "<p style='color:red'>".$_GET['error']."</p>"; } ?>

<form action="saveRegister.php" method="POST">
    <label>اسم المستخدم:</label><br>
    <input type="text" name="username"><br><br>
    <label>كلمة المرور:</label><br>
    <input type="password" name="password"><br><br>
    <label>تأكيد كلمة المرور:</label><br>
    <input type="password" name="confirm"><br><br>
    <input type="submit" value="تسجيل">
</form>

<br>
<a href="index.php">لدي حساب - تسجيل الدخول</a>

</body>
</html>