<?php include_once("header.php"); ?>
<?php
// Kiểm tra xem đã nhận được ID của nhân viên cần sửa chưa
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

    // Truy vấn để lấy thông tin của nhân viên cần sửa
    $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV='$Ma_NV'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Hiển thị biểu mẫu để sửa thông tin nhân viên
        ?>
        <form action="update_employee.php" method="post">
            <input type="hidden" name="Ma_NV" value="<?php echo $row['Ma_NV']; ?>">
            Tên nhân viên: <input type="text" name="Ten_NV" value="<?php echo $row['Ten_NV']; ?>"><br>
            Giới tính: <input type="text" name="Phai" value="<?php echo $row['Phai']; ?>"><br>
            Nơi sinh: <input type="text" name="Noi_Sinh" value="<?php echo $row['Noi_Sinh']; ?>"><br>
            Lương: <input type="text" name="Luong" value="<?php echo $row['Luong']; ?>"><br>
            Mã phòng: <input type="text" name="Ma_Phong" value="<?php echo $row['Ma_Phong']; ?>"><br>
            <input type="submit" value="Sửa thông tin nhân viên">
        </form>
        <?php
    } else {
        echo "Không tìm thấy nhân viên.";
    }

    $conn->close();
} else {
    echo "Không nhận được ID của nhân viên.";
}
?>
