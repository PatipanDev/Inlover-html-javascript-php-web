<?php
include('connectdtb.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}

// ตรวจสอบว่ามีการส่งข้อมูลภาพมาหรือไม่
if(isset($_POST["upload"])) {
    $file = $_FILES["image"];

    // ตรวจสอบว่ามีข้อผิดพลาดในการอัพโหลดหรือไม่
    if($file["error"] === UPLOAD_ERR_OK) {

        $user_id = $_SESSION['user_id']; //ดึงมาจาก session
        $sql = "SELECT * FROM images WHERE user_id = $user_id";
        $result = $conn->query($sql);   

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo 'มีรูปอยู่แล้ว';

            // กำหนดที่อยู่ของรูปเดิม
            $oldImagePath = "uploads/" . $row["image_path"];

            // ลบรูปเดิม
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
                echo "ลบรูปเดิมเรียบร้อยแล้ว";
            } else {
                echo "ไม่พบรูปเดิม";
            }

            // กำหนดที่เก็บภาพใหม่
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);

            // ย้ายไฟล์ภาพไปยังที่เก็บ
            move_uploaded_file($file["tmp_name"], $targetFile);

            // ถ้าไม่มีภาพ
            $imageName = basename($file["name"]);

            // อัพเดตข้อมูลในฐานข้อมูล
            $sql = "UPDATE images SET image_path ='$imageName' WHERE user_id = $user_id";

            if ($conn->query($sql) === TRUE) {
                echo "บันทึกข้อมูลสำเร็จการอัพเดต";
                echo '<script>alert("อัพโหลดภาพโปรไฟล์เรียบร้อย"); window.location.href = "information.html";</script>';
                exit();
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
            }
        } else {
            //ถ้าไม่มีภาพ
            // กำหนดที่เก็บภาพ
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);

            // ย้ายไฟล์ภาพไปยังที่เก็บ
            move_uploaded_file($file["tmp_name"], $targetFile);
            //ถ้าไม่มีภาพ
            $imageName = basename($file["name"]);
            $sql = "INSERT INTO images (user_id,image_path) VALUES ('$user_id','$imageName')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("อัพโหลดภาพโปรไฟล์เรียบร้อย"); window.location.href = "information.html";</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    } else {
        echo '<script>
                alert("กรุณาเลือกรูปภาพ");
                setTimeout(function(){
                    window.history.back();
                }, 1000);
            </script>';

        // echo '<script>setTimeout(function() { window.history.back();}, 0); alert("กรุณาเลือกรูปภาพ");  </script>';
    }
}

$conn->close();
?>
