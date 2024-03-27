<?php include_once("header.php"); ?>
<?php

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $Ma_NV = $_POST['Ma_NV'];
    $Ten_NV = $_POST['Ten_NV'];
    $Phai = $_POST['Phai'];
    $Noi_Sinh = $_POST['Noi_Sinh'];
    $Luong = $_POST['Luong'];
    $Ma_Phong = $_POST['Ma_Phong'];
    
    // Thực hiện thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Luong, Ma_Phong) VALUES ('$Ma_NV', '$Ten_NV', '$Phai', '$Noi_Sinh', '$Luong', '$Ma_Phong')";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang admin.php sau khi thêm nhân viên thành công
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
