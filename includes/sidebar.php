<?php
$user_type = $_SESSION['user_type'] ?? 'Student';
?>
<div class="sidebar-panel">
    <div class="branding-container">
        <div class="logo-row-flex">
            <img src="../images/umpsa_logo.png" alt="UMPSA Logo">
            <img src="../images/logo_fk_dummy.png" alt="FKSC&EMS Logo">
        </div>
        <div class="system-title-label">FKSC & EMS PORTAL</div>
    </div>

    <ul class="navigation-menu-list">
        <?php if ($user_type === 'Admin'): ?>
            <li><a href="../module1/admin_dashboard.php">🧭 Dashboard</a></li>
            <li><a href="../module1/user_management.php">👥 Users</a></li>
        <?php endif; ?>
        
        <li><a href="../module2/club_list.php">🏛️ Clubs</a></li>
        <li><a href="../module3/event_registration.php">📅 Reports</a></li>
        <li><a href="../module1/profile.php">⚙️ Settings</a></li>
        
        <li style="margin-top: 20px;">
            <a href="../module1/logout.php" style="color: #e74c3c;">🚪 Logout</a>
        </li>
    </ul>
</div>