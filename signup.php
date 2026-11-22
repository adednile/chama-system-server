<?php
require 'config.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user  = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    // Step 15: Securely hash password before storing
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$user, $hashed_password, $email]);
        $msg = "User <strong>" . htmlspecialchars($user) . "</strong> registered successfully! <a href='login.php'>Proceed to Login</a>";
    } catch (PDOException $e) {
        $msg = "Registration error: Username or Email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Group 1 - Sign Up</title></head>
<body style="font-family: Arial, sans-serif; max-width: 420px; margin: 50px auto;">
    <h2>Group 1 Member Signup</h2>
    <?php if ($msg) echo "<p style='color: green;'>$msg</p>"; ?>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required style="width:100%; padding:8px; margin:6px 0 12px;"><br>
        <label>Email:</label><br>
        <input type="email" name="email" required style="width:100%; padding:8px; margin:6px 0 12px;"><br>
        <label>Password:</label><br>
        <input type="password" name="password" required style="width:100%; padding:8px; margin:6px 0 16px;"><br>
        <button type="submit" style="padding:10px 18px;">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
