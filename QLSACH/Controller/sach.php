<?php
session_start();
if($_SESSION['isLogin'] == false) {
    header('Location: ../View/login.html');
    exit;
}
require '../Model/dbConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sach</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <p class="title title1">Danh sách</p>
    <table class="tbl" border =1>
        <tr>
            <th>Mã sách</th>
            <th>Tên sách</th>
            <th>Số lượng</th>
        </tr>
       
         
        <?php  $sql = "select * from Sach";
            $result = $db->query($sql);?>
            <?php if($result->rowCount()>0): ?>
                <?php while($row = $result->fetch()): ?>
                    <tr>
                        <td><?php echo$row['MaSach'] ?></td>
                        <td><?php echo$row['TenSach'] ?></td>
                        <td><?php echo$row['SoLuong'] ?></td>
                    </tr>  
                <?php  endwhile; ?> 
            <?php  endif; ?>
            
    </table>
</body>
</html>