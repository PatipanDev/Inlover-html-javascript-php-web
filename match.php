<?php
session_start();
include('connectdtb.php');

$user_like_name = $_SESSION['user_like_name'];

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

echo $user_id;
echo $user_like_name;


$sql_select_user_id = "SELECT user_id FROM tb_user WHERE user_name = '$user_like_name'";
$result_select_user_id = $conn->query($sql_select_user_id);

if ($result_select_user_id->num_rows > 0)  {
    $row = $result_select_user_id->fetch_assoc();
    $user_like_id = $row['user_id'];
    echo $user_like_id;
    $_SESSION['user_like_id'] = $user_like_id;
    $sql_check_similarity = "SELECT * FROM tb_match WHERE user_me = '$user_id' AND user_like = '$user_like_id'";
    $result_sqlCheck = $conn->query($sql_check_similarity);
    if ($result_sqlCheck->num_rows > 0) {
        $sqlUpdate = "UPDATE tb_match SET status_user = 'like' WHERE user_me = '$user_id' AND user_like = '$user_like_id'";
        $conn->query($sqlUpdate);  
        $result = $conn->query($sqlUpdate);;
        if (!$result) {
            die('Error: ' . $conn->error);
        } 
        echo"บันทึกข้อมูลแล้ว";
    }else{
        $sqlInsert = "INSERT INTO tb_match (user_me, user_like, status_user) VALUES ('$user_id', '$user_like_id','like')";
        $result = $conn->query($sqlInsert);
        if (!$result) {
            die('Error: ' . $conn->error);
        }
        echo "เพิ่มข้อมูลเสร็จสิ้น";
    }
}else{
    echo "ไม่มีข้อมูลเลย";
}

$conn->close(); 
?>