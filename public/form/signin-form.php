<?php 
    session_start(); 

    $error_message = isset($_SESSION['err_signin']) ? $_SESSION['err_signin'] : '';
    unset($_SESSION['err_signin']);

    // Check if there is an error message in the session
    $account_success = isset($_SESSION['account_success']) ? $_SESSION['account_success'] : '';

    // Clear the error message from the session
    unset($_SESSION['account_success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sign In</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/signIn.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    
</head>

<body >
    <div class = "container-fluid background ">
        <div class="main">
            <div class="container_2">
                <div class="promo-container">
                    <h2 class = "display-5 text-center fw-bold">LaSalle Quiz Game</h2>
                </div>
                <form class = "main-container" method="post" action="../../src/features/signin.php">
                    <?php if (!empty($account_success)): ?>
                    <p class="error-message"><?php echo $account_success; ?></p>
                    <?php endif; ?>
                    <input class = "mb-3" type="text" placeholder="Username" name = "user"
                        value="<?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : ''; ?>"/>
                    <input class = "mb-3" type="password" placeholder="Password" name = "password"/>
                    <?php if (!empty($error_message)): ?>
                    <p class = "fs-6 text-center"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <div class="button-container">
                        <input class = "btn btn-primary gamebtn" type="submit" name="send" value="Login" />
                        <a class = "btn btn-primary gamebtn" href="pw-update-form.php">Forgot your Password?</a>
                    </div>
                    
                    <p class = "fs-6 text-center">Don't have an account? <a href="signup-form.php">Create One!</a></p>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
