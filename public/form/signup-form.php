<?php
session_start();

// Check if there is an error message in the session
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

// Clear the error message from the session
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Create an Account</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <script async src="../assets/js/main.js" type="text/javascript" ></script>
    <script async src="../assets/js/signup-onkeyup/fname-ajax.js" type="text/javascript" ></script>
    <script async src="../assets/js/signup-onkeyup/lname-ajax.js" type="text/javascript" ></script>
    <script async src="../assets/js/signup-onkeyup/uname-ajax.js" type="text/javascript" ></script>
    <script async src="../assets/js/signup-onkeyup/pcode1-ajax.js" type="text/javascript" ></script>
    <script async src="../assets/js/signup-onkeyup/pcode2-ajax.js" type="text/javascript" ></script>
</head>

<body>
<div class = "container-fluid background ">
        <div class="main">
        <div class="container_2">
            <div class="promo-container">
                <h2 class = "display-6 text-center fw-bold">LaSalle Quiz Game</h2>
            </div>
            <form class = "main-container" method="post" action="../../src/features/signup.php">
                <?php if (!empty($error_message)): ?>
                <p class="error-message fs-6"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <input  class = "mb-1" id="fName" name="fName" type="text" placeholder="First Name" onkeyup="validate_fName()"/>
                <p class = "fs-6" id="fName-feedback"></p>
                <input  class = "mb-1" id="lName" name="lName" type="text" placeholder="Last Name" onkeyup="validate_lName()"/>
                <p class = "fs-6" id="lName-feedback"></p>
                <input  class = "mb-1" id="userName" name="userName" type="text" placeholder="Username" onkeyup="validate_userName()"/>
                <p class = "fs-6" id="username-feedback"></p>
                <input  class = "mb-1" id="pcode1" name="password" type="password" placeholder="Password" onkeyup="validate_pcode1()"/>
                <p class = "fs-6" id="pcode1-feedback"></p>
                <input  class = "mb-1" id="pcode2" name="confirm-password" type="password" placeholder="confirm-password" onkeyup="validate_pcode2()"/>
                <p class = "fs-6" id="pcode2-feedback"></p>

                <div class="button-container">
                    <input class = "btn btn-primary gamebtn" type="submit" name="send" value="Create Account" />
                </div>

                <p class = "fs-6 text-center">Already have an account? <a href="signin-form.php">Login</a></p>
            </form>
        </div>
    </div>
</div>

</body>

</html>