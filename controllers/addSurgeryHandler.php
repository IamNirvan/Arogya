<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $surgeryName = stripData($_POST["surgeryName"]);
    $outcome = stripData($_POST["surgeryOutcome"]);
    $appointmentID = $_POST["appointmentIDs"];
    //
    // Validate the input
    //
    if(!checkAlphabetChars($surgeryName)) {
        header("location: ../views/addSurgery.php?surgeryNameError=Invalid name");
        die();
    }
    if(!checkAnyChars($outcome)) {
        header("location: ../views/addSurgery.php?surgeryOutcomeError=Invalid input");
        die();
    }

    $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
    $dateRecord = handleSelectQuery($dateSelectQuery);

    if($dateRecord) {
        $bookedDate = mysqli_fetch_assoc($dateRecord)["bookedDate"];
        $insertQuery = "INSERT INTO surgeries VALUES 
                          (NULL, '$surgeryName', '$bookedDate', '$outcome', '$patientID', '$appointmentID');";

        if(handleInsertQuery($insertQuery)) {
            header("Location: ../views/medicalHistory.php");
        }
        else {
            echo "Failure!";
        }
    }
}