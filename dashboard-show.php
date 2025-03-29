<?php
session_start();
include('connectdtb.php');

// if(isset($_SESSION['user_id'])) {
    // $user_id = $_SESSION['user_id'];
// } else {
//     header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
//     // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
//     exit();
// }
// echo $user_id;
//เลือกข้อมูลคนที่ชอบ
$sql = "SELECT post_id, post_image, post_texth, post_text, post_time
        FROM admin_post";


$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($data);
?>