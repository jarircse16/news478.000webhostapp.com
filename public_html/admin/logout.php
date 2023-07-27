<?php
include "config.php";

// Start the session first
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset and destroy the session
    session_unset();
    session_destroy();

    // Delete the cookie by setting its expiration time to the past
    setcookie('remember_me', '', time() - 3600, '/');

    // Redirect to the desired page after logout
    header("Location: https://news478.000webhostapp.com/admin");
    exit();
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: https://news478.000webhostapp.com/admin");
    exit();
}
?>
