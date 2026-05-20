<?php
include('../config/db.config.php');
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$uid = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $conn->query("UPDATE USER SET name='$name', email='$email' WHERE user_id=$uid");
    $_SESSION['name'] = $name;
    $msg = "Profile updated!";
}
$user = $conn->query("SELECT * FROM USER WHERE user_id=$uid")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Manage My Profile</h2>
        <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
        <form action="" method="POST">
            <div class="form-group"><label>Name</label><input type="text" name="name" value="<?php echo $user['name']; ?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" value="<?php echo $user['email']; ?>"></div>
            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</body>
</html>