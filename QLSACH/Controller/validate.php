<?php
session_start();
require '../Model/dbConnect.php';

if (!isset($_SESSION['isLogin'])) {
    $_SESSION['isLogin'] = false;
}
if($_SESSION['isLogin'] == false) {
    header('Location: ../View/login.html');
}else header('Location: ../Controller/sach.php');

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $result = $db->query("SELECT * FROM User where TenUser = '$username' and MatKhau = '$pass'");
    if($result->rowCount() >= 1) {
                $_SESSION['isLogin'] = true;
                header('Location: ../Controller/sach.php');
                exit;
            } else {
                $_SESSION['isLogin'] = false;
            }   
    }
?>
