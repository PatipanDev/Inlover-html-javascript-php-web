<?php
/////////เชื่อม like-chat-n.js
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลที่ถูกส่งมาจาก frontend
    $data = json_decode(file_get_contents("php://input"));

    // ตรวจสอบว่าข้อมูลถูกส่งมาในรูปแบบที่ต้องการหรือไม่
    if (isset($data->user_name)) {
        // $user_like = $data->user_name;

        // ทำการประมวลผลข้อมูลตามที่คุณต้องการ
        $user_name = $data->user_name;

        // ตัวอย่างการใช้ข้อมูลที่ถูกส่งมา
        $response_data = array(
            'status' => 'success',
            'message' => 'Data received successfully', 
            'user_name' => $user_name
        );
        $user_like_me = $user_name;

        // ส่งข้อมูลที่ประมวลผลแล้วกลับไปยัง frontend
        header('Content-Type: application/json');
        echo json_encode($response_data);
        
    } else {
        // กรณีไม่พบข้อมูลที่ต้องการ
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Invalid data format'));
    }
} else {
    // กรณีไม่ใช่เมธอด POST
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}

$sql_select_user_id = "SELECT user_id FROM tb_user WHERE user_name = '$user_like_me'";
$result_select_user_id = $conn->query($sql_select_user_id);

if ($result_select_user_id->num_rows > 0)  {
    // ถ้าพบข้อมูล id_user
    $row = $result_select_user_id->fetch_assoc();
    $user_match_id = $row['user_id'];
}
$_SESSION['user_match_id'] = $user_match_id;
$conn->close();
?>