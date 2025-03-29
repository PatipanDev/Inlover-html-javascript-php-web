<?php
// session_start();
include('connectdtb.php');

// ตรวจสอบว่ามีค่า user_id ที่ถูกส่งมาหรือไม่
if (isset($_GET['user_id'])) {
    // รับค่า user_id
    $userId = $_GET['user_id'];
    $postImage = $_GET['imgUser'];

    // $userLikeme = $userId;
    $delete_Message_query = "DELETE FROM chat_messages WHERE user_id_me = '$userId' OR user_like_you = '$userId'";
    $conn->query($delete_Message_query);

    $delete_Chatmin_query = "DELETE FROM tb_chatmin WHERE user_id = '$userId'";
    $conn->query($delete_Chatmin_query);

    $delete_Match_query = "DELETE FROM tb_match WHERE user_me = '$userId' OR user_like = '$userId'";
    $conn->query($delete_Match_query);

    $delete_Information_query = "DELETE FROM tb_information WHERE user_id = '$userId'";
    $conn->query($delete_Information_query);

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

    $delete_imgUser_query = "DELETE FROM images WHERE user_id = '$userId'";
    $conn->query($delete_imgUser_query);

    $delete_User_query = "DELETE FROM tb_user WHERE user_id = '$userId'";
    $conn->query($delete_User_query);

    echo "ลบข้อมูลหมดแล้ว";
}
$conn->close();

?>