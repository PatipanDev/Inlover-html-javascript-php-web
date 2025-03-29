<?php
session_start();    
include('connectdtb.php');
// ตรวจสอบว่ามีเซสชันที่กำลังใช้งานหรือไม่
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])){
    echo '<script>
            if(confirm("คุณต้องการออกจากระบบหรือไม่")) {
                window.location.href = "logout-true.php";
            } else {
                window.history.back();
            }
        </script>';
} else {    
    // ถ้าไม่มีเซสชันที่กำลังใช้งานอยู่ ให้เดินทางกลับไปหน้าหลักโดยตรง
    header('Location: login.html');
}
    // เริ่มต้นเซสชัน
?>
