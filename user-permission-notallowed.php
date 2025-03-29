<?php
session_start();
include('connectdtb.php');

if(isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}
// ตรวจสอบว่ามีค่า user_id ที่ถูกส่งมาหรือไม่
if (isset($_GET['user_id'])) {
    // รับค่า user_id
    $userId = $_GET['user_id'];
    // $userLikeme = $userId;
    $sql_update_status = "UPDATE tb_user SET user_status = 'notallowed' WHERE user_id = '$userId'";
    $result_sqlCheck = $conn->query($sql_update_status);
    if ($result_sqlCheck->num_rows > 0) {
        echo "มีข้อมูลอยู่แล้ว";
    } else {
        echo "ไม่มีข้อมูล";
    }
    // echo "Received user_id: " . $userId;
} else {
    echo "No user_id received";
}
$conn->close();

?>