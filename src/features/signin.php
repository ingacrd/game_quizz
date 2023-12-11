<?php

require_once "../../public/model/user.php";

if (isset($_POST['send'])) {
    // Assign data collected from the form signin-form.php
    $user = $_POST['user'];
    $password = $_POST['password'];

    $userLogged = new User($user);

    // DB info
    // $tableName = "player";

    // Load the content of the user-defined functions used to interact with MySQL
    include_once "../../db/Database.php";
    include_once "../../db/Create.php";
    include_once "../../db/Select.php";

    // Instanciate an object of the Create class used to create the database and table
    // Create the database and tables
    $obj = new Create();

    // Instanciate an object of Select Class to look for the user inside the database
    $obj = new Select($user, $password);

    $verifyUserName = $obj->checkUserName();
    if ($verifyUserName === true) {
        // Fetch hashed password from the database
        $hashedPasswordFromDB = $obj->getHashedPassword();

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $hashedPasswordFromDB)) {
            echo "user and password correct";
            $registrationOrder = $obj->getRegistrationOrder();
            session_start();
            $_SESSION['userName'] = $user;
            $_SESSION['err_signin'] = "";
            $_SESSION['registrationOrder'] = $registrationOrder;
            
            header('Location: ../../public/form/game-form.php');
            exit();
        } else {
            session_start();
            $_SESSION['err_signin'] = "Username or password is incorrect";
            $_SESSION['userName'] = $user;
            $_SESSION['password'] = $password;
            header('Location: ../../public/form/signin-form.php');
        }
    } else {
        session_start();
        $_SESSION['err_signin'] = "Username or password is incorrect";
        $_SESSION['userName'] = $user;
        $_SESSION['password'] = $password;
        header('Location: ../../public/form/signin-form.php');
    }
}
?>
