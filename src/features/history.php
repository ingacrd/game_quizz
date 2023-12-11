<?php
include_once "../../db/Database.php";
include_once "../../db/Create.php";
include_once "../../db/Select.php";

function getGameHistory() {
    $obj = new Create();
    $obj = new Select("admin", "adminpsw");
    $gameHistory = $obj ->getViewHistory();
    return $gameHistory;


}
    

?>
