<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

// Get the data from the form
$username = $_POST["username"];
$password = $_POST["password"];
$firstName = stripData($_POST["firstName"]);
$middleName = stripData($_POST["middleName"]);
$lastName = stripData($_POST["lastName"]);
$contactNumber = stripData($_POST["contactNumber"]);
$gender = stripData($_POST["genderOption"]);
$NIC = stripData($_POST["NIC"]);
$nationality = stripData($_POST["nationality"]);
$address = stripData($_POST["address"]);

// Create validation related variables
$validPassword = false;
$validNIC = false;
$validContactNumber = false;
$validUsername = false;

if(!validateNIC($NIC)) {
    header("Location: ../views/patientRegistration.php?NICerror=Invalid NIC");
}
else {
    $validNIC = true;
}
if(!validateContactNumber($contactNumber, "SELECT contactNumber from patient WHERE contactNumber = '$contactNumber'")) {
    header("Location: ../views/patientRegistration.php?contactNumberError=Invalid contact number");
}
else {
    $validContactNumber = true;
}
if(!validatePassword($password)) {
    header("Location: ../views/patientRegistration.php?passwordError=Password is weak");
}
else {
    $validPassword = true;
}
if(!validateUsername($username, "SELECT username from patientaccount WHERE username = '$username'")) {
    header("Location: ../views/patientRegistration.php?usernameError=Username is taken");
}
else {
    $validUsername = true;
}

// If the NIC, contact number and password are valid, 
// then proceed to register the user
if($validNIC && $validContactNumber && $validPassword) {
    $registerPatientQuery = "INSERT INTO patient VALUES(NULL, '$firstName', '$middleName', '$lastName', '$gender', '$contactNumber', '$nationality', '$address', '$NIC')";

    if(handleInsertQuery($registerPatientQuery)) {
        // Get the patient ID
        $selectQuery = "SELECT patientID FROM patient WHERE patientNIC = '$NIC'";
        $rawData = handleSelectQuery($selectQuery);
        $patientID = mysqli_fetch_assoc($rawData)["patientID"];

        $createAccountQuery = "INSERT INTO patientaccount VALUES(NULL, '$username', '$password', '$patientID')";
        if(handleInsertQuery($createAccountQuery)) {
            header("Location: ../views/login.php");
        }
    }
}