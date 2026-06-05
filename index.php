<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - نظام المستشفى</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4">نظام إدارة المستشفى</h4>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">خطأ في اسم المستخدم أو كلمة المرور</div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label>اسم المستخدم</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">دخول</button>
                    </form>
<a href="register.php" class="btn btn-link w-100 text-center mt-2">مستخدم جديد؟ سجّل هنا</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>