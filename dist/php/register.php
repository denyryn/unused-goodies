<?php
    // Include the database connection file
    include ('config.php');

    // Define variables and initialize with empty values
    $username = $password = $confirm_password = $email = '';
    $username_err = $password_err = $confirm_password_err = $email_err = '';

    // Processing form data when form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validate username
        if (empty(trim($_POST['username']))) {
            $username_err = 'Please enter a username.';
        } else {
            $username = trim($_POST['username']);
        }

        // Validate email
        if (empty(trim($_POST['email']))) {
            $email_err = 'Please enter an email.';
        } else {
            $email = trim($_POST['email']);
        }

        // Validate password
        if (empty(trim($_POST['password']))) {
            $password_err = 'Please enter a password.';
        } elseif (strlen(trim($_POST['password'])) < 6) {
            $password_err = 'Password must have at least 6 characters.';
        } else {
            $password = trim($_POST['password']);
        }

        // Validate confirm password
        if (empty(trim($_POST['confirm_password']))) {
            $confirm_password_err = 'Please confirm the password.';
        } else {
            $confirm_password = trim($_POST['confirm_password']);
            if ($password !== $confirm_password) {
                $confirm_password_err = 'Password did not match.';
            }
        }

        // Check for errors before inserting into the database
        if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an INSERT statement
            $sql = 'INSERT INTO users (username, email, password) 
                    VALUES (:username, :email, :password)';

            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(':username', $param_username);
                $stmt->bindParam(':email', $param_email);
                $stmt->bindParam(':password', $param_password);

                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to login page after successful registration
                    header('location: ../login_page.php');
                } else {
                    echo 'Failing Execute';
                }
            }
        }
    }
?>