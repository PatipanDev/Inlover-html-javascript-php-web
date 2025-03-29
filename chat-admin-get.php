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

$sql = "SELECT message_send, chatmin_time, chatmin_status
        FROM tb_chatmin 
        WHERE user_id = '$user_id' AND chatmin_status = 'send'
        UNION
        SELECT message_send, chatmin_time, chatmin_status
        FROM tb_chatmin 
        WHERE user_id = '$user_id' AND chatmin_status = 'get'
        UNION
        SELECT message_send, chatmin_time, chatmin_status
        FROM tb_chatmin 
        WHERE user_id = '$user_id' AND chatmin_status = 'begin'
        ORDER BY chatmin_time DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // สร้าง array เพื่อเก็บข้อมูล
    $messages = array();

    // วนลูปเพื่อดึงข้อมูลและเก็บใน array
    while($row = $result->fetch_assoc()) {
        $messages[] = array(
            'timestamp' => $row['chatmin_time'],
            'message_send' => $row['message_send'],
            // 'sender' => ($row['chatmin_status'] == 'send') ? 'me' : 'them'
            'sender' => ($row['chatmin_status'] == 'send' or $row['chatmin_status'] == 'begin') ? 'me' : 'them'
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

