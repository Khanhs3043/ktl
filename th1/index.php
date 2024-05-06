<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay username bằng tên người dùng của bạn
$password = ""; // Thay password bằng mật khẩu của bạn
$database = "pka_s"; // Thay ten_csdl bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
die("Kết nối không thành công: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ cơ sở dữ liệu
$sql = "SELECT SinhVien.MSSV, SinhVien.HoTen, MonHoc.TenMH, DangKy.Ky
FROM SinhVien
INNER JOIN DangKy ON SinhVien.MSSV = DangKy.MSSV
INNER JOIN MonHoc ON DangKy.MaMH = MonHoc.MaMH";
$result = $conn->query($sql);

// Kiểm tra và hiển thị dữ liệu
if ($result->num_rows > 0) {
// Hiển thị tiêu đề
echo "<h2 style='text-align: center;'>Danh Sách Đăng Ký Học</h2>";

// Hiển thị bảng
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

// Đóng kết nối
$conn->close();
?>