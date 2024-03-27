<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
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

// Truy vấn để lấy danh sách nhân viên
$sql = "SELECT Ma_NV, Ten_NV, Phai, Noi_Sinh, Luong, Ten_Phong FROM NHANVIEN INNER JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong";
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
    </tr>";
    // In dữ liệu từ mỗi hàng
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["Ma_NV"]."</td>
        <td>".$row["Ten_NV"]."</td>
        <td>".$row["Phai"]."</td>
        <td>".$row["Noi_Sinh"]."</td>
        <td>".$row["Ten_Phong"]."</td>
        <td>".$row["Luong"]."</td>
    </tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu";
}

$conn->close();
?>

</body>
</html>
