<?php
// ตั้งค่าการเชื่อมต่อกับ MySQL
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

$user_like_id = $_SESSION['user_like_id'];

$sql_check_similarity = "SELECT * FROM tb_match WHERE user_me = '$user_id' AND user_like = '$user_like_id' AND status_user = 'like'";
$result_sqlCheck = $conn->query($sql_check_similarity);

if ($result_sqlCheck->num_rows > 0)  {
    // ข้อมูลมีอยู่แล้ว
    $sql_check_like_me = "SELECT * FROM tb_match WHERE user_me = '$user_like_id' AND user_like = '$user_id' AND status_user = 'like'";
    $result_sqlCheck_like_me = $conn->query($sql_check_like_me);

    if ($result_sqlCheck_like_me->num_rows > 0){
        // สร้าง array เพื่อเก็บข้อมูล
        $data1 = array();

        while($row = $result_sqlCheck_like_me->fetch_assoc()) {
            $data1[] = $row;
        }

        // ส่งข้อมูลในรูปแบบ JSON กลับไปที่ JavaScript
        echo json_encode($data1);
    }else{
        echo "ไม่พบข้อมูล";
    }
} else {
    echo "ไม่พบข้อมูล";
    // เพิ่มข้อมูลเมื่อข้อมูลยังไม่มีอยู่
    //$sqlInsert = "INSERT INTO tb_match (user_me, user_like, status_user) VALUES ('$user_id', '$user_like_id','like')";
}




$conn->close();

?>
