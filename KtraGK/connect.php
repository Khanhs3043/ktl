<?php
session_start();
require 'KtraGK/dbconnect.php';

if (!isset($_SESSION['isLogin'])) {
    $_SESSION['isLogin'] = false;
}
if($_SESSION['isLogin'] == false) {
    header('Location: KtraGK/Dangnhap.html');
}else header('Location: sach.php');

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $result = $db->query("SELECT * FROM User where tenUser = '$username' and MatKhau = '$pass'");
    if($result->rowCount() >= 1) {
                $_SESSION['isLogin'] = true;
                header('Location: sach.php');
                exit;
            } else {
                $_SESSION['isLogin'] = false;
            }   
    }
?>