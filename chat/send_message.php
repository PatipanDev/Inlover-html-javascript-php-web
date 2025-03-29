<?php
include "connect-chat.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    $user_id = 1; // คุณต้องกำหนด user_id ตามที่คุณใช้ในระบบของคุณ

    $sql = "INSERT INTO chat_messages (user_id, message1) VALUES ('$user_id', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
