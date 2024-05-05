<?php 
    session_start();
    $_SESSION['isLogin'] == false;
    $noti = "";
    if($_SESSION['isLogin'] == false) 
        header('Location: login.html');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['username']=='khanh' && $_POST['password']==='123456')
        {   
            $_SESSION['isLogin'] = true;
            $noti = "Đăng nhập thành công";
        } else {
            header('Location: login.html');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Homepage</title>
</head>
<body>
    <div class="con">
        <h1 class="noti"><?php echo $noti?> !</h1>
        <form action="logout.php" method="post">
            <button class="logoutBtn" type="submit">Log out</button>
        </form>
    </div>
</body>
</html>
