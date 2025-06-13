<?php
session_start();
if (isset($_SESSION["user_id"])) {
    // If logged in redirect to home.php (your main feed)
    echo "<script>window.location.href='home.php';</script>";
    exit;
} else {
    // Not logged in redirect to login
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
?>
