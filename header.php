<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Nhân Sự</title>
</head>
<body>
    <header>
        <!-- Các liên kết menu -->
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="add_employee.php">Thêm Nhân Viên</a>
            <!-- Liên kết xoá và sửa nhân viên -->
        <?php endif; ?>
        <!-- Liên kết đăng nhập và đăng ký -->
        <?php if(!isset($_SESSION['username'])): ?>
            <a href="login.php">Đăng nhập</a>
            <a href="register.php">Đăng ký</a>
        <?php else: ?>
            <a href="logout.php">Đăng xuất</a>
        <?php endif; ?>
    </header>
</body>
</html>
