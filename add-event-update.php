<?php
// session_start();
include('connectdtb.php');

$postId = $_GET['post_id']; // รับ user_id
$newText = $_GET['new_text']; // รับข้อความใหม่จาก textarea ที่มีชื่อว่า "text"
$newTexth = $_GET['new_texth']; // รับข้อความใหม่จาก textarea ที่มีชื่อว่า "texth"

// สร้างคำสั่ง SQL เพื่อบันทึกข้อมูลใหม่ลงในตารางของคุณ
$sql = "UPDATE admin_post SET post_texth = '$newTexth', post_text = '$newText' WHERE post_id = '$postId'";

// ทำการทำงานคำสั่ง SQL
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>