<?php
// ตั้งค่าการเชื่อมต่อกับ MySQL
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

$user_like_id = $_SESSION['user_like_id'];
//อัพเดตการแมทของ user
$sqlUpdate_sts_user = "UPDATE tb_match SET status_user = 'match', match_time = CURRENT_TIMESTAMP WHERE user_me = '$user_id' AND user_like = '$user_like_id' AND status_user = 'like'";
$sqlUpdate_sts_user_like_me = "UPDATE tb_match SET status_user = 'match', match_time = CURRENT_TIMESTAMP WHERE user_me = '$user_like_id' AND user_like = '$user_id' AND status_user = 'like'";

if ($conn->query($sqlUpdate_sts_user) === TRUE and $conn->query($sqlUpdate_sts_user_like_me) === true) {
    echo "บันทึกข้อมูลสำเร็จ";
    // exit();
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
}

$conn->close();
?>
