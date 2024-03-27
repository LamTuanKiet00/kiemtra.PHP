<?php include_once("header.php"); ?>
<!-- Form đăng ký -->
<form action="register_process.php" method="post">
    <!-- Các trường thông tin -->
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <input type="text" name="fullname" placeholder="Họ và tên">
    <input type="email" name="email" placeholder="Email">
    <select name="role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    <button type="submit">Đăng ký</button>
</form>
