<?php
session_start();
ob_start();
// Kết nối đến CSDL
$servername = "localhost";
$username = "root"; // Thay bằng username của bạn
$password = ""; // Thay bằng password của bạn
$dbname = "login"; // Thay bằng tên CSDL của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin từ form đăng nhập
$user = $_POST['username'];
$pass = $_POST['password'];

// Xử lí thông tin đăng nhập
$sql = "SELECT * FROM tb1 WHERE username='$user' AND pass='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Đăng nhập thành công, lưu trạng thái vào Session
    $_SESSION["Login"] = true;
    header("location: logout.php"); // Chuyển hướng đến trang logout sau khi đăng nhập thành công
} else {
    
    // Đăng nhập không hợp lệ, redirect về trang login.htm
    header("Location: login.html");
}

$conn->close();

?>