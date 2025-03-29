<?php
// ตรวจสอบว่ามีข้อมูลถูกส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // ตรวจสอบว่ามี key 'user_name' ในข้อมูลหรือไม่
    if (isset($data['user_name'])) {
        $user_name = $data['user_name'];

        // ทำสิ่งที่คุณต้องการกับ $user_name
        // ตัวอย่าง: บันทึกข้อมูลลงในฐานข้อมูล
        // ...

        // ส่ง response กลับไป (ถ้าต้องการ)
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Missing user_name']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
