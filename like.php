<?php
session_start();
require 'db.php';

$user_id = $_SESSION["user_id"] ?? null;
$tweet_id = $_GET["tweet_id"] ?? null;

if ($user_id && $tweet_id) {
    // Check if already liked to toggle
    $check = $pdo->prepare("SELECT * FROM likes WHERE user_id = ? AND tweet_id = ?");
    $check->execute([$user_id, $tweet_id]);
    if ($check->fetch()) {
        // Already liked, so unlike
        $stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND tweet_id = ?");
        $stmt->execute([$user_id, $tweet_id]);
    } else {
        // Not liked, insert like
        $stmt = $pdo->prepare("INSERT INTO likes (user_id, tweet_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $tweet_id]);
    }
}

echo "<script>window.location.href='index.php';</script>";
exit;
?>
