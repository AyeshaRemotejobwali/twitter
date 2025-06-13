<?php
session_start();
require 'db.php';

$follower_id = $_SESSION["user_id"] ?? null;
$following_id = $_GET["id"] ?? null;

if ($follower_id && $following_id && $following_id != $follower_id) {
    $check = $pdo->prepare("SELECT * FROM followers WHERE follower_id = ? AND following_id = ?");
    $check->execute([$follower_id, $following_id]);
    if (!$check->fetch()) {
        $stmt = $pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (?, ?)");
        $stmt->execute([$follower_id, $following_id]);
    }
}
echo "<script>window.location.href='home.php';</script>";
?>
