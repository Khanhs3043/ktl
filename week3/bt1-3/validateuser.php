<?php
session_start(); 
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "login"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Xử lý dữ liệu trước khi truy vấn
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $_SESSION["isLogin"] = true; 
        header("Location: Logout.php"); 
        exit(); // Kết thúc kịch bản PHP
    } else {
        // Đăng nhập thất bại
        header("Location: login.html?error=invalid_credentials"); 
        echo "Nhập sai mật khẩu hoặc password"
        // Chuyển hướng đến trang login.htm
        exit(); // Kết thúc kịch bản PHP
    }

    $conn->close(); // Đóng kết nối với cơ sở dữ liệu
}
?>