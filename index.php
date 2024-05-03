<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "pnk_s"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

$sql = "SELECT sinhvien.MSSV, sinhvien.HoTen, monhoc.TenMH, dangky.Ky
        FROM sinhvien
        INNER JOIN dangky ON sinhvien.MSSV = dangky.MSSV
        INNER JOIN monhoc ON dangky.MaMH = monhoc.MaMH";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<h2 style='text-align: center;'>Danh Sách Đăng Ký Học</h2>";
    
    
    echo "<table border='1' align='center' style='width: 80%; height: 15%; text-align: center'>
            <tr>
                <th style='width: 15%;'>MSSV</th>
                <th style='width: 35%;'>Họ và tên</th>
                <th style='width: 35%;'>Tên môn học</th>
                <th style='width: 15%;'>Kỳ</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["MSSV"]."</td>
                <td>".$row["HoTen"]."</td>
                <td>".$row["TenMH"]."</td>
                <td>".$row["Ky"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu";
}

$conn->close();
?>
