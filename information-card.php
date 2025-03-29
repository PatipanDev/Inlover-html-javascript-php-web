<?php
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}
// $sql = "SELECT user_id, image_path FROM images WHERE user_id = $user_id";
$sql = "SELECT images.image_path, tb_user.user_name
        FROM images
        INNER JOIN tb_user ON images.user_id = tb_user.user_id WHERE tb_user.user_id = $user_id";
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
