<?php
// การเชื่อมต่อกับ MySQL Database
include('connectdtb.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    // รับข้อมูลจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql_check_tb_user = "SELECT * FROM tb_user WHERE user_name = '$username' OR user_email = '$email'";
    $result_sqlCheck = $conn->query($sql_check_tb_user);

    if ($result_sqlCheck->num_rows > 0)  {
        // ข้อมูลมีอยู่แล้ว
        echo "มีบัญชีอยู่แล้ว";
    } else {

        // เขียนคำสั่ง SQL เพื่อบันทึกข้อมูล
        $sql = "INSERT INTO tb_user (user_name, user_passwd, user_email) VALUES ('$username', '$password', '$email')";

        // ประมวลผลคำสั่ง SQL
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("สมัครบัญชีเสร็จเรียบร้อย"); window.location.href = "login.html";</script>';
        } else {
            echo '<script>alert("ไม่สามารถสมัครบัญชีได้"); window.location.href = "register.html";</script>';
        }
    }
    
}else{
    echo '<script>alert("กรุณากรอกข้อมูลให้ครบ"); window.location.href = "register.html";</script>';
}
// ปิดการเชื่อมต่อ MySQL
$conn->close();
?>
