<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "../../db/Create.php";
require_once "../../db/Select.php";
require_once "../../db/Insert.php";


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

    $obj = new Create();
    $obj = new Select($userName, $password);
    $verifyUserName = $obj->checkUserName();

    //if(does_user_exist($userName) == true) 
    if ($verifyUserName === true){
        $error_message = "There is already an user with this username.";
        $_SESSION['error_message'] = $error_message;

        // Redirect back to the signup form
        header("Location: ../../public/form/signup-form.php");
        exit();
    } else if($valid_firstName && $valid_lastName && $valid_userName && $valid_password && $valid_password2 && $are_passwords_equal) {
        $obj = new Insert($userName, $password);
        $obj->create_player($fName, $lName, $userName, $password);
        $obj->createAuthenticator();

        $account_success = "Account has been created";
        //echo "br".$account_success;
        $_SESSION['account_success'] = $account_success;
        //echo $account_success;
        header("Location: ../../public/form/signin-form.php");
     
        exit();
    } else {
        // Validation failed
        $error_message = "There was an error in the form submission. Please check your inputs.";
        echo "br".$error_message;
        // Store the error message in a session variable
        $_SESSION['error_message'] = $error_message;

        //Redirect back to the signup form
        header("Location: ../../public/form/signup-form.php");
        exit();
    }
}