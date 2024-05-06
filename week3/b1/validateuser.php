<?php 
    session_start();
    if (!isset($_SESSION['isLogin'])) {
        $_SESSION['isLogin'] = false;
    }
    if($_SESSION['isLogin'] == false) {
        header('Location: login.html');
    }
    else header('Location: logout.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['username']=='khanh' && $_POST['password']=='123456')
        {   
            $_SESSION['isLogin'] = true;
            header('Location: logout.php');
            exit;
        } else {
            echo "Thông tin đăng nhập không hợp lệ?";
        }
    }
?>
