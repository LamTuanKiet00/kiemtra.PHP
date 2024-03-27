<?php include_once("header.php"); ?>
<?php

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

// Kiểm tra xem biến $conn đã được khởi tạo chưa
if (isset($conn)) {
    // Kiểm tra xem đã nhấn nút Đăng ký chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        
        // Kiểm tra xem tên người dùng đã tồn tại chưa
        $check_username_sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_username_sql);
        if ($result->num_rows > 0) {
            echo "Tên người dùng đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
        } else {
            // Thực hiện thêm dữ liệu vào cơ sở dữ liệu
            $insert_sql = "INSERT INTO users (username, password, fullname, email, role) VALUES ('$username', '$password', '$fullname', '$email', 'user')";
            if ($conn->query($insert_sql) === TRUE) {
                // Chuyển hướng về trang đăng nhập nếu đăng ký thành công
                header("Location: login.php");
                exit();
            } else {
                echo "Lỗi: " . $insert_sql . "<br>" . $conn->error;
            }
        }
    }
} else {
    echo "Lỗi: Không thể kết nối đến cơ sở dữ liệu.";
}
?>
