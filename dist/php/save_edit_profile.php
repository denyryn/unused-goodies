<?php
    include("./config.php");
    include("./auth.php");
    include("./img_upload.php");
    include("./users_function.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $user_id = $_POST['user_id'];
        $fullName = $_POST['full_name'];
        $email = $_POST['email']; //
        $phone_no = $_POST['phone']; //
        $gender = $_POST['gender'];  //
        $birthdate = $_POST['birthdate'];
        $hobby = $_POST['hobby'];
        $city = $_POST['city']; //
        $state = $_POST['state']; //
        $postal_code = $_POST['postal_code']; //
        $main_address = $_POST['main_address']; //

        // Handle image upload using your existing function
        $fileInputName = "profile_photo";
        $targetDir = "../../uploads/user_pp/$user_id/";  // Replace with the actual upload directory

        
        if (!is_dir($targetDir)) {
            // Create the directory if it doesn't exist
            mkdir($targetDir, 0755, true);
            chmod($targetDir, 0755);
        }

        // Check if a file was uploaded
        if (!empty($_FILES[$fileInputName]['name'])) {
            list($newFileName, $targetFile) = handleImageUpload($fileInputName, $targetDir);

            // Check if image upload was successful
            if ($newFileName === false) {
                echo "Error uploading the profile photo.";
                exit;
            }

            $targetFDir = "../uploads/user_pp/$user_id/";
            $fullProfilePhotoPath = $targetFDir . $newFileName;

            // Delete the current profile photo
            $currentImgPath = getCurrentUserImagePath($_SESSION['user_id']);
            if (!empty($currentImgPath) && file_exists($currentImgPath)) {
                unlink($currentImgPath);
            }
        } else {
            // No file was uploaded, keep the existing profile photo
            $fullProfilePhotoPath = getCurrentUserImagePath($_SESSION['user_id']);
        }

        // Update user profile in the database
        $pdo_statement = $pdo->prepare("UPDATE users SET 
        full_name = :full_name,
        birthdate = :birthdate,
        hobby = :hobby,
        profile_photo = :profile_photo,
        email = :email,
        phone_no = :phone_no,
        gender = :gender,
        city = :city,
        state = :state,
        postal_code = :postal_code,
        main_address = :main_address
        WHERE user_id = :user_id");

        $pdo_statement->bindParam(':full_name', $fullName);
        $pdo_statement->bindParam(':birthdate', $birthdate);
        $pdo_statement->bindParam(':hobby', $hobby);
        $pdo_statement->bindParam(':profile_photo', $fullProfilePhotoPath);
        $pdo_statement->bindParam(':email', $email); 
        $pdo_statement->bindParam(':phone_no', $phone_no); 
        $pdo_statement->bindParam(':gender', $gender); 
        $pdo_statement->bindParam(':city', $city); 
        $pdo_statement->bindParam(':state', $state); 
        $pdo_statement->bindParam(':postal_code', $postal_code); 
        $pdo_statement->bindParam(':main_address', $main_address); 
        $pdo_statement->bindParam(':user_id', $user_id);

        if ($pdo_statement->execute()) {
            // Update successful
            header("Location: ../profile_page.php"); // Redirect to the profile page
            exit();
        } else {
            // Update failed
            echo "Error updating profile. Failing Execute.";
        }
    }
?>

