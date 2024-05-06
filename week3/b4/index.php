<?php
    $uploadDir = "upload/"; 
    $uploadMaxSize = 2097152; 
    $files = scandir($uploadDir);

    //mã hóa tên file
    function generateFileName($filename) {
        $uniqueID = uniqid(); // Tạo ID duy nhất
        $extension = pathinfo($filename, PATHINFO_EXTENSION); // Lấy phần mở rộng của file
        return $uniqueID . "_" . sha1($uniqueID) . "." . $extension; // Mã hóa ID và thêm phần mở rộng
    }

    if(isset($_POST["submit"])) {
        if(isset($_FILES['file'])) {
            // Kiểm tra kích thước file
            if($_FILES["file"]["size"] > $uploadMaxSize) {
                echo "<p class = 'noti'>Kích thước file quá lớn. Vui lòng chọn file có kích thước nhỏ hơn " . $uploadMaxSize . " bytes!</p>";
            } else {
                    $newFileName = generateFileName($_FILES["file"]["name"]);
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDir . $newFileName)) {
                        echo "<p class = 'noti'>Tải tệp thành công!</p>";
                    } else {
                        echo "<p class = 'noti'>Vui lòng chọn tệp để tải lên!</p>";
                    }
            }
        }
        
    }

    // Chức năng xoá file
    if(isset($_GET["link"])) {
        $filePath = $_GET["link"];
        if(file_exists($filePath)) {
            unlink($filePath); 
            echo "<p class = 'noti'>xoá file thành công!</p>";
        } else {
            echo "<p class = 'noti'>Không tìm thấy file cần xoá!</p>";
        }
    }
?>

<?php
    //thông tin chi tiết các tệp
    $uploadDir = "upload/";
    $files = scandir($uploadDir);

    $sortType = isset($_GET['sort']) ? $_GET['sort'] : 'name';
    $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

    if($sortType == 'name') {
        if($sortOrder == 'asc') {
            natcasesort($files); // tăng dần
        } else {
            natcasesort($files);
            $files = array_reverse($files); // giảm dần
        }
    } elseif($sortType == 'date') {
        if($sortOrder == 'asc') {
            usort($files, function($a, $b) use ($uploadDir) {
                return filemtime($uploadDir . $a) - filemtime($uploadDir . $b); // tăng dần
            });
        } else {
            usort($files, function($a, $b) use ($uploadDir) {
                return filemtime($uploadDir . $b) - filemtime($uploadDir . $a); // giảm dần
            });
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File Upload</title>
</head>
<body>
    <h2 class="title">Upload File</h2>
    <form action="index.php" method="post" enctype="multipart/form-data" class = "upload">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
    </form>

    <h2 class="title">Uploaded Files</h2>
    <table class="tbl" border =1>
        <tr>
            <th><a href="index.php?sort=name&order=<?php echo ($sortType == 'name' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Tên tệp</a></th>
            <th>Loại tệp</th>
            <th><a href="index.php?sort=date&order=<?php echo ($sortType == 'date' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Ngày tải lên</a></th>
            <th>Kích thước</th>
            <th>Action</th>
        </tr>
        <?php foreach ($files as $file) : ?>
            <?php if ($file != '.' && $file != '..') : ?>
                <tr>
                    <td><?php echo $file; ?></td>
                    <td><?php echo mime_content_type("upload/$file"); ?> bytes</td>
                    <td><?php echo date("Y-m-d H:i:s", filemtime($uploadDir . $file)); ?></td>
                    <td><?php echo filesize($uploadDir . $file); ?> bytes</td>
                    <td><a href="index.php?link=<?php echo $uploadDir . $file ?>">Delete</a></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>
