<?php
session_start();
require 'db.php';
$user_id = $_SESSION["user_id"] ?? null;

if (!$user_id) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$tweets = $pdo->prepare("SELECT * FROM tweets WHERE user_id = ? ORDER BY created_at DESC");
$tweets->execute([$user_id]);
$mytweets = $tweets->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
        body { font-family: sans-serif; background: #f5f8fa; }
        .container { width: 600px; margin: auto; background: white; padding: 20px; }
        .tweet { padding: 10px; border-bottom: 1px solid #ccc; }
    </style>
</head>
<body>
<div class="container">
    <h1><?= htmlspecialchars($user["username"]) ?>'s Profile</h1>
    <p>Email: <?= htmlspecialchars($user["email"]) ?></p>
    <p>Bio: <?= htmlspecialchars($user["bio"] ?? '') ?></p>
    <hr>
    <h3>Tweets</h3>
    <?php foreach ($mytweets as $tweet): ?>
        <div class="tweet"><?= htmlspecialchars($tweet["content"]) ?> <br><small><?= $tweet["created_at"] ?></small></div>
    <?php endforeach; ?>
</div>
</body>
</html>
