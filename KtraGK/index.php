<?php

$uri = "mysql://avnadmin:AVNS_48P_BWZnfOzMQ-6-e5i@mysql-ea911ca-tuyenleloi239-0168.l.aivencloud.com:23298/defaultdb?ssl-mode=REQUIRED";

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
  print($stmt->fetch()[0]);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

$sql = "CREATE TABLE if not exist Sach(
  maSach varchar(100) PRIMARY KEY,
  tenSach varchar(100),
  soLuong int
)

CREATE TABLE if not exist User(
  maUser varchar(100) PRIMARY KEY,
  tenUser varchar(100),
  matkhau int
)";

$sql2 = "INSERT INTO User (maUser, tenUser, matkhau) VALUES
('K151','Nguyen A','user123'),
('K152','LeA','ad123'),
('K143','LeB','ad321'),
('K168','Bao','us231'),
('K186','Anh','admin897')
";

$sql2 = "INSERT INTO Sach (maSach, tenSach, soLuong) VALUES
('H1','Happy Life',5),
('A1','ABC',10),
('H2','Harry Potter',10),
('A2','Annavle',15),
('B1','Bookstore',10)
";

