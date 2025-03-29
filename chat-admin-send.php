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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    // echo $message;
    // $userLikeme = $userId;
    $sql_selectChat = "SELECT * FROM tb_chatmin WHERE user_id = '$user_id' AND chatmin_status = 'begin'";
    $result_selectChat = $conn->query($sql_selectChat);
    if ($result_selectChat->num_rows > 0){
        $sql_insert_Send = "INSERT INTO tb_chatmin (user_id, chatmin_status, message_send) VALUES ('$user_id', 'send', '$message')";
        if ($conn->query($sql_insert_Send) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'ส่งข้อความเรียบร้อย'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'เกิดข้อผิดพลาด: ' . $conn->error));
        }
    }else{
        $sql_insert_Begin = "INSERT INTO tb_chatmin (user_id, chatmin_status, message_send) VALUES ('$user_id', 'begin', '$message')";
        if ($conn->query($sql_insert_Begin) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'ส่งข้อความเรียบร้อย'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'เกิดข้อผิดพลาด: ' . $conn->error));
        }
    }
    // echo "Received user_id: " . $userId;
} else {
    echo "No user_id received";
}
$conn->close();

?>
