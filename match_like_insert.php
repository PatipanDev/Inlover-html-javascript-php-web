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

$query_allowed = "SELECT * FROM tb_user WHERE user_id = '$user_id' AND user_status = 'allowed'";
$result_allowed = mysqli_query($conn, $query_allowed);
if(mysqli_num_rows($result_allowed) == 0) {
    // ถ้าไม่พบผู้ใช้ที่มีสถานะ "allowed"
    echo '<script>alert("กรุณาไปยืนยันตัวตน"); window.location.href = "information-edit.php";</script>';
    // echo '<p>กรุณาไปยืนยันตัวตนก่อนที่จะดำเนินการต่อ</p>';
    // echo '<meta http-equiv="refresh" content="2;url=information-edit.php">';
    exit();
}

// ตรวจสอบว่าคำขอเป็น HTTP POST หรือไม่
// ตรวจสอบว่ามีค่า user_id ที่ถูกส่งมาหรือไม่
if (isset($_GET['user_id'])) {
    // รับค่า user_id
    $userId = $_GET['user_id'];
    $userLikeme = $userId;
    $_SESSION['user_like_id'] = $userLikeme; //่ส่งไปที่หน้า match-like-save.php เพื่อทำการใช้บันทึกการแมช
    $sql_check_similarity = "SELECT * FROM tb_match WHERE user_me = '$user_id' AND user_like = '$userLikeme'";
    $result_sqlCheck = $conn->query($sql_check_similarity);
    if ($result_sqlCheck->num_rows > 0) {
        echo "มีข้อมูลอยู่แล้ว";
    } else {
        $sqlInsert = "INSERT INTO tb_match (user_me, user_like, status_user) VALUES ('$user_id', '$userLikeme','like')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo 'บันทึกข้อมูลเสร็จสิ้น';
        } else {
            echo 'บันทึกข้อมูลไม่ได้';
        }
    }
    echo "Received user_id: " . $userId;
} else {
    // ถ้าไม่มีค่า user_id ถูกส่งมา
    echo "No user_id received";
}

// echo $userLikeme;


$conn->close();

?>