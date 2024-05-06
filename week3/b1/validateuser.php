<?php 
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "accountmana";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    $sql = "SELECT username, password FROM accounts";
    $result = $conn->query($sql);
    if (!isset($_SESSION['isLogin'])) {
        $_SESSION['isLogin'] = false;
    }
    if($_SESSION['isLogin'] == false) {
        header('Location: login.html');
    }
    else header('Location: logout.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($_POST['username']==$row["username"] && $_POST['password']==$row["password"])
                {   
                    $_SESSION['isLogin'] = true;
                    header('Location: logout.php');
                    exit;
                } else {
                    echo "Thông tin đăng nhập không hợp lệ?";
                }
            } }    
        
    }
?>
