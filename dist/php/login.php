<?php
// Include the database connection file
include 'config.php';

// Define variables and initialize with empty values
$username_or_email = $password = '';
$username_or_email_err = $password_err = '';

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate username or email
    if (empty(trim($_POST['username_or_email']))) {
        $username_or_email_err = 'Please enter a username or email.';
    } else {
        $username_or_email = trim($_POST['username_or_email']);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    // Check for errors before attempting to log in
    if (empty($username_or_email_err) && empty($password_err)) {

        // Prepare a SELECT statement
        $sql = 'SELECT user_id, username, email, password FROM users 
                WHERE username = :username OR email = :email';

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username);
            $stmt->bindParam(':email', $param_email);

            // Set parameters
            $param_username = $username_or_email;
            $param_email = $username_or_email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username or email exists, verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $hashed_password = $row['password'];
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start new session
                            session_start();

                            // Store data in session variables
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['email'] = $row['email'];

                            // Redirect to user dashboard or homepage
                            header('location:../main_page.php');
                        } else {
                            // Display an error message if password is not valid
                            header('location:../login_page.php');
                            $password_err = 'Password you entered is not valid.';
                        }
                    }
                } else {
                    header('location:../login_page.php');
                    $username_or_email_err = 'No account found with that username or email.';
                }
            } else {
                header('location:../login_page.php');
            }
        }
    }
}
?>