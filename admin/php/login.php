<?php

    include ('config.php');


    $username = $password = '';
    $username_err = $password_err = '';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validate username
        if (empty(trim($_POST['username']))) {
            $username_err = 'Please enter your username.';
        } else {
            $username = trim($_POST['username']);
        }

        // Validate password
        if (empty(trim($_POST['password']))) {
            $password_err = 'Please enter your password.';
        } else {
            $password = trim($_POST['password']);
        }
        
        if (empty($username_err) && empty($password_err)) {

            
            $sql = 'SELECT admin_id, username, password FROM admin_users WHERE username = :username';

            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(':username', $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, verify password
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $hashed_password = $row['password'];
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION['admin_id'] = $row['admin_id'];
                                $_SESSION['username'] = $row['username'];

                                // Redirect to admin dashboard
                                header('location: ../dashboard_page.php');
                            } else {
                                // Display an error message if password is not valid
                                $password_err = 'The password you entered was not valid.';
                                header('location: ../login_page.php');
                            }
                        }
                    } else {
                        $username_err = 'No admin account found with that username.';
                        header('location: ../login_page.php');
                    }
                } else {
                    echo 'Error failing execute.';
                }
            }
        }
    }
?>