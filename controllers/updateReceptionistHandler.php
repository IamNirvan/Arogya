<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

if(isset($_SESSION["username"])) {
    //
    // Get input
    //
    $receptionistD = $_GET["ID"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = stripData($_POST["firstName"]);
    $middleName = stripData($_POST["middleName"]);
    $lastName = stripData($_POST["lastName"]);
    $contactNumber = stripData($_POST["contactNumber"]);
    $gender = stripData($_POST["genderOption"]);
    //
    // Validate
    //
    if(!validateUsername($username, "SELECT username from employeeaccount 
                WHERE lower(username) = lower('$username') AND employeeID != '$receptionistD'")) {
        header("Location: ../views/updateReceptionist.php?ID=$receptionistD&usernameError=Username is taken");
        die();
    }

    if(!validatePassword($password)) {
        header("Location: ../views/updateReceptionist.php?ID=$receptionistD&passwordError=Password is weak");
        die();
    }

    if(!checkAlphabetChars($firstName)) {
        header("Location: ../views/updateReceptionist.php?ID=$receptionistD&firstNameError=Invalid input");
        die();
    }

    if(!checkAlphabetChars($lastName)) {
        header("Location: ../views/updateReceptionist.php?ID=$receptionistD&lastNameError=Invalid input");
        die();
    }

    if(!validateContactNumber($contactNumber, "SELECT contactNumber from employee WHERE 
                                       contactNumber = '$contactNumber' AND employeeID != '$receptionistD'")) {
        header("Location: ../views/updateReceptionist.php?ID=$receptionistD&
            contactNumberError=Invalid contact number");
        die();
    }
    //
    // Execute query
    //
    try {
        $updateEmployeeQuery = "UPDATE employee SET 
                                firstName = '$firstName',
                                middleName = '$middleName',
                                lastName = '$lastName',
                                contactNumber = '$contactNumber',
                                gender = '$gender'
                                WHERE employeeID = '$receptionistD'";

        $updateEmployeeAccountQuery = "UPDATE employeeaccount SET 
                                    username = '$username',
                                    password = '$password'
                                    WHERE employeeID = '$receptionistD'";

        if(!handleUpdateQuery($updateEmployeeQuery)) {
            header("Location: ../views/manageReceptionist.php?error=An error occurred when updating 
                doctor details");
            die();
        }

        if(!handleUpdateQuery($updateEmployeeAccountQuery)) {
            header("Location: ../views/manageReceptionist.php?error=An error occurred when updating doctor 
                account details");
            die();
        }
        header("Location: ../views/manageReceptionist.php");
    }
    catch (Exception) {
        header("Location: ../views/manageReceptionist.php?error=An error occurred when updating");
        die();
    }
}