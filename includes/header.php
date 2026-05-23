<?php
require_once(__DIR__ . '/../config/db.config.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: ../module1/login.php");
    exit;
}

// Map the active filename to an elegant presentation text header title
$current_page_name = basename($_SERVER['PHP_SELF']);
$page_title_text = "FKClubs Platform";

if ($current_page_name == "admin_dashboard.php") $page_title_text = "Admin Dashboard";
if ($current_page_name == "user_management.php") $page_title_text = "User Management";
if ($current_page_name == "club_management.php") $page_title_text = "Club Management";
if ($current_page_name == "club_list.php")       $page_title_text = "Browse Clubs";
if ($current_page_name == "profile.php")         $page_title_text = "My Profile Settings";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title_text; ?> - FKClubs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="app-wrapper">
        <?php include(__DIR__ . '/sidebar.php'); ?>
        
        <div class="main-content-panel">
            <div class="top-header-navbar">
                <div class="page-active-title"><?php echo $page_title_text; ?></div>
                <div class="user-identity-profile-bar">
                    <span class="role-badge"><?php echo htmlspecialchars($_SESSION['user_type']); ?></span>
                    <a href="../module1/profile.php" class="profile-link-btn">
                        <?php echo htmlspecialchars($_SESSION['name'] ? $_SESSION['name'] : $_SESSION['username']); ?>
                    </a>
                </div>
            </div>
            <div class="view-content-container">