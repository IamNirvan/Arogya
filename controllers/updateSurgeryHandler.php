<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    //
    // Get input
    //
    $surgeryID = $_GET["ID"];
    $surgeryName = stripData($_POST["surgeryName"]);
    $outcome = stripData($_POST["surgeryOutcome"]);
    $appointmentID = $_POST["appointmentIDs"];
    //
    // Validate the input
    //
    if(!checkAlphabetChars($surgeryName)) {
        header("location: ../views/updateSurgery.php?ID=$surgeryID&surgeryNameError=Invalid name");
        die();
    }
    if(!checkAnyChars($outcome)) {
        header("location: ../views/updateSurgery.php?ID=$surgeryID&surgeryOutcomeError=Invalid input");
        die();
    }
    //
    // Execute query
    //
    try {
        $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
        $dateRecord = handleSelectQuery($dateSelectQuery);

        if($dateRecord) {
            $bookedDate = mysqli_fetch_assoc($dateRecord)["bookedDate"];
            $updateQuery = "UPDATE surgeries SET 
                                name = '$surgeryName',
                                surgeryDate = '$bookedDate',
                                outcome = '$outcome',
                                patientID = '$patientID',
                                appointmentID = '$appointmentID'
                                WHERE surgeryID = '$surgeryID';";
            if(!handleUpdateQuery($updateQuery)) {
                header("Location: ../views/medicalHistory.php?error=Unable to update record");
                die();
            }
            header("Location: ../views/medicalHistory.php");
        }
    }
    catch(Exception) {
        header("Location: ../views/medicalHistory.php?error=Unable to update record");
        die();
    }
}

