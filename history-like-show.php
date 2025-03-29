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
// echo $user_id;
//เลือกข้อมูลคนที่ชอบ
$sql = "SELECT 
        images.image_path, 
        tb_user.user_name, 
        tb_user.user_id, 
        tb_information.first_name, 
        tb_information.last_name, 
        tb_information.gender, 
        tb_information.age, 
        tb_information.weight_us, 
        tb_information.height, 
        tb_user.user_status,
        tb_match.user_like,
        tb_match.status_user
        FROM 
        images
        LEFT JOIN tb_user ON images.user_id = tb_user.user_id
        LEFT JOIN tb_information ON tb_user.user_id = tb_information.user_id
        LEFT JOIN tb_match ON tb_user.user_id = tb_match.user_like
        WHERE 
        tb_match.user_me = '$user_id' AND tb_match.status_user = 'like'";
        // AND tb_match.status_user = 'like'
        // "SELECT user_like FROM tb_match WHERE user_me = '$user_id'"

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
