<?php
    session_start();

    $error_message = isset($_SESSION['err_pwupdate']) ? $_SESSION['err_pwupdate'] : '';
    unset($_SESSION['err_pwupdate']); 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Update Password</title>
    <!-- <link rel="stylesheet" href="../assets/css/pw-update.css" /> -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
   
</head>

<body>
    <div class = "container-fluid background ">
        <div class="main">
        <div class="container_2">
            <div class="promo-container">
                <h2 class = "display-6 text-center fw-bold">Update Password</h2>
            </div>
            <form class = "main-container" method="post" action="../../src/features/pw-update.php">
                <?php if (!empty($error_message)): ?>
                <p class="error-message fs-6 text-center"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <input class = "mb-3" name="userName" type="text" placeholder="Username" />
                <input class = "mb-3" name="nPassword" type="password" placeholder="New Password" />
                <input class = "mb-3" name="cPassword" type="password" placeholder="Confirm Password" />

                <div class="button-container">
                    <button class= "btn btn-primary gamebtn" type="submit">Update</button>
                    <a class= "btn btn-primary gamebtn" href="signin-form.php" class="back-button">Return to Login</a>
                    
                </div>                  
            </form>
        </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
