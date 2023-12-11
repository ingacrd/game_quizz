<?php

$lName = $_GET["lName"];

function isFirstLetterAlphabetical($str) {
    // Check if the string is not empty
    if (!empty($str)) {
        // Get the first character of the string
        $firstLetter = $str[0];
        
        // Check if the first character is an alphabetical letter
        return ctype_alpha($firstLetter);
    }

    // Return false if the string is empty
    return false;
}

if(strlen($lName) == 0) {
    echo "Field cannot be empty!";
} else if(!isFirstLetterAlphabetical($lName)) {
    echo "First letter must be a letter";
}