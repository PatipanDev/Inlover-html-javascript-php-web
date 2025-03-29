<?php
include('connectdtb.php');
	
$sql = "SELECT * FROM tb_login";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
  // แสดงข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
    echo "รหัส: " . $row["id"]. " - ชื่อ-สกุล: " . $row["username"]. " " . $row["passwd"]."<br>";
    }
	
} else {
    echo "0 results";
}
// ปิดการเชื่อมต่อ
$conn->close();

?>