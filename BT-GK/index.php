<?php
$pass = getenv('aivenPass');
$uri = "mysql://avnadmin:************************@mysql-194d946b-st-7691.l.aivencloud.com:14971/defaultdb?ssl-mode=REQUIRED";

$fields = parse_url($uri);

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
// ('S0001','Tieng Nhat',15),
// ('S0002','Giai Tich',20),
// ('S0003','Ky Thuat So',30),
// ('S0004','PLDC',25),
// ('S0005','Tieng Anh',35)";

//$result  =  $db->query($sql2);

// $sql2= "insert into User(MaUser,TenUser,MatKhau) values 
// ('21011111','Linh','123456'),
// ('21011234','Lan','234567'),
// ('21012468','Hung','345678'),
// ('21013689','Lien','567890'),
// ('21015678','Khanh','236890')";

// $result  =  $db->query($sql2);

?>