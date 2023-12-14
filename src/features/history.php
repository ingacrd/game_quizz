<?php

require_once "../../db/Create.php";
require_once "../../db/Select.php";
function getGameHistory() {
    //$obj = new Create();
    $obj = new Select("admin", "adminpsw");
    $gameHistory = $obj ->getViewHistory();
    return $gameHistory;


}
    

?>
