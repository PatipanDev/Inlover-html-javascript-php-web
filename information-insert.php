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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $sql_check = "SELECT * FROM tb_information WHERE user_id = $user_id";
    // $result = $conn->query($sql_check);
    // if ($result->num_rows > 0) {
        //เอามาจากฟอร์ม
    $firstname = $_POST["firstname_f"];
    $lastname = $_POST["lastname_f"];
    $gender1 = $_POST["gender_f"];
    $age1 = $_POST["age_f"];
    $weight1 = $_POST["weight_f"];
    $height1 = $_POST["height_f"];

    // $sql = "UPDATE tb_information SET first_name ='$firstname', last_name='$lastname', gender='$gender1', weight_us='$weight1', height='$height1' WHERE user_id= $user_id";
    $sql = "INSERT INTO tb_information (user_id, first_name, last_name, gender, age, weight_us, height) VALUES ('$user_id','$firstname', '$lastname', '$gender1', '$age1', '$weight1', '$height1')";

    if ($conn->query($sql) === TRUE) {
        echo "บันทึกข้อมูลสำเร็จ";
        echo '<script>alert("ส่งข้อมูลการยืนยันตัวตนเรียบร้อย"); window.location.href = "information-edit.php";</script>';
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
    // }
    
}

$conn->close();
?>