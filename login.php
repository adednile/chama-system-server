<?php
session_start();
require 'config.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Step 15: Verify password against stored hash
    if ($row && password_verify($pass, $row['password'])) {
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email']    = $row['email'];
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Group 1 - Login</title></head>
<body style="font-family: Arial, sans-serif; max-width: 420px; margin: 50px auto;">
    <h2>Group 1 Member Login</h2>
    <?php if ($error) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required style="width:100%; padding:8px; margin:6px 0 12px;"><br>
        <label>Password:</label><br>
        <input type="password" name="password" required style="width:100%; padding:8px; margin:6px 0 16px;"><br>
        <button type="submit" style="padding:10px 18px;">Login</button>
    </form>
    <p>New member? <a href="signup.php">Register here</a></p>
</body>
</html>
