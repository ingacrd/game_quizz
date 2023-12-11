<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../../public/message/logged-out.php");        
    exit();

?>