<?php
session_start();
include('connectdtb.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // require_once ('config.php');
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // ตรวจสอบว่า "admin" อยู่ในชื่อผู้ใช้หรือไม่
//     if (strpos($username, 'admin') !== false) {
//         // ตรวจสอบข้อมูลในฐานข้อมูล
//         $sql = "SELECT user_id FROM tb_user WHERE user_name='$username' AND user_passwd='$password'";
//         $result = $conn->query($sql);

//         if ($result->num_rows == 1) {
//             // ล็อกอินสำเร็จ
//             $row = $result->fetch_assoc();
//             $_SESSION['user_id'] = $row['user_id'];
//             header('Location: dashboard.php');
//             exit;
//         } else {
//             // ล็อกอินไม่สำเร็จ
//             echo 'Invalid username or password';
//         }
//     } else {
//         // ถ้าไม่มี "admin" ในชื่อผู้ใช้
//         echo 'You are not authorized to access this page.';
//     }
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_user = "SELECT user_id FROM tb_user WHERE user_name='$username' AND user_passwd='$password'";
    $result_user = $conn->query($sql_user);
    $sql_admin = "SELECT admin_id FROM tb_admin WHERE admin_namelog = '$username' AND admin_passwd='$password'";
    $result_admin = $conn->query($sql_admin);

    if ($result_user->num_rows == 1) {
        // ล็อกอินสำเร็จ
        $row = $result_user->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        echo '<script>alert("เข้าสู่ระบบเรียบร้อย"); localStorage.setItem("isLoggedIn", "true"); window.location.href = "dashboard.html";</script>';
    } else if ($result_admin->num_rows == 1) {
        // ล็อกอินไม่สำเร็จ
        $row = $result_admin->fetch_assoc();
        $_SESSION['admin_id'] = $row['admin_id'];
        // header('Location: control.html');
        echo '<script>alert("เข้าสู่ระบบเรียบร้อย"); localStorage.setItem("isLoggedIn", "true"); window.location.href = "add-event.html";</script>';
    }else{
        echo '<script>alert("รหัสผ่านไม่ถูกต้อง"); window.location.href = "login.html";</script>';
    }
}
// if(isset($_SESSION['user_id']) or $_SESSION['admin_id']) {
//     $user_id = $_SESSION['user_id'];
//     $admin_id = $_SESSION['admin_id'];
// } else {
//     header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
//     // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
//     exit();
// }

// ปิดการเชื่อมต่อ MySQL
$conn->close();
?>
