<?php
include "upload.php"; // Import file upload.php để có thể sử dụng kết nối CSDL

// Kiểm tra xem phiên làm việc đã được khởi tạo chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Xóa tệp từ ổ đĩa
    $filePath = "upload/$file";
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "File $file đã được xóa thành công từ ổ đĩa.<br>";
        } else {
            echo "Lỗi: Không thể xóa tệp $file từ ổ đĩa.<br>";
        }
    } else {
        echo "Lỗi: Tệp $file không tồn tại trên ổ đĩa.<br>";
    }

    // Kiểm tra xem biến $conn đã tồn tại và có thể sử dụng được không
    if (isset($conn) && $conn !== null) {
        // Xóa thông tin tệp khỏi cơ sở dữ liệu
        $sqlDelete = "DELETE FROM Files WHERE FileName = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("s", $file);
        $stmtDelete->execute();
    } else {
        echo "Lỗi: Không thể kết nối đến cơ sở dữ liệu.<br>";
    }
}

// Chuyển hướng sau khi hoàn thành xóa
header("Location: hienthifile.php");
?>