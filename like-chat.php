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

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Select users who have liked the current user
    $sql_check_match = "SELECT user_me FROM tb_match WHERE user_like = ? AND status_user = 'match'";
    $stmt = $conn->prepare($sql_check_match);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_sqlCheck_match = $stmt->get_result();

    if ($result_sqlCheck_match->num_rows > 0){
        $data = array();
        while($row = $result_sqlCheck_match->fetch_assoc()) {
            $user_like_me_value = $row['user_me'];

            // Select image path and user name of matching users
            $sql = "SELECT images.image_path, tb_user.user_name
                    FROM images
                    INNER JOIN tb_user ON images.user_id = tb_user.user_id WHERE tb_user.user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_like_me_value);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }
        
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}


// $sql = "SELECT images.image_path, tb_user.user_name
//         FROM images
//         INNER JOIN tb_user ON images.user_id = tb_user.user_id";
// $result = $conn->query($sql);

// $data = array();

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $data[] = $row;
//     }
// }

// $conn->close();

// header('Content-Type: application/json');
// echo json_encode($data);
// // $conn->close();
?>