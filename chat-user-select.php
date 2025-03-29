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

// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลที่ถูกส่งมาจาก frontend
    $data = json_decode(file_get_contents("php://input"));

    // ตรวจสอบว่าข้อมูลถูกส่งมาในรูปแบบที่ต้องการหรือไม่
    if (isset($data->user_id)) {
        // $user_like = $data->user_name;

        // ทำการประมวลผลข้อมูลตามที่คุณต้องการ
        $user_id = $data->user_id;
        $_SESSION['user_contact_id'] = $user_id;
        // ตัวอย่างการใช้ข้อมูลที่ถูกส่งมา
        $response_data = array(
            'status' => 'success',
            'message' => 'Data received successfully', 
            'user_name' => $user_id
        );

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

$conn->close();

?>