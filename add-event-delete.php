<?php
// session_start();
include('connectdtb.php');

// ตรวจสอบว่ามีค่า user_id ที่ถูกส่งมาหรือไม่
if (isset($_GET['post_id'])) {
    // รับค่า user_id
    $postId = $_GET['post_id'];
    $postImage = $_GET['post_image'];

    if (file_exists($postImage)) {
        // ลบไฟล์
        if (unlink($postImage)) {
            echo "ลบไฟล์ $postImage เรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาดในการลบไฟล์";
        }
    } else {
        echo "ไฟล์ $postImage ไม่พบ";
    }
    // $userLikeme = $userId;
    $sql_delete = "DELETE FROM admin_post WHERE post_id = '$postId'";
    $result_sqlCheck = $conn->query($sql_delete );
    if ($result_sqlCheck->num_rows > 0) {
        echo "มีข้อมูลอยู่แล้ว";
    } else {
        echo "ไม่มีข้อมูล";
    }
    // echo "Received user_id: " . $userId;
} else {
    echo "No user_id received";
}
$conn->close();

?>