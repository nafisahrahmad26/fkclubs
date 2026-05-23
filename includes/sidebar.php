<?php
$user_type = $_SESSION['user_type'] ?? '';
?>
<aside class="sidebar">
    <nav class="nav-menu">
        <ul>
            <li><a href="admin_dashboard.php">📊 Analytics Dashboard</a></li>
            <li><a href="profile.php">👤 Personal Profile Settings</a></li>
            
            <?php if ($user_type === 'Admin'): ?>
                <li class="menu-divider">System Control Panels</li>
                <li><a href="user_management.php">👥 Manage Membership / Users</a></li>
                <li><a href="club_management.php">🏢 Manage Student Clubs</a></li>
            <?php endif; ?>
            
            <li class="menu-divider">Core Activities Channels</li>
            <li><a href="club_list.php">📋 Faculty Clubs Directory</a></li>
            <li><a href="event_management.php">📅 Club Event Operations</a></li>
            <li><a href="event_registration.php">🎟️ Event Intake Portal</a></li>
            <li><a href="attendance.php">⏱️ Log Attendance Matrix</a></li>
            <li><a href="participant_reports.php">📈 Performance Tiers Reports</a></li>
            
            <li class="logout-item"><a href="logout.php">🚪 Terminate Session (Sign Out)</a></li>
        </ul>
    </nav>
</aside>
<main class="content-body">