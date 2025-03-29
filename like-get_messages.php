<?php
session_start();
include('connectdtb.php');


if(isset($_SESSION['user_id']) && isset($_SESSION['user_match_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_match_id = $_SESSION['user_match_id'];
} else {
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    exit();
}

$sql = "SELECT message_send, time_chat, user_id_me
        FROM chat_messages 
        WHERE user_id_me = '$user_id' AND user_like_you = '$user_match_id'
        UNION
        SELECT message_send, time_chat, user_id_me
        FROM chat_messages 
        WHERE user_like_you = '$user_id' AND user_id_me = '$user_match_id'
        ORDER BY time_chat DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // สร้าง array เพื่อเก็บข้อมูล
    $messages = array();

    // วนลูปเพื่อดึงข้อมูลและเก็บใน array
    while($row = $result->fetch_assoc()) {
        $messages[] = array(
            'timestamp' => $row['time_chat'],
            'message_send' => $row['message_send'],
            'sender' => ($row['user_id_me'] == $user_id) ? 'me' : 'them'
        );
    }

    // แปลง array เป็น JSON
    $json_data = json_encode($messages);

    // ส่ง JSON กลับไปยัง JavaScript
    echo $json_data;
} else {
    echo json_encode(array('message' => 'ไม่พบข้อมูล'));
}

// ปิดการเชื่อมต่อ MySQL
$conn->close();
?>

