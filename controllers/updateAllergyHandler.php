<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $allergyID = $_GET["ID"];
    $oldName = $_GET["allergyName"];
    $allergyName = stripData($_POST["allergyName"]);
    //
    // Validate the input
    //
    if(!checkAnyChars($allergyName)) {
        header("location: ../views/updateAllergy.php?ID=$allergyID&allergyNameError=Invalid name");
        die();
    }
    //
    // Check if any changes were made to the allergy name. If not, return the medical history page.
    // Otherwise, check if the name exists in the database and update it if it does not exist
    //
    if($allergyName == $oldName) {
        header("Location: ../views/medicalHistory.php");
        die();
    }
    else {
        $selectQuery = "SELECT * FROM allergies WHERE lower(name) = lower('$allergyName') AND patientID = '$patientID'";
        $records = handleSelectQuery($selectQuery);
        if(!$records) {
            $updateQuery = "UPDATE allergies SET name = '$allergyName' WHERE allergyID = '$allergyID';";
            if(handleUpdateQuery($updateQuery)) {
                header("Location: ../views/medicalHistory.php");
            }
            else {
                echo "Failure!";
            }
        }
        else {
            header("location: ../views/updateAllergy.php?ID=$allergyID&allergyNameError=Allergy already exists");
            die();
        }
    }
}

