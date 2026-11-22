<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Group 1 - Dashboard</title></head>
<body style="font-family: Arial, sans-serif; max-width: 480px; margin: 50px auto;">
    <h2>Login Successful!</h2>
    <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (<?php echo htmlspecialchars($_SESSION['email']); ?>).</p>
    <p>Authenticated via <code>password_verify()</code> against <code>GROUP1.users</code>.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
