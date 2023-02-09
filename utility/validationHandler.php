<?php

function stripData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkAnyChars($input) : bool{
    return (preg_match("/[\w]{2,100}/", $input));
}

function checkAlphabetChars($input) : bool{
    return (preg_match("/^[A-Za-z]{2,100}/", $input));
}

function checkNumbers($input) {
    return preg_match("/^[0-9]+$/", $input);
}

function validateNIC($NIC) {
    return strlen($NIC) == 12;
}

function validateNIC2($NIC, $query) {
    $rawData = handleSelectQuery($query);
    //
    // Return true if the contact number has a valid length and
    // does not exist in the table
    //

    return (preg_match("/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/", $NIC)) && $rawData == false;
//    return strlen($contactNumber) == 10 && $rawData == false;
}

function validatePassword($password) {
    return strlen($password) >= 8;
}

function validateContactNumber($contactNumber, $query) {
    $rawData = handleSelectQuery($query);
    //
    // Return true if the contact number has a valid length and 
    // does not exist in the table
    //
    return strlen($contactNumber) == 10 && $rawData == false;
}

function validateUsername($username, $query) {
    $rawData = handleSelectQuery($query);
    //
    // Return true if the username is available
    //
    return $rawData == false;
}

function validateDate($date1, $date2) {
    return $date1 <= $date2;
}

function validateTime($startTime, $endTime) {
    return $startTime < $endTime; 
}

function validateDuration($startTime, $endTime) {
    return $startTime < $endTime;
}