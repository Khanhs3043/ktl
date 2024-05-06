<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign up</title>
</head>
<body>
    <form action="signup.php" method="post">
    <div class="login login2">
    
        <p class="title">Register</p>
        <div class="input">
            
            <input class="in" type="text" name="username" placeholder="username" required>
            <input class="in" type ="password" name="password" placeholder="password" required>
            <input class="in" type ="password" name="cfpassword" placeholder="confirm password" required>
            
        </div>
        
        <button class="loginBtn"> Register</button>
        <a class="log" href="login.html">Back to Login</a>
    </div>
</form>
</body>
</html>
<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "accountmana";
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if($_POST['password']===$_POST['cfpassword']){
            $hashed_password = sha1($_POST['password']);

            // Sử dụng truy vấn tham số để tránh tấn công SQL Injection
            $sql = "INSERT INTO enaccounts (id, PASSWORD, username) VALUES (NULL, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $_POST['username']);
            // Thực thi truy vấn
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                header("Location: login.html");
            } else {
                echo "<p class='err'>Đã xảy ra lỗi khi thêm mục mới.</p>";
            }
            $stmt->close();
        }else echo "<p class = 'err'>Mật khẩu không khớp</p>";
        
    }
?>