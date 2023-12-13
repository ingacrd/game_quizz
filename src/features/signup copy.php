<?php

include_once '../../db/Database.php';
require_once '../../config.php';

session_start();

function isFirstLetterAlphabetical($str) {
    // Check if the string is not empty
    if (!empty($str)) {
        // Get the first character of the string
        $firstLetter = $str[0];
        
        // Check if the first character is an alphabetical letter
        return ctype_alpha($firstLetter);
    }

    // Return false if the string is empty
    return false;
}

function does_user_exist($userName) {
    $mysqli = new mysqli('localhost', 'root', '', 'kidsGames');
    $currentDateTime = date("Y-m-d H:i:s");

    if($mysqli -> connect_errno) {
        echo "Failed to connect to MYSQL: " . $mysqli->connecto_error;
        exit();
    }
    
    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM player WHERE userName = '$userName'";
    $result = $mysqli->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        $mysqli->close();
        return true;
    } else {
        $mysqli->close();
        return false;
    }
}

function create_player($fName, $lName, $userName, $password) {
    $mysqli = new mysqli('localhost', 'root', '', 'kidsGames');
    $currentDateTime = date("Y-m-d H:i:s");

    if($mysqli -> connect_errno) {
        echo "Failed to connect to MYSQL: " . $mysqli->connecto_error;
        exit();
    }

    $sqlCreateUser = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES
    ('$fName', '$lName', '$userName', '$currentDateTime')";
    $mysqli->query($sqlCreateUser);
    $createdId = $mysqli->insert_id;
    $passcode = password_hash($password, PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO authenticator(passcode, registrationOrder) VALUES 
    ('$passcode', '$createdId')");
    $mysqli->close();

}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    $valid_firstName = (strlen($fName) != 0 && isFirstLetterAlphabetical($fName));
    $valid_lastName = (strlen($lName) != 0 && isFirstLetterAlphabetical($lName));
    $valid_userName = (strlen($userName) >= 8);
    $valid_password = (strlen($password) >= 8);
    $valid_password2 = (strlen($confirmPassword) >= 8);
    $are_passwords_equal = ($password === $confirmPassword);

    if(does_user_exist($userName) == true) {
        $error_message = "There is already a user with this username.";
        $_SESSION['error_message'] = $error_message;

        // Redirect back to the signup form
        header("Location: ../../public/form/signup-form.php");
        exit();
    } else if($valid_firstName && $valid_lastName && $valid_userName && $valid_password && $valid_password2 && $are_passwords_equal) {
        $account_success = "Account has been created successfully! You may now login";
        $_SESSION['account_success'] = $account_success;

        create_player($fName, $lName, $userName, $password);
        header("Location: ../../public/form/signin-form.php");
        exit();
    } else {
        // Validation failed
        $error_message = "There was an error in the form submission. Please check your inputs.";

        // Store the error message in a session variable
        $_SESSION['error_message'] = $error_message;

        // Redirect back to the signup form
        header("Location: ../../public/form/signup-form.php");
        exit();
    }
}