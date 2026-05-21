<?php 
include('../config/db.config.php'); 
$uid = $_SESSION['user_id']; 
 
$res = mysqli_query($link, "SELECT SUM(points_earned) as total FROM ATTENDANCE 
WHERE user_id=$uid"); 
$total_points = mysqli_fetch_assoc($res)['total']; 
$total_points = $total_points ? $total_points : 0; 
 
$tier = "Warning / Reminder to participate more"; 
if ($total_points >= 20 && $total_points <= 49) $tier = "Eligible for participation 
certificate"; 
if ($total_points >= 50 && $total_points <= 79) $tier = "Eligible for active student award / 
bonus points"; 
if ($total_points >= 80) $tier = "Outstanding participant; leadership award priority"; 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>My Points & Recognition</title> 
<link rel="stylesheet" href="../css/style.css"> 
</head> 
<body> 
<div class="container"> 
<h2>My Accumulated Participation Recognition Matrix</h2> 
<div class="dashboard-grid"> 
<div class="card"><h3><?php echo $total_points; ?></h3><p>Total Point 
Standing</p></div> 
<div class="card" style="border-left-color: var(-
primary);"><h3>Status</h3><p><?php echo $tier; ?></p></div> 
</div> 
</div> 
</body> 
</html>
