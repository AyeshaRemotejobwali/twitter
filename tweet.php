<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'] ?? 1; // Default user for demo

    if ($content && $user_id) {
        $stmt = $pdo->prepare('INSERT INTO tweets (user_id, content) VALUES (?, ?)');
        $stmt->execute([$user_id, $content]);
    }
}
?>

<script>
    window.location.href = 'home.php';
</script>
