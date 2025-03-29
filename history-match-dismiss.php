<?php
session_start();
include('connectdtb.php');
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
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
    //คนที่ชอบเรา
    $delete_Messageyou_query = $conn->prepare("DELETE FROM tb_match WHERE user_me = ? AND user_like = ? AND status_user = 'match'");
    $delete_Messageyou_query->bind_param("ss", $userId, $user_id);
    //คนที่เราชอบ
    $delete_Message_query = $conn->prepare("DELETE FROM tb_match WHERE user_me = ? AND user_like = ? AND status_user = 'match'");
    $delete_Message_query->bind_param("ss", $user_id, $userId);
    if ($delete_Message_query->execute()&&$delete_Messageyou_query->execute()){
        echo "ลบข้อมูลแล้ว";
    } else {
        echo "ไม่มีข้อมูล";
    }
    // echo "Received user_id: " . $userId;
} else {
    echo "No user_id received";
}
$conn->close();

?>