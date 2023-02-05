<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

// Get the data from the form
$username = $_POST["username"];
$password = $_POST["password"];
$accountType = $_POST["accountOption"];

// Check if the account can be found. 
// If the account can be found, compare the passwords and determine if the 
// user can be logged in.
// If account can be found, make sure to create a session variable to store the username, first name
if($accountType == "patient") {
    $accountSelectQuery = "SELECT * FROM patientaccount WHERE username = '$username'";
    $rawData = handleSelectQuery($accountSelectQuery);
    
    if($rawData) {
        $accountFetched = mysqli_fetch_assoc($rawData);
    
        // Check if the passwords match
        if($password == $accountFetched["password"]) {
            $_SESSION["username"] = $username;
            // Get the first and last name
            $patientID = $accountFetched['patientID'];
            $nameQuery = "SELECT firstName, lastName FROM patient WHERE patientID = '$patientID'";
            $nameRawData = handleSelectQuery($nameQuery);
    
            if($nameRawData) {
                $nameFetched = mysqli_fetch_assoc($nameRawData);
                $_SESSION["firstName"] = $nameFetched["firstName"];
                $_SESSION["lastName"] = $nameFetched["lastName"];
                $_SESSION["accountType"] = "patient";
                $_SESSION["ID"] = $patientID;
                header("Location: ../views/dashboard.php");
            }
        }
        else {
            header("Location: ../views/login.php?incorrectPassword=Incorrect password");
            die();
        }
    }
    else {
        header("Location: ../views/login.php?unknownUsername=Unknown username");
        die();
    }
}
else {
    $accountSelectQuery = "SELECT * FROM employeeaccount WHERE username = '$username' AND accountType='$accountType'";
    $rawData = handleSelectQuery($accountSelectQuery);
   
    if($rawData) {
        $accountFetched = mysqli_fetch_assoc($rawData);
   
        // Check if the passwords match
        if($password == $accountFetched["password"]) {
            $_SESSION["username"] = $username;
            // Get the first and last name
            $employeeID = $accountFetched['employeeID'];
            $firstNameQuery = "SELECT firstName, lastName FROM employee WHERE employeeID = '$employeeID'";
            $firstNameRawData = handleSelectQuery($firstNameQuery);
   
            if($firstNameRawData) {
                $firstNameFetched = mysqli_fetch_assoc($firstNameRawData);
                $_SESSION["firstName"] = $firstNameFetched["firstName"];
                $_SESSION["lastName"] = $firstNameFetched["lastName"];
                $_SESSION["accountType"] = $accountType;
                $_SESSION["ID"] = $employeeID;
                header("Location: ../views/dashboard.php");
            }
        }
        else {
            header("Location: ../views/login.php?incorrectPassword=Incorrect password");
            die();
        }
    }
    else {
        header("Location: ../views/login.php?unknownUsername=Unknown username");
        die();
    }
}