<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Logged Out</title>
    <link rel="stylesheet" href="../assets/css/nav.css" />     
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    
</head>

<body>
    <?php include '../template/nav.php'; ?>
    <div class = "container-fluid background ">
        <div class="main">
        <div class="container_2">
            <div class="promo-container">
                <h2 class = "display-5 text-center fw-bold">You've been logged out.</h2>
            </div>
            <div class="main-container  px-4">
                <div class="text-container">
                    <p>Thanks for playing! Hope to see you again soon!</p>
                </div>
                <div class="button-container">
                    <a class = "btn btn-primary gamebtn" href="../form/signin-form.php">Return to Login</a>
                </div>
            </div>
        </div>
        </div>
    </div>

</body>

</html>