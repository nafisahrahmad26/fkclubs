<?php
include('../config/db.config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'Admin') {
    header("Location: login.php");
    exit();
}

$res_users = mysqli_query($link, "SELECT COUNT(*) as count FROM USER");
$total_users = mysqli_fetch_assoc($res_users)['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <h2>Welcome, Admin <?php echo $_SESSION['name']; ?></h2>
        <div>
            <a href="register_user.php">Register Users</a>
            <a href="../module2/manage_clubs.php">Clubs</a>
            <a href="login.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <h3>System Overview Metrics</h3>
        <div class="dashboard-grid">
            <div class="card"><h3><?php echo $total_students; ?></h3><p>Registered Students</p></div>
            <div class="card"><h3><?php echo $active_clubs; ?></h3><p>Active Faculty Clubs</p></div>
            <div class="card"><h3><?php echo $upcoming_events; ?></h3><p>Upcoming Events</p></div>
        </div>
    </div>
</body>
</html>