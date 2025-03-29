<?php
session_start();
// ทำลายเซสชัน
session_destroy();

echo '<script>localStorage.setItem("isLoggedIn", "false"); window.location.href = "login.html";</script>';


// echo '<script>var isLoggedIn = false;</script>';

// header('Location: login.html');
?>