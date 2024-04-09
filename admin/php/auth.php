<?php
    session_start();

    include('config.php');

    // Function to check if an admin is logged in
    function isAdminLoggedIn()
    {
        return isset($_SESSION['admin_id']);
    }

?>