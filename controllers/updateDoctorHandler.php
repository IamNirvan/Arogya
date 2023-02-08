<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

if(isset($_SESSION["username"])) {
    $doctorID = $_GET["ID"];
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
    $specialization = stripData($_POST["specialization"]);
    //
    // Validate
    //
    if(!validateUsername($username, "SELECT username from employeeaccount WHERE lower(username) = lower('$username') AND employeeID != $doctorID")) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&usernameError=Username is taken");
        die();
    }

    if(!validatePassword($password)) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&passwordError=Password is weak");
        die();
    }

    if(!checkAlphabetChars($firstName)) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&firstNameError=Invalid input");
        die();
    }

    if(!checkAlphabetChars($lastName)) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&lastNameError=Invalid input");
        die();
    }

    if(!validateContactNumber($contactNumber, "SELECT contactNumber from employee WHERE contactNumber = '$contactNumber' AND employeeID != $doctorID")) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&contactNumberError=Invalid contact number");
        die();
    }

    if(!checkAlphabetChars($specialization)) {
        header("Location: ../views/updateDoctor.php?ID=$doctorID&specializationError=Invalid input");
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
                                gender = '$gender',
                                specialization = '$specialization'
                                WHERE employeeID = '$doctorID'";

        $updateEmployeeAccountQuery = "UPDATE employeeaccount SET 
                                    username = '$username',
                                    password = '$password'
                                    WHERE employeeID = '$doctorID'";

        if(!handleUpdateQuery($updateEmployeeQuery)) {
            header("Location: ../views/manageDoctor.php?error=An error occurred when updating doctor details");
            die();
        }

        if(!handleUpdateQuery($updateEmployeeAccountQuery)) {
            header("Location: ../views/manageDoctor.php?error=An error occurred when updating doctor account details");
            die();
        }
        header("Location: ../views/manageDoctor.php");
    }
    catch (Exception) {
        header("Location: ../views/manageDoctor.php?error=An error occurred when updating");
        die();
    }
}