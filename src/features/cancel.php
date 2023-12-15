<?php

function cancel_game(){
    session_start();

    $obj = new Insert();
    $obj->add_result("incomplete", $_SESSION["mistake_count"], $_SESSION['registrationOrder']);
    initGame();
    header("Location: ../../public/form/game-form.php");

}

?>
