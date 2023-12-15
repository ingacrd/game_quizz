<?php
session_start();

require '../../src/features/game.php';
// include_once "../../db/Database.php";
// include_once "../../db/Create.php";
// include_once "../../db/Select.php";
require_once "../../db/Insert.php";



if (!isset($_SESSION["random_strings_generated"])) {

    // These are all the randomly generated strings     
    // that will be used in the questions    
    $random_letters_q1 = generateRandomLetters();
    $random_letters_q2 = generateRandomLetters();
    $random_numbers_q3 = generateRandomNumbers();
    $random_numbers_q4 = generateRandomNumbers();
    $random_letters_q5 = generateRandomLetters();
    $random_numbers_q6 = generateRandomNumbers();

    // Set the random strings in the session    
    $_SESSION["random_strings_generated"] = true;
    $_SESSION["random_letters_q1"] = $random_letters_q1;
    $_SESSION["random_letters_q2"] = $random_letters_q2;
    $_SESSION["random_numbers_q3"] = $random_numbers_q3;
    $_SESSION["random_numbers_q4"] = $random_numbers_q4;
    $_SESSION["random_letters_q5"] = $random_letters_q5;
    $_SESSION["random_numbers_q6"] = $random_numbers_q6;
}

$number_of_mistakes = 0;

// Questions for each level
$questions = array(

    "Order 6 letters in ascending order: {$_SESSION['random_letters_q1']}",
    "Order 6 letters in descending order: {$_SESSION['random_letters_q2']}",
    "Order 6 numbers in ascending order: {$_SESSION['random_numbers_q3']}",
    "Order 6 numbers in descending order: {$_SESSION['random_numbers_q4']}",
    "Identify the first (smallest) and last letter (largest) in a set of 6 letters: {$_SESSION['random_letters_q5']}",
    "Identify the smallest and the largest number in a set of 6 numbers: {$_SESSION['random_numbers_q6']}",
);

echo createAnswerAscending($_SESSION["random_letters_q1"]). "\t";
echo createAnswerDescending($_SESSION["random_letters_q2"]). "\t";
echo createAnswerAscendingNumbers($_SESSION["random_numbers_q3"]);
echo createAnswerDescending($_SESSION["random_numbers_q4"]). "\t";
echo createAnswerAscendingTwoInput($_SESSION["random_letters_q5"]). "\t";
echo createAnswerAscendingTwoNumber($_SESSION["random_numbers_q6"]);

// Check if the user submitted a response
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $level = $_POST["level"];
    $userAnswer = $_POST["answer"];

    switch ($level) {
        case 1:
            $questionSolution = createAnswerAscending($_SESSION["random_letters_q1"]);
            if(checkAnswer($userAnswer, $questionSolution)){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
        case 2:
            if(checkAnswer($userAnswer,createAnswerDescending($_SESSION["random_letters_q2"]))){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
        case 3:
            if(checkAnswer($userAnswer,createAnswerAscendingNumbers($_SESSION["random_numbers_q3"]))){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
        case 4:
            if(checkAnswer($userAnswer,createAnswerDescendingNumbers($_SESSION["random_numbers_q4"]))){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
        case 5:
            if(checkAnswer($userAnswer, createAnswerAscendingTwoInput($_SESSION["random_letters_q5"]))){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
        case 6:
            if(checkAnswer($userAnswer, createAnswerAscendingTwoNumber($_SESSION["random_numbers_q6"]))){
                // Move to the next level or display a success message
                $_SESSION["level"] = $level + 1;
            } else {
                // Increment the mistake counter
                $_SESSION["mistake_count"] = isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] + 1 : 1;
                // Display an error message for incorrect answers
                $errorMessage = "Incorrect answer. Please try again.";
            }
            break;
    }
    // Check if the mistake count is 6
    // this will automatically end the game and redirect the user to the game over page
    // in this if statement, you will have add the logic that will be responsible for storing the result in the DB
    if (isset($_SESSION["mistake_count"]) && $_SESSION["mistake_count"] == 6) {

        $obj = new Insert();
        $obj->add_result("failure", $_SESSION["mistake_count"], $_SESSION['registrationOrder']);
        initGame();
        header("Location: ../message/game-over.php");

    }
}

// Display the appropriate form based on the user's level
$level = isset($_SESSION["level"]) ? $_SESSION["level"] : 1;

if ($level <= count($questions)) {
    // Display the form for the current level
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <title>Game Level <?php echo $level; ?></title>
            <!-- <link rel="stylesheet" href="../assets/css/game-form.css" /> -->
            <link rel="stylesheet" href="../assets/css/style.css" />
            <link rel="stylesheet" href="../assets/css/nav.css" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    
            <!-- <script src="../../public/assets/js/timeout.js" defer></script> -->
        </head>
        <body>
        <?php include '../template/nav.php'; ?>    
        <div class = "container-fluid background ">
            
            <div class="main">
                

                <div class="container_2">
                    <div class="promo-container">
                        <h2 class = "display-6 text-center fw-bold">Number of Mistakes: <?php echo isset($_SESSION["mistake_count"]) ? $_SESSION["mistake_count"] : 0;  ?></h2>
                    </div>
                    <div class="promo-container">
                        <h2 class = "display-6 text-center fw-bold">Level <?php echo $level; ?></h2>
                    </div>
                    <form class = "main-container px-4" method="post" action="">
                        <p class = "fs-8 text-center"><?php echo $questions[$level - 1]; ?></p>
                        <?php if (isset($errorMessage)) echo "<p>$errorMessage</p>"; ?>
                        <input class = "mb-3" type="text" name="answer" required>
                        <input class = "mb-3" type="hidden" name="level" value="<?php echo $level; ?>">

                        <div class="button-container">
                            <button class = "btn btn-primary gamebtn" type="submit">Submit Answer</button>
                            <a class = "btn btn-primary gamebtn" href="../../src/features/cancel.php">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

            <script>
                //Timeout
                var inactivityTimeout = 15 * 60 * 1000; // 15 minutes in milliseconds
                var inactivityTimer;
                var resetTimer = function() {
                    clearTimeout(inactivityTimer);
                    inactivityTimer = setTimeout(function() {
                        window.location.href = '../../src/features/timeout.php';
                    }, inactivityTimeout);
                };

                document.addEventListener('mousemove', resetTimer);
                document.addEventListener('keypress', resetTimer);

                // Initial setup
                resetTimer();
            </script>
        </body>

    </html>
    <?php
} else {
    // If a user is able to successfully complete the game in under 6 attempts, 
    // the session will be terminated and they will be re-directed to a game-won screen
    $obj = new Insert();
    $obj->add_result("success", $_SESSION["mistake_count"], $_SESSION['registrationOrder']);
    initGame();
    header("Location: ../message/game-won.php");

}
?>
