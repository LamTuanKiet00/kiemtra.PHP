<?php include_once("header.php"); ?>
<!-- Form đăng nhập -->
<form action="login_process.php" method="post">
    <!-- Các trường thông tin -->
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>
