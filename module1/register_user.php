<?php
include('../config/db.config.php');
if ($_SESSION['user_type'] != 'Admin') { header("Location: login.php"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $user_type = $_POST['user_type'];

    $conn->query("INSERT INTO USER (name, email, username, password, user_type) VALUES ('$name', '$email', '$username', '$password', '$user_type')");
    $msg = "User registered successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <span>FK Clubs Admin</span>
        <a href="admin_dashboard_m1.php">Dashboard</a>
        <a href="login.php">Logout</a>
    </div>
    <div class="container">
        <h2>Register New System User</h2>
        <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
        <form action="" method="POST">
            <div class="form-group"><label>Full Name</label><input type="text" name="name" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group">
                <label>System Role</label>
                <select name="user_type">
                    <option value="Student">Student</option>
                    <option value="Staff">Staff / Advisor</option>
                    <option value="Admin">Administrator</option>
                </select>
            </div>
            <button type="submit" class="btn">Register User</button>
        </form>
    </div>
</body>
</html>