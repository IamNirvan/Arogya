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
    $examID = $_GET["ID"];
    $oldName = $_GET["examName"];
    $examName = stripData($_POST["examName"]);
    $outcome = stripData($_POST["examOutcome"]);
    $appointmentID = $_POST["appointmentIDs"];
    $currentDate = date("Y-m-d");
    //
    // Validate input
    //
    if(!checkAlphabetChars($examName)) {
        header("location: ../views/addExamination.php?examNameError=Invalid name");
        die();
    }
    if(!checkAnyChars($outcome)) {
        header("location: ../views/addExamination.php?examOutcomeError=Invalid input");
        die();
    }
    //
    // Execute query
    //
    try {
        $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
        $dateRecord = handleSelectQuery($dateSelectQuery);

        if(!$dateRecord) {
            header("Location: ../views/medicalHistory.php?error=An error occurred when updating");
            die();
        }
        $bookedDate = mysqli_fetch_assoc($dateRecord)["bookedDate"];
        $updateQuery = "UPDATE examinations SET 
                                name = '$examName',
                                examinationDate = '$bookedDate',
                                outcome = '$outcome',
                                patientID = '$patientID',
                                appointmentID = '$appointmentID'
                                WHERE examinationID = '$examID';";

        if(!handleUpdateQuery($updateQuery)) {
            header("Location: ../views/medicalHistory.php?error=An error occurred when updating");
            die();
        }
        header("Location: ../views/medicalHistory.php");
    }
    catch(Exception) {
        header("Location: ../views/medicalHistory.php?error=An error occurred when updating");
        die();
    }
}

