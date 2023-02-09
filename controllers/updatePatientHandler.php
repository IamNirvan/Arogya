<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    //
    // Get the data from the form
    //
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
    //
    // Validate
    //
    if(!validateUsername($username, "SELECT username from patientaccount WHERE lower(username) = 
                                          lower('$username') AND patientID != $patientID")) {
        header("Location: ../views/manageAccount.php?usernameError=Username is taken");
        die();
    }

    if(!validatePassword($password)) {
        header("Location: ../views/manageAccount.php?passwordError=Password is weak");
        die();
    }

    if(!checkAlphabetChars($firstName)) {
        header("Location: ../views/manageAccount.php?firstNameError=Invalid first name");
        die();
    }

    if(!checkAlphabetChars($lastName)) {
        header("Location: ../views/manageAccount.php?lastNameError=Invalid last name");
        die();
    }

    if(!validateContactNumber($contactNumber, "SELECT contactNumber from patient WHERE 
                                      contactNumber = '$contactNumber' AND patientID != $patientID")) {
        header("Location: ../views/manageAccount.php?contactNumberError=Invalid contact number");
        die();
    }

    if(!validateNIC2($NIC, "SELECT patientNIC from patient WHERE 
                                      patientNIC = '$NIC' AND patientID != $patientID")) {
        header("Location: ../views/manageAccount.php?NICError=Invalid NIC");
        die();
    }

    if(!checkAlphabetChars($nationality)) {
        header("Location: ../views/manageAccount.php?nationalityError=Invalid nationality");
        die();
    }

//    if(!checkAlphabetChars($address)) {
//        header("Location: ../views/manageAccount.php?addressError=Invalid address");
//        die();
//    }
    //
    // Execute query
    //
    try {
        $updatePatientQuery = "UPDATE patient SET 
                                firstName = '$firstName',
                                middleName = '$middleName',
                                lastName = '$lastName',
                                contactNumber = '$contactNumber',
                                gender = '$gender',
                                nationality = '$nationality',
                                address = '$address',
                                patientNIC = '$NIC'
                                WHERE patientID = '$patientID'";

        $updatePatientAccountQuery = "UPDATE patientaccount SET 
                                    username = '$username',
                                    password = '$password'
                                    WHERE patientID = '$patientID'";

        if(!handleUpdateQuery($updatePatientQuery)) {
            header("Location: ../views/manageAccount.php?error=An error occurred when updating doctor details");
            die();
        }

        if(!handleUpdateQuery($updatePatientAccountQuery)) {
            header("Location: ../views/manageAccount.php?error=An error occurred when updating doctor account details");
            die();
        }

        $_SESSION["username"] = $username;
        $_SESSION["firstName"] = $firstName;
        $_SESSION["lastName"] = $lastName;
        header("Location: ../views/dashboard.php");
    }
    catch (Exception) {
        header("Location: ../views/manageAccount.php?error=An error occurred when updating");
        die();
    }
}