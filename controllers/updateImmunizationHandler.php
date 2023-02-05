<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $immunizationID = $_GET["ID"];
    $oldAppointmentID = $_GET["appointmentID"];
    $oldName = $_GET["immunizationName"];
    $appointmentID = $_POST["appointmentIDs"];
    $immunizationName = stripData($_POST["immunizationName"]);
    //
    // Validate the input
    //
    if(!checkAnyChars($immunizationName)) {
        header("location: ../views/updateImmunization.php?ID=$immunizationID&immunizationNameError=Invalid name");
        die();
    }
    //
    // Check if any changes were made to the name and appointment ID. If not, return the medical history page.
    // Otherwise, check if the name exists in the database and update it if it does not exist
    //
    if(($immunizationName == $oldName) && ($appointmentID == $oldAppointmentID)) {
        header("Location: ../views/medicalHistory.php");
        die();
    }
    else {
        $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
        $dateRecord = handleSelectQuery($dateSelectQuery);

        if($dateRecord) {
            $updateQuery = "UPDATE immunizations SET name = '$immunizationName' WHERE immunizationID = '$immunizationID';";
            if(handleUpdateQuery($updateQuery)) {
                header("Location: ../views/medicalHistory.php");
            }
            else {
                echo "Failure!";
            }
        }
    }
}

