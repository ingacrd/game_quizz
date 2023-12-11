<?php

$userName = $_GET["userName"];

if(strlen($userName) == 0) {
    echo "Field cannot be empty!";
} else if(strlen($userName) < 8) {
    echo "Username must be at least 8 characters";
}