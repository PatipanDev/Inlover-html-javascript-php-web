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
// if(isset($_SESSION['user_id'])) {
$user_Contact = $_SESSION['user_contact_id'];
// } else {
//     header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
//     // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
//     exit();
// }

// ตรวจสอบว่ามีค่า user_id ที่ถูกส่งมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {    // รับค่า user_id
    $message = $_POST["message"];
    // echo $message;
    // $userLikeme = $userId;
    $sql_insert_Send = "INSERT INTO tb_chatmin (user_id, chatmin_status, message_send, admin_id) VALUES ('$user_Contact', 'get', '$message', '$admin_id')";
    if ($conn->query($sql_insert_Send) === TRUE) {
        echo json_encode(array('status' => 'success', 'message' => 'ส่งข้อความเรียบร้อย'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'เกิดข้อผิดพลาด: ' . $conn->error));
    }
    // echo "Received user_id: " . $userId;
} else {
    echo "No user_id received";
}
$conn->close();

?>