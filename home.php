<?php
session_start();
require 'db.php';

$stmt = $pdo->query('SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC');
$tweets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Twitter Clone</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }
        h1 {
            color: #1DA1F2;
            text-align: center;
        }
        .tweet-box textarea {
            width: 100%;
            padding: 10px;
            resize: none;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .tweet-box button {
            background: #1DA1F2;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            float: right;
            border-radius: 20px;
            cursor: pointer;
        }
        .tweets {
            margin-top: 30px;
        }
        .tweet {
            padding: 15px;
            border-bottom: 1px solid #e1e8ed;
        }
        .tweet h3 {
            margin: 0;
            color: #1DA1F2;
        }
        .tweet p {
            margin: 5px 0 10px;
        }
        .tweet time {
            color: #657786;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to Twitter Clone</h1>
    <div class="tweet-box">
        <form action="tweet.php" method="post">
            <textarea name="content" rows="3" placeholder="What's happening?" required></textarea>
            <button type="submit">Tweet</button>
        </form>
    </div>
    <div class="tweets">
        <?php foreach ($tweets as $tweet): ?>
            <div class="tweet">
                <h3>@<?= htmlspecialchars($tweet['username']) ?></h3>
                <p><?= htmlspecialchars($tweet['content']) ?></p>
                <time><?= $tweet['created_at'] ?></time>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
