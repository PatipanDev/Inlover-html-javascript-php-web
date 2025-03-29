<?php
include('connectdtb.php');
session_start();

if(isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

$user_Contacts = array(); // เก็บ user_id ทั้งหมดที่ตรงเงื่อนไข
$sql_check_IDuser = "SELECT user_id FROM tb_chatmin WHERE chatmin_status = 'begin'";
$result_Check_IDuser = $conn->query($sql_check_IDuser);

if ($result_Check_IDuser->num_rows > 0){
    // วนลูปเพื่อดึงข้อมูลคนที่ชอบออกมาทั้งหมด
    while($row = $result_Check_IDuser->fetch_assoc()) {
        $user_Contacts[] = $row['user_id'];
    }
    
    // ตรวจสอบว่า $user_like_me_value ไม่ใช่ค่าว่างหรือ null ก่อนที่จะทำ SQL query ต่อ
    if (!empty($user_Contacts)) {
        $user_Contacts_str = implode(',', $user_Contacts);
        //ดึงข้อมูลมาไม่สนว่าจะมีภาพหรือป่าว
        $sql = "SELECT tb_user.user_name, tb_user.user_id, images.image_path
                FROM tb_user
                LEFT JOIN images ON tb_user.user_id = images.user_id
                WHERE tb_user.user_id IN ($user_Contacts_str)";
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            $conn->close();

            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}
?>
