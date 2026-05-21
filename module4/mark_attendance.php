<?php 
include('../config/db.config.php'); 
if (isset($_POST['save_attendance'])) { 
$reg_id = intval($_POST['registration_id']); 
$uid = intval($_POST['user_id']); 
$status = $_POST['attendance_status']; 
$points = 0; 
if ($status == 'Present') $points = 10; 
if ($status == 'Late') $points = 5; 
if ($status == 'Absent') $points = -10; 
if ($status == 'Volunteer') $points = 5; 
$query = "INSERT INTO ATTENDANCE (registration_id, user_id, attendance_status, 
check_in_time, points_earned) VALUES ($reg_id, $uid, '$status', NOW(), $points)"; 
$result = mysqli_query($link, $query); 
if($result) { $msg = "Attendance marked successfully!"; } else { die("Insert failed"); } 
} 
$registrations = mysqli_query($link, "SELECT EVENT_REGISTRATION.*, 
EVENT.event_name, USER.name FROM EVENT_REGISTRATION JOIN EVENT ON 
EVENT_REGISTRATION.event_id = EVENT.event_id JOIN USER ON 
EVENT_REGISTRATION.user_id = USER.user_id"); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Track Attendance</title> 
    <link rel="stylesheet" href="../css/style.css"> 
</head> 
<body> 
    <div class="container"> 
        <h2>Live Event Tracking & Points Matrix Processing</h2> 
        <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?> 
        <table> 
            <tr><th>Student</th><th>Target Activity</th><th>Registration 
Status</th><th>Mark Execution</th></tr> 
            <?php while($r = mysqli_fetch_assoc($registrations)) { ?> 
                <tr> 
                    <td><?php echo $r['name']; ?></td> 
                    <td><?php echo $r['event_name']; ?></td> 
                    <td><?php echo $r['status']; ?></td> 
                    <td> 
                        <form action="" method="POST" style="display:inline-flex; gap:10px;"> 
                            <input type="hidden" name="registration_id" value="<?php echo 
$r['registration_id']; ?>"> 
                            <input type="hidden" name="user_id" value="<?php echo $r['user_id']; 
?>"> 
                            <select name="attendance_status"> 
                                <option value="Present">Present (+10)</option> 
                                <option value="Late">Late Arrival (+5)</option> 
                                <option value="Volunteer">Volunteer Helper (+5)</option> 
                                <option value="Absent">Absent (-10)</option> 
                            </select> 
                            <button type="submit" name="save_attendance" class="btn">Log 
Checkin</button> 
                        </form> 
                    </td> 
                </tr> 
            <?php } ?> 
        </table> 
    </div> 
</body> 
</html>