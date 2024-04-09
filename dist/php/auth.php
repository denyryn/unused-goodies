<?php
session_start();

// Include the database connection file
include ('config.php');

// Function to check if a user is logged in
function isUserLoggedIn()
{
    return isset($_SESSION['user_id']);
}

?>