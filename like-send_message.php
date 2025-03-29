<?php
//ประกาศที่ like-chat.html
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

$user_match_id = $_SESSION['user_match_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    if ($user_match_id == null){
        echo "กรุณาเลือกผู้ใช้";
    }else{
        $sql = "INSERT INTO chat_messages (user_id_me, user_like_you, message_send) VALUES ('$user_id', '$user_match_id', '$message')";
    }
    

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
