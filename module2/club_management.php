<?php
require_once('../includes/header.php');
if ($_SESSION['user_type'] !== 'Admin') { echo "Access Denied."; exit; }

if (isset($_POST['create_club'])) {
    $club_name = mysqli_real_escape_string($link, $_POST['club_name']);
    $category = mysqli_real_escape_string($link, $_POST['club_category']);
    $desc = mysqli_real_escape_string($link, $_POST['club_description']);
    $advisor = intval($_POST['advisor_id']);
    
    mysqli_query($link, "INSERT INTO club (club_name, club_category, club_description, advisor_id, status) VALUES ('$club_name', '$category', '$desc', $advisor, 'Active')");
}
?>

<h2>🏛️ Manage Registered Faculty Student Clubs</h2>
<div class="ui-card">
    <h3>Establish/Create New Student Club Entity</h3>
    <form action="club_management.php" method="POST" style="margin-top:15px;">
        <div class="form-group">
            <label>Club Name</label>
            <input type="text" name="club_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Club Category Division</label>
            <input type="text" name="club_category" class="form-control" placeholder="e.g., Computing, Robotics, Cyber Security" required>
        </div>
        <div class="form-group">
            <label>Assigned Staff/Advisor Entity ID</label>
            <select name="advisor_id" class="form-control">
                <?php
                $staff = mysqli_query($link, "SELECT user_id, name FROM user WHERE user_type='Staff' OR user_type='Admin'");
                while($s = mysqli_fetch_assoc($staff)) {
                    echo "<option value='{$s['user_id']}'>{$s['name']} (ID: {$s['user_id']})</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Club Functional Description Summary</label>
            <textarea name="club_description" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" name="create_club" class="btn btn-success">Authorize & Form Club</button>
    </form>
</div>

<div class="ui-card">
    <h3>Current Faculty Active Club List</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Club Structured Name</th>
                <th>Category</th>
                <th>Advisor Identity</th>
                <th>Status Mapping</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $clubs = mysqli_query($link, "SELECT c.*, u.name as advisor_name FROM club c JOIN user u ON c.advisor_id=u.user_id");
            while($c = mysqli_fetch_assoc($clubs)) {
                echo "<tr>
                        <td>{$c['club_id']}</td>
                        <td><strong>{$c['club_name']}</strong></td>
                        <td>{$c['club_category']}</td>
                        <td>{$c['advisor_name']}</td>
                        <td>{$c['status']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>