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


$sql = "SELECT images.image_path, tb_user.user_name, tb_user.user_id, tb_information.gender, tb_information.age, tb_information.weight_us, tb_information.height
        FROM images
        INNER JOIN tb_user ON images.user_id = tb_user.user_id
        INNER JOIN tb_information ON tb_user.user_id = tb_information.user_id 
        WHERE tb_user.user_status ='allowed' AND tb_user.user_id NOT IN (SELECT tb_match.user_like FROM tb_match WHERE tb_match.user_me = '$user_id')";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// // ปิดการเชื่อมต่อ MySQL
$conn->close();

// ส่งข้อมูลเป็น JSON
header('Content-Type: application/json');
echo json_encode($data);

// อันแรก
// $sql_Select = "SELECT user_me FROM tb_match WHERE user_id = '$user_id'";
//เลือกแค่ผู้ใช้ที่มีการอนุมัติ
// $sql = "SELECT images.image_path, tb_user.user_name, tb_user.user_id
//         FROM images
//         INNER JOIN tb_user ON images.user_id = tb_user.user_id";

// $sql = "SELECT images.image_path, tb_user.user_name, tb_user.user_id
//         FROM images
//         INNER JOIN tb_user ON images.user_id = tb_user.user_id
//         INNER JOIN tb_information ON tb_user.user_id = tb_information.user_id 
//         WHERE tb_user.user_status ='allowed'";

// สร้างคำสั่ง SQL เพื่อเลือกข้อมูลจากตาราง images, tb_user, และ tb_information
// $sql_Select = "SELECT user_me FROM tb_match WHERE user_id = '$user_id'";

// $conn->close();
// session_start();
// include('connectdtb.php');

// if(isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id'];
// } else {
//     header("refresh:2;url=login.html");
//     exit();
// }
// // echo $user_id;
// $sql_Select = "SELECT user_me FROM tb_match WHERE user_me = '$user_id'";

// $sql = "SELECT images.image_path, tb_user.user_name, tb_user.user_id
//         FROM images
//         INNER JOIN tb_user ON images.user_id = tb_user.user_id
//         INNER JOIN tb_information ON tb_user.user_id = tb_information.user_id 
//         WHERE tb_user.user_status ='allowed'";

// // ดึงรายการไอดีที่มีใน $sql_Select
// $result_Select = $conn->query($sql_Select);
// $excluded_ids = array();
// if ($result_Select->num_rows > 0) {
//     while($row_Select = $result_Select->fetch_assoc()) {
//         $excluded_ids[] = $row_Select['user_me'];
//     }
// }

// // เพิ่มเงื่อนไข WHERE เพื่อไม่รวมไอดีที่ได้จาก $sql_Select
// if (!empty($excluded_ids)) {
//     $sql .= " AND tb_user.user_id NOT IN ('" . implode("','", $excluded_ids) . "')";
// }

// $result = $conn->query($sql);

// $data = array();

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// }

// $conn->close();

// header('Content-Type: application/json');
// echo json_encode($data);
?>
