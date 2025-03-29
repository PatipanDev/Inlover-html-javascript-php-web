<?php
// session_start();
include('connectdtb.php');

$userId = $_GET['userId']; // รับ user_id
$firstName = $_GET['firstName']; // รับข้อความใหม่จาก textarea ที่มีชื่อว่า "text"
$lastName = $_GET['lastName'];
$userName = $_GET['userName']; // รับข้อความใหม่จาก textarea ที่มีชื่อว่า "texth"
$userPasswd = $_GET['userPasswd']; 

$sql_update_user = "UPDATE tb_user SET user_name = '$userName', user_passwd = '$userPasswd' WHERE user_id = '$userId'";
$conn->query($sql_update_user);

// สร้างคำสั่ง SQL เพื่อบันทึกข้อมูลใหม่ลงในตารางของคุณ
$sql = "UPDATE tb_user AS u
        JOIN tb_information AS i ON u.user_id = i.user_id
        SET 
            u.user_name = '$userName', 
            u.user_passwd = '$userPasswd',
            i.first_name = '$firstName', 
            i.last_name = '$lastName'
        WHERE u.user_id = $userId";

// IF('$userName' = '', u.user_name, '$userName') เป็นการใช้ฟังก์ชัน IF() เพื่อตรวจสอบว่า $userName มีค่าว่างหรือไม่ หากมีค่าว่างจะใช้ค่าปัจจุบันของ u.user_name แทน
// เช่นเดียวกันกับคอลัมน์อื่นๆ เช่น u.user_passwd, i.first_name, และ i.last_name จะใช้เงื่อนไขเดียวกันเพื่อตรวจสอบค่าว่างและกำหนดค่าให้เท่ากับค่าปัจจุบันหากมีค่าว่าง
// ส่วน WHERE u.user_id = $userId จะใช้เงื่อนไขเดิมเพื่อระบุข้อมูลสำหรับผู้ใช้นั้นๆ ตาม user_id ที่กำหนด
// ทำการทำงานคำสั่ง SQL
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>