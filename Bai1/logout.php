<?php
session_start();
if ($_SESSION["IsLogin"] == false)
    header("Location: login.html");

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $_SESSION["IsLogin"] = false;
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="w2-b1.css">
    <title>Homepage</title>
</head>
<body>
    <div class="out">
        <h1 class="ii">Đăng nhập thành công !</h1>
        <form action="logout.php" method="post">
            <button class="logoutbt" type="submit">Log out</button>
        </form>
    </div>
</body>
</html>


