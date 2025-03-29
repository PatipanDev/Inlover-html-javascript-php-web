<?php
$server = "localhost";
$user = "root";
$pass = "popo1234";
$dbname = "inlover";

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($server, $user, $pass, $dbname);

// ตรวจสอบการเชื่อมต่อว่าได้หรือไม่
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้กรุณาตรวจสอบใหม่: " . $conn->connect_error);
}
?>