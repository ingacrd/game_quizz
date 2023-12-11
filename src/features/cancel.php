<?php
session_start();
function add_result($status, $livesUsed, $registrationOrder) {
    $mysqli = new mysqli('localhost', 'root', '', 'kidsGames');
    $currentDateTime = date("Y-m-d H:i:s");

    if($mysqli -> connect_errno) {
        echo "Failed to connect to MYSQL: " . $mysqli->connecto_error;
        exit();
    }

    $sqlInsertResult = "INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES
    ('$currentDateTime', '$status', '$livesUsed', '$registrationOrder')";
    $mysqli->query($sqlInsertResult);
    $mysqli->close();
}

add_result("incomplete", $_SESSION["mistake_count"], $_SESSION['registrationOrder']);
session_unset();
session_destroy();

// Redirect back to the game-form page with a brand new session
header("Location: ../../public/form/game-form.php");
exit();
?>
