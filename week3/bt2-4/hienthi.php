<?php
session_start();
$uploadDirectory = "upload/";


if (is_dir($uploadDirectory)) {
    
    $files = scandir($uploadDirectory);

   
    $files = array_diff($files, array('.', '..'));

    
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        
        
        $currentSort = isset($_SESSION['sort']) ? $_SESSION['sort'] : '';

        
        $nextSort = ($currentSort == $sort && isset($_SESSION['order']) && $_SESSION['order'] == 'asc') ? 'desc' : 'asc';
        
        // Lưu trạng thái sắp xếp tiếp theo vào session
        $_SESSION['sort'] = $sort;
        $_SESSION['order'] = $nextSort;

        switch ($sort) {
            case 'name':
                sort($files);
                break;
            case 'date':
                usort($files, function($a, $b) use ($uploadDirectory) {
                    return filemtime($uploadDirectory . $b) - filemtime($uploadDirectory . $a);
                });
                break;
            case 'size':
                usort($files, function($a, $b) use ($uploadDirectory) {
                    return filesize($uploadDirectory . $b) - filesize($uploadDirectory . $a);
                });
                break;
        }

        if ($nextSort == 'desc') {
            $files = array_reverse($files);
        }
    }

    
    echo "<table border='1'>
            <tr>
                <th><a href='?sort=name'>Tên tệp</a></th>
                <th>Loại</th>
                <th><a href='?sort=date'>Ngày tải lên</a></th>
                <th><a href='?sort=size'>Kích thước</a></th>
                <th><a>Xóa</a></th>
            </tr>";

    foreach ($files as $file) {
        $filePath = $uploadDirectory . $file;
        $fileType = mime_content_type($filePath);
        $fileSize = filesize($filePath);
        $fileDate = date("d-m-Y H:i:s", filemtime($filePath));

        echo "<tr>";
        echo "<td>$file</td>";
        echo "<td>$fileType</td>";
        echo "<td>$fileDate</td>";
        echo "<td>$fileSize bytes</td>";
        echo "<td><a href='delete.php?file=$file'>Xóa</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Thư mục upload không tồn tại hoặc không thể truy cập.";
}


?>
<style>
    table{
        width: 70%;
        background-color: while;
        color: black;
    }
    tr{
        height: 30px;
    }
</style>