<?php
include('../config/db.config.php');
if ($_SESSION['user_type'] != 'Admin') { header("Location: login.php"); exit(); }

$total_students = $conn->query("SELECT COUNT(*) as count FROM USER WHERE user_type='Student'")->fetch_assoc()['count'];
$active_clubs = $conn->query("SELECT COUNT(*) as count FROM CLUB WHERE status='Active'")->fetch_assoc()['count'];
$upcoming_events = $conn->query("SELECT COUNT(*) as count FROM EVENT WHERE event_date >= CURDATE()")->fetch_assoc()['count'];
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