<?php 
    include ("./php/auth.php");

    if (isAdminLoggedIn()) {
        header("location: dashboard_page.php");
    } else {
        header("location: login_page.php");
    }
?>