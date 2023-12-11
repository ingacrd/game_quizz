<?php

$pcode2 = $_GET["pcode2"];

if(strlen($pcode2) == 0) {
    echo "Field cannot be empty!";
} else if(strlen($pcode2) < 8) {
    echo "Password must be at least 8 characters";
}