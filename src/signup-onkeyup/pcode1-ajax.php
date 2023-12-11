<?php

$pcode1 = $_GET["pcode1"];

if(strlen($pcode1) == 0) {
    echo "Field cannot be empty!";
} else if(strlen($pcode1) < 8) {
    echo "Password must be at least 8 characters";
}