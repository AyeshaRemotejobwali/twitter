<?php
session_start();
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tweet_id = $_POST["tweet_id"];
    $content = trim($_POST["content"]);
    $user_id = $_SESSION["user_id"] ?? null;

    if ($user_id && $content && $tweet_id) {
        $stmt = $pdo->prepare("INSERT INTO comments (user_id, tweet_id, content) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $tweet_id, $content]);
    }
}
echo "<script>window.location.href='home.php';</script>";
?>
