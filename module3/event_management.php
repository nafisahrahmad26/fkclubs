<?php
require_once('../includes/header.php');
if ($_SESSION['user_type'] !== 'Admin' && $_SESSION['user_type'] !== 'Staff') { echo "Access Denied."; exit; }

if (isset($_POST['create_event'])) {
    $club_id = intval($_POST['club_id']);
    $name = mysqli_real_escape_string($link, $_POST['event_name']);
    $date = mysqli_real_escape_string($link, $_POST['event_date']);
    $time = mysqli_real_escape_string($link, $_POST['event_time']);
    $venue = mysqli_real_escape_string($link, $_POST['venue']);
    $max_p = intval($_POST['max_participants']);
    $desc = mysqli_real_escape_string($link, $_POST['event_description']);

    mysqli_query($link, "INSERT INTO event (club_id, event_name, event_date, event_time, venue, max_participants, event_description) VALUES ($club_id, '$name', '$date', '$time', '$venue', $max_p, '$desc')");
}
?>

<h2>📅 Event Management & Organizational Operations Control</h2>
<div class="ui-card">
    <h3>Schedule & Create New Event Form</h3>
    <form action="event_management.php" method="POST" style="margin-top:15px;">
        <div class="form-group">
            <label>Hosting Organizer Club</label>
            <select name="club_id" class="form-control">
                <?php
                $my_clubs = mysqli_query($link, "SELECT club_id, club_name FROM club WHERE status='Active'");
                while($mc = mysqli_fetch_assoc($my_clubs)) {
                    echo "<option value='{$mc['club_id']}'>{$mc['club_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Event Official Title</label>
            <input type="text" name="event_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date & Target Execution Time</label>
            <input type="date" name="event_date" style="width:48%; display:inline-block;" class="form-control" required>
            <input type="time" name="event_time" style="width:48%; display:inline-block; float:right;" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Target Infrastructure Venue Location</label>
            <input type="text" name="venue" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Maximum Attendance Registration Capacity Limit</label>
            <input type="number" name="max_participants" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Detailed Program Description</label>
            <textarea name="event_description" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" name="create_event" class="btn btn-primary">Publish and Launch Event</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>