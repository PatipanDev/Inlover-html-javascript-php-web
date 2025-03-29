<?php
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("refresh:2;url=login.html"); // Redirect หลังจาก 2 วินาที
    // กระโดดไปยังหน้า login หรือทำอย่างอื่นตามที่คุณต้องการ
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Heart animation and Sidebar Menu</title>
    <link rel="stylesheet" href="styles-head.css">
</head>
<body>
    <!-- Sidebar Menu -->
    <div class="sidebar">
        <a href="information.html">
        <div class="profile">
            <!-- Change the src to the URL of the person icon -->
            <ion-icon name="person-outline"></ion-icon>
        </div>
        </a>
        <ul class="menu">
            <span>Analytics</span>
            <li>
                <a href="dashboard.php">
                    <ion-icon name="home-outline"></ion-icon>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="notifications.html">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <p>Notifications</p>
                </a>
            </li>
            <li class="likes">
                <a href="find-partner.html">
                    <ion-icon name="heart-outline"></ion-icon>
                    <p>Likes</p>
                </a>
            </li>
            <li class="likes">
                <a href="like-chat.html">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    <p>Chat</p>
                </a>
            </li>
            <li class="switch-theme">
                <a href="#">
                    <ion-icon name="moon-outline"></ion-icon>
                    <p>Dark Mode</p>
                    <button>
                        <div class="circle"></div>
                    </button>
                </a>
            </li>
            <li>
                <a href="">
                    <ion-icon name="headset-outline"></ion-icon>
                    <p>Contact admin</p>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <ion-icon name="log-out-outline"></ion-icon>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
    <!-- Ionicons -->
    <script
        type="module"
        src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Add the script to use Ionicons through CDN -->
    <script
        type="module"
        src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
