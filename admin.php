<?php
// Hàm kiểm tra vai trò của người dùng
function is_admin($username) {
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ql_nhansu";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["role"] == "admin") {
            return true; // Trả về true nếu người dùng có vai trò là admin
        }
    }

    $conn->close();

    return false; // Trả về false nếu người dùng không có vai trò là admin
}

// Kiểm tra vai trò của người dùng sau khi họ đăng nhập
$username = ""; // Thay thế bằng tên người dùng của người đăng nhập (có thể lấy từ session hoặc biến khác)

if (is_admin($username)) {
    // Người dùng có vai trò admin
    // Hiển thị các liên kết hoặc nút để thực hiện chức năng thêm, xoá và sửa nhân viên
    echo "<a href='add_employee.php'>Thêm nhân viên</a>";
    echo "<a href='edit_employee.php?id=employee_id'>Sửa nhân viên</a>"; // Thay employee_id bằng ID của nhân viên cần sửa
    echo "<a href='delete_employee.php?id=employee_id'>Xóa nhân viên</a>"; // Thay employee_id bằng ID của nhân viên cần xóa
} else {
    // Người dùng không có vai trò admin
    echo "Bạn không có quyền truy cập vào chức năng này";
    // Hiển thị thông báo hoặc chuyển hướng người dùng đến trang khác
}
?>
