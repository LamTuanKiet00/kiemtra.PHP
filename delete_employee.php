<?php
// Kiểm tra xem đã nhận được ID của nhân viên cần xóa chưa
if(isset($_GET['id'])) {
    // Lấy ID của nhân viên từ URL
    $Ma_NV = $_GET['id'];

    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ql_nhansu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Thực hiện xóa nhân viên khỏi cơ sở dữ liệu
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV='$Ma_NV'";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang admin.php sau khi xóa nhân viên thành công
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Không nhận được ID của nhân viên.";
}
?>
