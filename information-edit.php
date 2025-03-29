<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันตัวตน</title>
    <link rel="stylesheet" href="styles-head1.css">
    <style>
form{
    padding-left:130px;
    padding-top: 2rem;
    font-size: 1rem;
}
form p{
    padding-bottom: 0.5rem;
}
form h2{
    padding-bottom: 0.5rem;
}
form select{
    margin-bottom: 0.5rem; 
}
form input{
    margin-bottom: 0.5rem; 
}
form input[type="submit"]{
    font-size: 0.8rem;
    border-radius: 4px;
    height: 3rem;
    font-weight: 600;
    text-transform: uppercase;
    -webkit-transition: all 200ms linear;
    transition: all 200ms linear;
    padding: 0 20px;
    /* letter-spacing: 1px; */
    align-items: center;
    background-color: #ffeba7;
    color: #000000;
    margin: 0;
}

    </style>
</head>
<body>
<div class="sidebar">
        <a href="information.html">
            <div id="profile">
                <!-- Change the src to the URL of the person icon -->
                <!-- <ion-icon name="person-outline"></ion-icon> -->
            </div>
        </a>
        <ul class="menu">
            <span>Menu</span>
            <li>
                <a href="information.html">
                    <ion-icon name="person-outline"></ion-icon>
                    <p>Profile</p>
                </a>
            </li>
            <li>
                <a href="dashboard.html">
                    <ion-icon name="home-outline"></ion-icon>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- <li>
                <a href="notifications.html">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <p>Notifications</p>
                </a>
            </li> -->
            <li class="likes">
                <a href="find-partner.html">
                    <ion-icon name="people-outline"></ion-icon>
                    <p>Find Partner</p>
                </a>
            </li>
            <li class="likes">
                <a href="like-chat.html">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    <p>Chat</p>
                </a>
            </li>
            <!-- <li class="switch-theme">
                <a href="#">
                    <ion-icon name="moon-outline"></ion-icon>
                    <p>Dark Mode</p>
                    <button>
                        <div class="circle"></div>
                    </button>
                </a>
            </li> -->
            <li>
                <a href="chat-admin.html">
                    <ion-icon name="headset-outline"></ion-icon>
                    <p>Contact Admin</p>
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
    <section class="informaion">
    <div class="table-user">
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
            
            $sql = "SELECT * FROM tb_information WHERE user_id = $user_id";
            $result = $conn->query($sql);   

            $sql_status = "SELECT user_status FROM tb_user WHERE user_id = $user_id";
            $result_status = $conn->query($sql_status);  

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $row_status = $result_status->fetch_assoc();
                // แสดงฟอร์มแก้ไขข้อมูล
                echo "<form action='information-update.php' method='post'>";
                echo "<h2>ข้อมูลส่วนตัว</h2>";
                echo "<input type='hidden' name='id' value='" . $row["user_id"] . "'>";
                echo "<p>รอตรวจสอบการยืนยันตัวตน สถานะการอนุมัติ: ". $row_status["user_status"] . "</p>";
                echo "<p>ชื่อจริง:". $row["first_name"] . "</p>";
                echo "<p>นามสกุล:" . $row["last_name"] . "</p>";
                echo "เลือกเพศ: <select name='gender_f' value='" . $row["gender"] . "' required><option value='Male'>Male</option><option value='Female'>Female</option></select><br>";
                echo "เพศ: <input type='text' name='' value='" . $row["gender"] . "'><br>";
                echo "อายุ: <input type='text' name='age_f' value='" . $row["age"] . "'><br>";
                echo "น้ำหนัก: <input type='text' name='weight_f' value='" . $row["weight_us"] . "'><br>";
                echo "ส่วนสูง: <input type='text' name='height_f' value='" . $row["height"] . "'><br>";
                // echo "Phone: <input type='text' name='phone' value='" . $row["phone"] . "'><br>";
                echo "<input type='submit' value='Save' onclick='return confirm(\"คุณแน่ใจว่าต้องการบันทึกข้อมูล?\");'>";
                echo "</form>";
            } else {
                echo "<form action='information-insert.php' method='post'>";
                echo "<h2>ข้อมูลส่วนตัว</h2>";
                echo "<input type='hidden' name='id' value=''>";
                echo "ชื่อจริง: <input type='text' name='firstname_f' value=''><br>";
                echo "นามสกุล: <input type='text' name='lastname_f' value=''><br>";
                echo "เพศ:<select name='gender_f' required><option value='Male'>Male</option><option value='Female'>Female</option></select><br>";
                // echo "เพศ: <input type='text' name='gender_f' value=''><br>";
                echo "อายุ: <input type='number' name='age_f' value=''><br>";
                echo "น้ำหนัก: <input type='number' name='weight_f' value=''><br>";
                echo "ส่วนสูง: <input type='number' name='height_f' value=''><br>";
                // echo "Phone: <input type='text' name='phone' value='" . $row["phone"] . "'><br>";
                echo "<input type='submit' value='Save'>";
                echo "</form>";
            }

            $conn->close();
        ?>
    </div>
</body>
<script>
let containerDiv = document.getElementById('profile');
    fetch('match-img-myself.php')
        .then(response => response.json())
        .then(data1 => {
            data1.forEach(item1 => {
                const card_like = document.createElement('div');
                card_like.classList.add('card-show');
                card_like.innerHTML = `
                    <div class="img-profile">
                        <img src="uploads/${item1.image_path || 'profile_none.png'}" alt="${item1.user_name}">
                    </div>
                    <p>${item1.user_name}</p>
                `;
                containerDiv.appendChild(card_like);
                // Append the created card to the DOM or perform any other necessary actions
            });
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        });
</script>
</html>
