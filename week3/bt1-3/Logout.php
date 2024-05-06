<?php
session_start();
if ($_SESSION["isLogin"] == false)
    header("Location: login.html");

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $_SESSION["isLogin"] = false;
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Trang Chủ</title>
</head>
<body>
    <div class="con">
        <h1 class="noti">Đăng nhập thành công </h1>
        <form action="logout.php" method="post">
            <button class="logoutBtn" type="submit">Log out</button>
        </form>
    </div>
</body>
</html>