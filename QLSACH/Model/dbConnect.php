<?php
$pass = getenv('aivenPass');
$uri = "mysql://avnadmin:$pass@mysql-001-xuankhanh3043-p1.h.aivencloud.com:13807/quanlysach?ssl-mode=REQUIRED";

$fields = parse_url($uri);

// build the DSN including SSL settings
$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];;
$conn .= ";dbname=QUANLYSACH";
$conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

try {
  $db = new PDO($conn, $fields["user"], $fields["pass"]);

  $stmt = $db->query("SELECT VERSION()");
  //print($stmt->fetch()[0]);
} catch (Exception $e) {
  //echo "Error: " . $e->getMessage();
}

$sql = "create table if not exists Sach(
  MaSach varchar(20) primary key,
  TenSach varchar(100) ,
  SoLuong int
);
create table if not exists User(
  MaUser varchar(50) primary key,
  TenUser varchar(100),
  MatKhau varchar(100)
)
";

// $sql2= "insert into Sach(MaSach,TenSach,SoLuong) values 
// ('S0001','Tieng Anh 1',30),
// ('S0002','Harry Potter 1',20),
// ('S0003','Giải tích 1',22),
// ('S0004','Triết Học',25),
// ('S0005','Chạng Vạng',77)";

//$result  =  $db->query($sql2);

// $sql2= "insert into User(MaUser,TenUser,MatKhau) values 
// ('U0001','Khanh','123456'),
// ('U0002','Xuan','111111'),
// ('U0003','Thy','230813'),
// ('U0004','Phuong','110898'),
// ('U0005','Havy','44444')";

// $result  =  $db->query($sql2);

?>