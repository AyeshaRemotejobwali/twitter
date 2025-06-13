<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        echo "<script>window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<style>
    body { font-family: sans-serif; background: #f5f8fa; }
    .form-container { width: 300px; margin: 100px auto; background: white; padding: 20px; border-radius: 8px; }
    input { width: 100%; padding: 10px; margin: 5px 0; }
    button { background: #1DA1F2; color: white; border: none; padding: 10px; cursor: pointer; }
</style>
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
