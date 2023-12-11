<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include('../../config.php'); // Include database configuration

    $conn = new mysqli(HOST, USER, PASS, DBASE); // Establish database connection using defined constants

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $userName = $_POST['userName'];
    $newPassword = $_POST['nPassword']; // New password
    $confirmPassword = $_POST['cPassword']; // Confirm password

    // Validate passwords match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['err_pwupdate'] = "Passwords must match.";
        header("Location: ../../public/form/pw-update-form.php");
        exit();
    } else if(strlen($newPassword) < 8){
        $_SESSION['err_pwupdate'] = "Passwords must be at least 8 characters.";
        header("Location: ../../public/form/pw-update-form.php");
        exit();
    } else {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        // Update password in the database
        //$sql = "UPDATE authenticator SET passCode='$hashedPassword' WHERE userName='$userName'";
        $sql = "UPDATE authenticator AS a
        INNER JOIN player AS p ON a.registrationOrder = p.registrationOrder
        SET a.passCode='$hashedPassword'
        WHERE p.userName='$userName'";
    
        if ($conn->query($sql) === TRUE) {
            $account_success = "Password has been updated successfully! You may now login";
            $_SESSION['account_success'] = $account_success;
            // Redirect user
            header("Location: ../../public/form/signin-form.php");
            exit();
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }


    $conn->close();
}
?>
