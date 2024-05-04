<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "stumana";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

$sql = "SELECT students.id, students.name AS student_name, subjects.name AS subject_name, registrations.semester
FROM students
JOIN registrations ON students.id = registrations.studentId
JOIN subjects ON registrations.subjectId = subjects.id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả đăng ký</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            font-family: arial;
            font-size: 20px;
            padding: 10px;
            text-align: left;
        }

        th {
            
            background-color: #f2f2f7;
        }

        tr:nth-child(even) {
            background-color: white;
        }
        .tb{
            width: 1000px;
            margin: auto;
            padding: 0px 20px;
        }
        .title{
            width: fit-content;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="title" ><h1 style = "font-family: arial; color: #5c85b3">Kết quả đăng ký</h1></div>
    <table>
    <div class = 'tb'><table border='1'>
            <tr>
                <th>MSSV</th>
                <th>Họ Tên</th>
                <th>Kỳ</th>
                <th>Đăng ký</th>
            </tr>
    <?php 
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["student_name"] . "</td>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["subject_name"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Không có dữ liệu";
    }

    $conn->close();
    ?>
    </table>
</body>
</html>
