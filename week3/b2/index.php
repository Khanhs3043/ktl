<?php
    $files = scandir("upload/");
    $noti = "";   
    $dir = "upload/"; 
    $sortBySize = true;
    $buttonName = "Sort by size";
    $fileList = $files;
                function compareBySize($a, $b) {
                    return filesize("upload/$a") - filesize("upload/$b");
                }
                           
                usort($fileList, 'compareBySize');
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["sort"])) {
                        $sortBySize = !$sortBySize;

                    }
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Upload file</title>
</head>
<body>
    <form action="index.php" class="upload" method="post" enctype="multipart/form-data">
        <input class="upIn" type="file" name="myfile">
        <button class="upBtn" >Browse</button> 
    </form>
    <?php
        if(isset($_FILES['myfile']['name']) && $_FILES['myfile']['name'] != "") {
            $fileupload = $dir . $_FILES['myfile']['name']; 
            if(move_uploaded_file($_FILES['myfile']['tmp_name'], $fileupload)) {
                $noti = "Upload file thành công!";
            } else {
                $noti = "Upload file không thành công!";
            }
        } else {
            $noti = "Vui lòng chọn file để upload!";
        }
    ?>
    <div class="sp">
        <span><?php echo $noti?>     <br> 
        <form action="index.php" class="sortType" method="post">
        <button type="submit" class="sort" name="sort">
            <?php echo $sortBySize ? 'sortBySize' : 'sortByName'; ?>
        </button>
    
        </form>
    </span></div>
        <table class="tbl" border="1">
            <tr>
                <th>No</th>
                <th>Filename</th>
                <th>Type</th>
                <th>Upload time</th>
                <th>Size (bytes)</th>
            </tr> 
            <?php 
                
                $no = 0;
                foreach ($fileList as $file) {
                    
                    if ($file != '.' && $file != '..') {
                        $no ++;
                        $fileName = $file;
                        $fileType = mime_content_type("upload/$file");
                        $fileSize = filesize("upload/$file");
                        $uploadDate = date("Y-m-d H:i:s", filemtime("upload/$file"));
                        echo "<tr>
                        <td>$no</td>
                        <td>$fileName</td>
                        <td>$fileType</td>
                        <td>$uploadDate</td>
                        <td>$fileSize </td>
                    </tr> ";
                    }
                }
            ?>
        </table>
   
</body>
</html>
