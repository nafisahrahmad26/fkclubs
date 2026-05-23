<?php require_once('../includes/header.php'); ?>

<h2>🔍 Directory of Active Clubs & Associations</h2>
<p style="color:#7f8c8d; margin-bottom:20px;">Browse current official student associations inside the Faculty of Computing.</p>

<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:20px;">
    <?php
    $res = mysqli_query($link, "SELECT c.*, u.name as advisor FROM club c JOIN user u ON c.advisor_id=u.user_id WHERE c.status='Active'");
    while($row = mysqli_fetch_assoc($res)) {
        echo "<div class='ui-card' style='margin-bottom:0;'>
                <h3 style='color:#2c3e50;'>{$row['club_name']}</h3>
                <span style='font-size:11px; background:#e67e22; color:white; padding:2px 6px; border-radius:4px;'>{$row['club_category']}</span>
                <p style='margin:12px 0; font-size:14px; color:#555;'>".htmlspecialchars($row['club_description'])."</p>
                <div style='font-size:12px; color:#7f8c8d;'><strong>Faculty Advisor:</strong> {$row['advisor']}</div>
              </div>";
    }
    ?>
</div>

<?php include('../includes/footer.php'); ?>