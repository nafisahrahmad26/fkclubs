<?php
require_once('../includes/header.php');
$my_user_id = $_SESSION['user_id'];

if (isset($_GET['register'])) {
    $ev_id = intval($_GET['register']);
    
    // Capacity Verification Engine Guard
    $capacity_check = mysqli_fetch_assoc(mysqli_query($link, "SELECT max_participants, (SELECT COUNT(*) FROM event_registration WHERE event_id=$ev_id AND status='Registered') as current_count FROM event WHERE event_id=$ev_id"));
    
    if ($capacity_check['current_count'] >= $capacity_check['max_participants']) {
        echo "<script>alert('Notice: Event Registration Capacity Filled up. Added to Waiting List.');</script>";
        mysqli_query($link, "INSERT INTO event_registration (event_id, user_id, status) VALUES ($ev_id, $my_user_id, 'Waiting List')");
    } else {
        mysqli_query($link, "INSERT INTO event_registration (event_id, user_id, status) VALUES ($ev_id, $my_user_id, 'Registered')");
    }
}
?>

<h2>📅 Active Event Programs & Registration Terminal</h2>
<div class="ui-card">
    <h3>Upcoming Open Interactive Gatherings</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Execution Date/Time</th>
                <th>Infrastructure Venue</th>
                <th>Occupancy Load</th>
                <th>Action Terminal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $evt_query = mysqli_query($link, "SELECT e.*, (SELECT COUNT(*) FROM event_registration er WHERE er.event_id=e.event_id AND status='Registered') as filled FROM event e WHERE event_date >= CURDATE()");
            while($ev = mysqli_fetch_assoc($evt_query)) {
                $already_reg = mysqli_num_rows(mysqli_query($link, "SELECT * FROM event_registration WHERE event_id={$ev['event_id']} AND user_id=$my_user_id"));
                
                echo "<tr>
                        <td><strong>{$ev['event_name']}</strong></td>
                        <td>{$ev['event_date']} at {$ev['event_time']}</td>
                        <td>{$ev['venue']}</td>
                        <td>{$ev['filled']} / {$ev['max_participants']} Slots</td>
                        <td>";
                if ($already_reg > 0) {
                    echo "<span style='color:#2ecc71; font-weight:bold;'>Signed Up</span>";
                } else {
                    echo "<a href='event_registration.php?register={$ev['event_id']}' class='btn btn-success' style='padding:5px 10px; font-size:12px; text-decoration:none;'>Join Activity</a>";
                }
                echo "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>