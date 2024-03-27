
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

// Thiết lập số lượng bản ghi trên mỗi trang và trang hiện tại
$records_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán offset
$offset = ($current_page - 1) * $records_per_page;

// Truy vấn để lấy tổng số bản ghi
$sql_total_records = "SELECT COUNT(*) AS total_records FROM NHANVIEN";
$result_total_records = $conn->query($sql_total_records);
$total_records = $result_total_records->fetch_assoc()['total_records'];

// Tính toán số lượng trang
$total_pages = ceil($total_records / $records_per_page);

// Truy vấn để lấy danh sách nhân viên với phân trang
$sql = "SELECT Ma_NV, Ten_NV, Phai, Noi_Sinh, Luong, Ten_Phong
        FROM NHANVIEN 
        INNER JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong 
        LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // In tiêu đề
    echo "<table border='1'>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Giới Tính</th>
                <th>Nơi Sinh</th>
                <th>Phòng Ban</th>
                <th>Lương</th>
                <th>Action</th>
            </tr>";
    // In dữ liệu từ mỗi hàng
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["Ma_NV"]."</td>
                <td>".$row["Ten_NV"]."</td>
                <td>";
                
        // Kiểm tra giới tính và chèn hình ảnh tương ứng
        if($row["Phai"] == "NAM") {
            echo "<img src='./images/1.png' alt='Nam' width='20'>";
        } elseif ($row["Phai"] == "NU") {
            echo "<img src='./images/2.png' alt='Nữ' width='20'>";
        } else {
            echo "Không xác định";
        }

        echo "</td>
                <td>".$row["Noi_Sinh"]."</td>
                <td>".$row["Ten_Phong"]."</td>
                <td>".$row["Luong"]."</td>
                <td>
                <a href='edit_employee.php?id=".$row["Ma_NV"]."'>Sửa</a> <!-- Liên kết đến trang sửa nhân viên với ID của nhân viên -->
                <a href='delete_employee.php?id=".$row["Ma_NV"]."'>Xóa</a> <!-- Liên kết đến trang xóa nhân viên với ID của nhân viên -->
            </td>
            </tr>";
    }
    echo "</table>";

    // Tạo các liên kết phân trang
    echo "<div>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=".$i."'>".$i."</a> ";
    }
    echo "</div>";
} else {
    echo "Không có dữ liệu";
}

$conn->close();
?>

