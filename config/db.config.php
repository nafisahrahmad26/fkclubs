<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connection to database
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// select database
mysqli_select_db($link, "fkclubs") or die(mysqli_error($link));
?>