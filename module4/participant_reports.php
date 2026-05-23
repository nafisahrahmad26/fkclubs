<?php require_once('../includes/header.php'); ?>

<h2>📈 Activity Participation Performance & Engagement Rankings</h2>
<p style="color:#7f8c8d; margin-bottom:20px;">Real-time evaluation data processing according to systemic Point-Based Evaluation Framework criteria.</p>

<div class="ui-card">
    <h3>Systemic Engagement Leaderboard</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Student Candidate Name</th>
                <th>Accumulated Merit Score Points</th>
                <th>System Recognition Certification Level</th>
                <th>Enforcement Status/Action Mapping</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank_query = "SELECT u.name, u.username, COALESCE(SUM(a.points_earned), 0) as total_points 
                           FROM user u 
                           LEFT JOIN attendance a ON u.user_id=a.user_id 
                           WHERE u.user_type='Student' 
                           GROUP BY u.user_id 
                           ORDER BY total_points DESC";
            
            $res = mysqli_query($link, $rank_query);
            while($row = mysqli_fetch_assoc($res)) {
                $p = $row['total_points'];
                
                // Rule implementation for Table B valuation parsing logic
                if ($p < 20) {
                    $tier = "Warning Level Track";
                    $enforce = "🔕 Warning / Reminder to participate more";
                } elseif ($p >= 20 && $p <= 49) {
                    $tier = "Certified Level Participant";
                    $enforce = "📜 Eligible for participation certificate";
                } elseif ($p >= 50 && $p <= 79) {
                    $tier = "Highly Active Contributor";
                    $enforce = "🏅 Eligible for active student award / bonus points";
                } else {
                    $tier = "Outstanding Premium Catalyst Leader";
                    $enforce = "🏆 Outstanding participant; eligible for leadership award / priority in event registration";
                }

                echo "<tr>
                        <td><strong>".htmlspecialchars($row['name'] ? $row['name'] : $row['username'])."</strong></td>
                        <td><span style='font-size:16px; color:#2c3e50; font-weight:bold;'>$p pts</span></td>
                        <td><span class='user-role' style='background-color:#9b59b6;'>$tier</span></td>
                        <td style='font-size:13px; color:#2c3e50;'>$enforce</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>