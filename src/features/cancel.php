<?php
require_once "../../db/Insert.php";
require_once '../../src/features/game.php';
session_start();

$obj = new Insert();
$obj->add_result("incomplete", $_SESSION["mistake_count"], $_SESSION['registrationOrder']);

initGame();
// Redirect back to the game-form page with a brand new session
header("Location: ../../public/form/game-form.php");
exit();
?>
