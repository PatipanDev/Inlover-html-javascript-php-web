<?php
include('connectdtb.php');

session_start();

$user_id = $_SESSION['user_id']; //ดึงมาจาก session
//เลือกคนที่ชอบมา
$sql = "SELECT user_like FROM tb_match WHERE user_me = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row1 = $result->fetch_assoc()) {
        echo "ฉัน: " . $row1["user_like"]."";
        }
    $row_like = $result->fetch_assoc();
	$user_like = $row_like["user_like"];
    //ตรวจสอบคนที่ชอบว่าชอบเราไหม
    $sql_user_like = "SELECT user_me FROM tb_match WHERE user_like = $user_like";
    $result_like_me = $conn->query($sql_user_like);
    $row_like_me = $result_like_me->fetch_assoc();
    $user_like_me = $row_like_me["user_like"];
    

    // while($row_like_me = $result_like_me->fetch_assoc()) {
    //     echo "ฉัน: " . $row_like_me["user_me"]. "  เพื่อน: " . $row["user_like"]. "<br>";
    // }
} else {
    echo "0 results";
}
// ปิดการเชื่อมต่อ
$conn->close();
