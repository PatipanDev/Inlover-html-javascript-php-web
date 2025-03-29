<?php //เลือกรูปของบัญชีผู้ใช้มา
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

$sql = "SELECT images.image_path, tb_user.user_name
        FROM tb_user
        LEFT JOIN images ON tb_user.user_id = images.user_id
        WHERE tb_user.user_id = '$user_id'";
$result = $conn->query($sql);

$data1 = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data1[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data1);
?>